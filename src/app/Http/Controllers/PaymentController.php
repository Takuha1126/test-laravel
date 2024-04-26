<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $paymentIntent = PaymentIntent::create([
                'amount' => 2000,
                'currency' => 'jpy',
                'payment_method_types' => ['card'],
            ]);


            return view('payment', [
                'stripeKey' => env('STRIPE_PUBLIC_KEY'),
                'paymentIntent' => $paymentIntent
            ]);


        } catch (\Exception $e) {
            return back();
        }
    }

    public function handlePayment(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    try {
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount,
            'currency' => 'jpy',
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }
}

}
