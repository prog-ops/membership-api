<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    /**
     * Menampilkan halaman daftar artikel sesuai membership.
     */
    public function index(Request $request): Response
    {
        // Ambil user yang sedang login
        $user = $request->user();

        // Siapkan query builder untuk model Article
        $query = Article::query();

        // Terapkan logika berdasarkan tipe membership
        switch ($user->membership_type) {
            case 'A':
                $query->limit(3);
                break;

            case 'B':
                $query->limit(10);
                break;

            case 'C':
                // Tidak ada batasan untuk Tipe C
                break;

            default:
                // Jika ada tipe lain yang tidak terdefinisi, jangan tampilkan apa-apa
                return Inertia::render('Articles/Index', [
                    'articles' => collect(), // Kirim koleksi kosong
                ]);
        }

        // Ambil data artikel, urutkan dari yang terbaru, dan kirim ke view
        $articles = $query->latest()->get();

        return Inertia::render('Articles/Index', [
            'articles' => $articles,
        ]);
    }
}
