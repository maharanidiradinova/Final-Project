<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BukuTamu;

class BukuTamuPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Semua pengguna bisa melihat
    }

    public function view(User $user, BukuTamu $bukuTamu): bool
    {
        return true; // Semua pengguna bisa melihat detail
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin'; // Hanya admin yang bisa membuat
    }

    public function update(User $user, BukuTamu $bukuTamu): bool
    {
        return $user->role === 'admin'; // Hanya admin yang bisa mengedit
    }

    public function delete(User $user, BukuTamu $bukuTamu): bool
    {
        return $user->role === 'admin'; // Hanya admin yang bisa menghapus
    }

    public function restore(User $user, BukuTamu $bukuTamu): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, BukuTamu $bukuTamu): bool
    {
        return $user->role === 'admin';
    }
}
