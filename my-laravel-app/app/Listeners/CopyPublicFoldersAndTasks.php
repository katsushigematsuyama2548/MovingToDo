<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Folder;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CopyPublicFoldersAndTasks
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        Log::info('CopyPublicFoldersAndTasks listener instantiated');
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
        $user = $event->user;
        Log::info('CopyPublicFoldersAndTasks listener executed for user: ' . $user->id);

        $publicFolders = Folder::whereNull('user_id')->get();

        foreach ($publicFolders as $publicFolder) {
            // Check if the folder already exists for the user
            $existingFolder = Folder::where('user_id', $user->id)
                                    ->where('title', $publicFolder->title)
                                    ->first();

            if (!$existingFolder) {
                Log::info('Creating new folder for user: ' . $user->id . ' with title: ' . $publicFolder->title);
                $newFolder = $publicFolder->replicate();
                $newFolder->user_id = $user->id;
                $newFolder->save();

                $publicTasks = $publicFolder->tasks;

                foreach ($publicTasks as $publicTask) {
                    // Check if the task already exists in the new folder
                    $existingTask = Task::where('folder_id', $newFolder->id)
                                        ->where('title', $publicTask->title)
                                        ->first();

                    if (!$existingTask) {
                        Log::info('Creating new task for folder: ' . $newFolder->id . ' with title: ' . $publicTask->title);
                        $newTask = $publicTask->replicate();
                        $newTask->folder_id = $newFolder->id;
                        $newTask->save();
                    }
                }
            } else {
                Log::info('Folder already exists for user: ' . $user->id . ' with title: ' . $publicFolder->title);
            }
        }
    }
}
