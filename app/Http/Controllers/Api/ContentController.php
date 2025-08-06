<?php

namespace App\Http\Controllers\Api;

class ContentController extends Controller
{
    public function articles(Request $request)
    {
        $user = $request->user();

        $query = Article::query();

        switch ($user->membership_type) {
            case 'A':
                $query->limit(3);
                break;
            case 'B':
                $query->limit(10);
                break;
            case 'C':
                // No limit
                break;
            default:
                return response()->json(['data' => []]); // No access
        }

        return response()->json(['data' => $query->get()]);
    }

    // Metode videos() akan memiliki logika yang sama
}
