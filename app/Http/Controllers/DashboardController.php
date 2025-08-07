<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $articleCount = 0;
        $videoCount = 0;

        switch ($user->membership_type) {
            case 'A':
                $articleCount = 3;
                $videoCount = 3;
                break;

            case 'B':
                $articleCount = 10;
                $videoCount = 10;
                break;

            case 'C':
                // Semua data yang ada di database
                $articleCount = Article::query()->count();
                $videoCount = Video::query()->count();
                break;
        }

        // Kirim data 'articleCount' dan 'videoCount' sebagai props ke halaman Dashboard
        return Inertia::render('dashboard', [
            'articleCount' => $articleCount,
            'videoCount' => $videoCount,
        ]);
    }
}
