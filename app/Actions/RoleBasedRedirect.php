<?php
// ===============================================================================================
// NOTE
// GIN DUGANG NI TO HANDLE LOGIN RESPONSE SA JETSTREAM AND FILAMENT
// IF ANG USER ROLE ADMIN OR SUPER_ADMIN REDIRECT SA FILAMENT DASHBOARD ELSE SA JETSREAM DASHBOARD
// ===============================================================================================

namespace App\Actions;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class RoleBasedRedirect implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toResponse($request): RedirectResponse
    {
        // Get the authenticated user
        $user = auth()->user();
        // Using Spatie's hasRole method to check for super_admin
        if ($user->hasAnyRole(['super_admin', 'admin', 'super-admin','admin_shop'])) {
            // Redirect to Filament admin panel
            return redirect()->intended(config('filament.path', 'admin'));
        }
        // For non-admin users, redirect to regular dashboard
        return redirect()->intended(config('fortify.home', '/dashboard'));
    }
}
