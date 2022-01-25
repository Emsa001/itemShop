<?php
  $price = 10000;
  $image = "https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171__340.jpg";
  $method = "card";
  
if($_POST['productname'] == "Modern"){
  $price = 200;
  $image = "https://cdn.pixabay.com/photo/2015/04/19/08/32/marguerite-729510__340.jpg";
}else if($_POST['productname'] == "Pro"){
  $price = 5000;
  $image = "https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171__340.jpg";
}else if($_POST['productname'] == "Starter"){
  $price = 1000;
  $image = "https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171__340.jpg";
}else if($_POST['productname'] == "Premium"){
  $price = 3000;
  $image = "https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171__340.jpg";
}else if($_POST['productname'] == "Business"){
  $price = 10000;
  $image = "https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171__340.jpg";
}

if($_POST['pmet']){
  $method = "p24";
}else{
  $method = "card";
}

require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51IlqZlFnEnNhg8SkY64QMeG1gr7U0LdtDcQ0ORO3wpl2Hm2ehk1OXX4QPi4DHkdwR6W0qvSzKo1Zptwr3PghvLPj00ACROSwVs');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/richshop/';



$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => [$method],
  "metadata" => ["product_name" => $_POST['productname']],
  'line_items' => [[
    'price_data' => [
      'currency' => 'pln',
      'unit_amount' => $price,
      'product_data' => [
        'name' => 'RichShop - '.$_POST['productname'],
        'images' => [$image],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/payment/success.php', // nice nie weryfikujesz, zakladasz ze dostales mamone (chyba)
  'cancel_url' => $YOUR_DOMAIN . '/payment/cancel.php', // nice nie weryfikujesz, zakladasz ze nie dostales mamony (chyba)
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
