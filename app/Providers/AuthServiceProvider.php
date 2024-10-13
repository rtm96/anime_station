<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 管理者ユーザー
        Gate::define('admin', function (User $user) {
            return ($user->auth === 1);
        });

        //管理ユーザーかつログインしたユーザーのみ投稿編集できる機能　@can('admin_or_myItem')←現在機能不全
        Gate::define('admin-or-myItem', function(User $user, Item $item){
            return((($user->auth === 0 && $item->user_id === $user->id) || $user->auth === 1));
        });
    }
}
