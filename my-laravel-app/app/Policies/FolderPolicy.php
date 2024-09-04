<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Folder;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    /**
     * Create a new policy instance.
     */

    public function view(User $user, Folder $folder)
    {
        // ユーザーとフォルダを比較して真偽値を返す
        return $user->id === $folder->user_id;
    }

    public function __construct()
    {
        //
    }
}
