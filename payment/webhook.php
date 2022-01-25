<?php
require 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production.-
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51IlqZlFnEnNhg8SkY64QMeG1gr7U0LdtDcQ0ORO3wpl2Hm2ehk1OXX4QPi4DHkdwR6W0qvSzKo1Zptwr3PghvLPj00ACROSwVs');
  
// If you are testing your webhook locally with the Stripe CLI you
// can find the endpoint's secret by running `stripe listen`
// Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
$endpoint_secret = 'whsec_h88YETXt1ls4VZHSenFXZY2srIg3V42n';

$payload = file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch(\UnexpectedValueException $e) {
    // Invalid payload
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    http_response_code(400);
    exit();
}

// Handle the event
switch ($event->type) {
    // Example:
    //
    // case 'payment_intent.succeeded':
    //     $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
    //     handlePaymentIntentSucceeded($paymentIntent);
    //     break;
    // case 'payment_method.attached':
    //     $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
    //     handlePaymentMethodAttached($paymentMethod);
    //     break;

    case 'checkout.session.completed':
        $session = $event->data->object;
        error_log("paid111");
        error_log($session);
        error_log($session->customer_details->email);
        $host = "evelinka99.atthost24.pl";
        $db_user = "5795_richshop";
        $db_password = "Xs0@*t1U#B36p";
        $db_name = "5795_richshop";

        $email = $session->customer_details->email;
        $product = $session->metadata->product_name;
        $amount_total = $session->amount_total;
        $currency = $session->currency;
        $payment_method = $session->payment_method_types[0];
        $payment_status = $session->payment_status;

        $conn= mysqli_connect($host,$db_user,$db_password,$db_name);
        $sql = "INSERT INTO orders (email, product, amount_total, currency, payment_method, payment_status) VALUES ('$email', '$product', '$amount_total', '$currency', '$payment_method', '$payment_status')";
        $conn->query($sql) === TRUE;

    // ... handle other event types
    default:
        echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);