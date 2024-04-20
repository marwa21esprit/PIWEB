<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Stripe\SetupIntent;

class StripeController extends AbstractController
{
    #[Route('/process-payment', name: 'process_payment')]
    public function processPayment(Request $request): Response
    {
        // Set your Stripe API key
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

        // Get the payment method ID and return URL from the request
        $paymentMethodId = $request->request->get('payment_method_id');
        $returnUrl = 'http://127.0.0.1:8000/process-payment'; // Replace with your actual return URL

        try {
            // Create a Setup Intent with the provided payment method
            $setupIntent = SetupIntent::create([
                'payment_method' => $paymentMethodId,
                'confirm' => true, // Automatically confirm the SetupIntent
                'return_url' => $returnUrl, // Specify the return URL
            ]);

            // Extract the client secret from the Setup Intent
            $setupIntentClientSecret = $setupIntent->client_secret;

            // Pass the client secret to the frontend template
            return $this->render('stripe/index.html.twig', [
                'setup_intent_client_secret' => $setupIntentClientSecret,
            ]);
        } catch (\Exception $e) {
            // Handle error
            return $this->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
