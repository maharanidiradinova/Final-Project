<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Anak;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnakPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Mengizinkan akses untuk admin, member, dan super_admin
        return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
    }

    public function view(User $user, Anak $anak)
    {
        // Mengizinkan akses untuk admin, member, dan super_admin
        return $user->hasRole('admin') || $user->hasRole('member') || $user->hasRole('super_admin');
    }

    public function update(User $user, Anak $anak)
    {
        // Hanya admin atau super_admin yang dapat memperbarui data Anak
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }

    public function delete(User $user, Anak $anak)
    {
        // Hanya super_admin yang dapat menghapus data Anak
        return $user->hasRole('super_admin');
    }

    public function create(User $user)
    {
        // Hanya admin dan super_admin yang dapat membuat data Anak
        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }
}
