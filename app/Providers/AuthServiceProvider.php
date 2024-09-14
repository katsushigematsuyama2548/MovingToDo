<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Folder;
use App\Policies\FolderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのポリシーマッピング。
     *
     * @var array
     */
    protected $policies = [
        Folder::class => FolderPolicy::class,
    ];

    /**
     * 任意の認可サービスを登録します。
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}