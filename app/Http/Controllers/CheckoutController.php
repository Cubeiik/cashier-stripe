<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $plan = 'price_1QBGrcLLPuMGGl8ZwdLHlGMr')
    {
        return $request->user()
                ->newSubscription('prod_R3NcBAshYK1HgC', $plan)
                ->checkout([
                    'success_url' => route('success'),
                    'cancel_url' => route('dashboard'),
                ]);
    }
}
