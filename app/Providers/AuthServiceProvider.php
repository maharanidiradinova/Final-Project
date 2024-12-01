<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Anak;
use App\Policies\AnakPolicy;
use App\Models\Lansia;
use App\Policies\LansiaPolicy;
use App\Models\BukuTamu;
use App\Policies\BukuTamuPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Anak::class => AnakPolicy::class,
        Lansia::class => LansiaPolicy::class,
        BukuTamu::class => BukuTamuPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-lansia', function ($user) {
            return $user->hasRole('super_admin') || $user->hasRole('admin') || $user->hasRole('member');
        });
    }
}









// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;
// use App\Models\Anak;
// use App\Policies\AnakPolicy;
// use App\Models\Lansia;
// use App\Policies\LansiaPolicy;
// use App\Models\BukuTamu;
// use App\Policies\BukuTamuPolicy;

// class AuthServiceProvider extends ServiceProvider
// {
//     protected $policies = [
//         Anak::class => AnakPolicy::class,
//         Lansia::class => LansiaPolicy::class,
//         BukuTamu::class => BukuTamuPolicy::class,
//     ];

//     public function boot()
//     {
//         $this->registerPolicies();
    
//         Gate::define('view-lansia', function ($user) {
//             return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
//         });
    
//         // Anda dapat menambahkan lebih banyak gate jika diperlukan
//         Gate::define('view-anak', function ($user) {
//             return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
//         });
    
//         Gate::define('view-buku-tamu', function ($user) {
//             return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
//         });
//     }
// }     -->