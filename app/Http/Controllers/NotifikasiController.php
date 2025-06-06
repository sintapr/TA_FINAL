<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Tampilkan notifikasi untuk orangtua yang sedang login
    public function index()
    {
        $nis = Auth::user()->NIS; // asumsi orangtua login via siswa dan punya NIS

        // Ambil notifikasi untuk orangtua yang spesifik (NIS) dan notifikasi massal (NIS null)
        $notifikasi = Notifikasi::where('untuk_role', 'orangtua')
            ->where(function($query) use ($nis) {
                $query->whereNull('NIS')
                      ->orWhere('NIS', $nis);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifikasi.index', compact('notifikasi'));
    }

    // Tandai notifikasi sudah dibaca (via ajax misalnya)
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->dibaca = true;
        $notifikasi->save();

        return response()->json(['status' => 'success']);
    }
}
