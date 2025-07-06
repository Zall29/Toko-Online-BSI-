<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Cek apakah request mengharapkan JSON
        if ($request->expectsJson()) {
            return null;
        }

        // Cek apakah URI request mengandung 'backend' atau 'frontend'
        if ($request->is('backend/*')) {
            return route('backend.login');
        } elseif ($request->is('frontend/*')) { // Digunakan jika frontend telah tersedia
            return route('frontend.login');      // Digunakan jika frontend telah tersedia
        }

        // Redirect default jika tidak ada yang cocok di atas
        return route('backend.login'); // Ganti ke frontend jika telah tersedia
    }
}
