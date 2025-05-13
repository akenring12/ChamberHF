<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $invoice = htmlspecialchars($_POST['invoice']);
    $amount = floatval($_POST['amount']) * 100; // convert to cents

    try {
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'receipt_email' => $email,
            'metadata' => [
                'name' => $name,
                'invoice' => $invoice
            ],
        ]);

        // Simulate immediate success in test mode
        header('Location: thank_you.html');
        exit();

    } catch (Exception $e) {
        echo 'Test Payment failed: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request';
}
?>
