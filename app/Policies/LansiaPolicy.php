<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Lansia;
use Illuminate\Auth\Access\HandlesAuthorization;

class LansiaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Mengizinkan akses untuk admin, member, dan super_admin
        return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
    }

    public function view(User $user, Lansia $lansia)
    {
        // Mengizinkan akses untuk admin, member, dan super_admin
        return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
    }

    public function update(User $user, Lansia $lansia)
    {
        // Hanya admin atau super_admin yang dapat memperbarui data Lansia
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function delete(User $user, Lansia $lansia)
    {
        // Admin dan super_admin dapat menghapus data Lansia, member hanya bisa menghapus jika diperlukan
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function create(User $user)
    {
        // Admin dan super_admin dapat membuat data Lansia
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }
}
