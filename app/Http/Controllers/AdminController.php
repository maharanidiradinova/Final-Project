<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function unverifiedUsers()
    {
        // Mendapatkan semua pengguna yang belum diverifikasi
        $unverifiedUsers = User::where('email_verified_at', null)->get();

        // Mengirim data ke view
        return view('admin.unverified-users', compact('unverifiedUsers'));
    }
    public function verifyUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.unverified-users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Melakukan verifikasi user
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('admin.unverified-users')->with('success', 'Pengguna berhasil diverifikasi.');
    }

    
}
