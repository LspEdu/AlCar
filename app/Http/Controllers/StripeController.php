<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function pagos(Request $request)
    {
        $request->user()->createOrGetStripeCustomer();

        return $request->user()->redirectToBillingPortal(route('dashboard'));
    }


}
