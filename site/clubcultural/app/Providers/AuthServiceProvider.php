<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Models\Permission;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ($this->getPermissions() as $permission){
            Gate::define($permission->name, function($user) use ($permission){
                return $user->hasRole($permission->roles);
            });
        }
    }

    protected function getPermissions(){
        /*try {
            return Cache::remember("auth.permissions", 10, function () {
                return Permission::with('roles')->get();
            });
        } catch (\Exception $e) {
            return [];
        }*/

        return Permission::with('roles')->get();
    }
}
