<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VideoController extends Controller
{
    /**
     * Menampilkan halaman daftar video sesuai membership.
     */
    public function index(Request $request): Response
    {
        $user = $request->user();

        $query = Video::query();

        // Logika membership tetap sama persis
        switch ($user->membership_type) {
            case 'A':
                $query->limit(3);
                break;
            case 'B':
                $query->limit(10);
                break;
            case 'C':
                break;
            default:
                return Inertia::render('Videos/Index', [ // <-- Render ke halaman Videos/Index
                    'videos' => collect(),
                ]);
        }

        $videos = $query->latest()->get();

        // Kirim prop 'videos' ke halaman Videos/Index
        return Inertia::render('Videos/Index', [
            'videos' => $videos,
        ]);
    }
}
