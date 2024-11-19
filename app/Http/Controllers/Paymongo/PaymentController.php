<?php

namespace App\Http\Controllers\Paymongo;

use App\Http\Controllers\Controller;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function handleRedirect(Request $request)
    {
        $redirectUrl = $request->query('url');
        if (!$redirectUrl) {
            return redirect()->back()->with('error', 'No redirect URL provided');
        }
        return redirect()->away($redirectUrl);
    }
}
