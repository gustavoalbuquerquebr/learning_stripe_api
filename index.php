<?php

if (!empty($_POST)) {

  require_once "stripe/init.php";

  $customer_email = $_POST["customer"];
  $token = $_POST["stripeToken"];

  try {

    \Stripe\Stripe::setApiKey('sk_test_JPcEkk30fU4fPN4tKS3Y9n3D');

    $customer = \Stripe\Customer::create(array(
    "email" => $customer_email,
    "source" => $token
  ));

    $charge = \Stripe\Charge::create([
    "amount" => 2000,
    "currency" => "usd",
    "description" => "Charge for $customer_email",
    "customer" => $customer
  ]);

    echo "<h1>Customer</h1>";
    echo "<pre>";
    print_r($customer);
    echo "</pre>";
    
    echo "<br><br>";

    echo "<h1>Charge</h1>";
    echo "<pre>";
    print_r($charge);
    echo "</pre>";

  } catch (Exception $e) {
    
    echo "<h1>Error:</h1>";
    echo $e;
  }

  exit;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>

  <main>
  
    <form method="post" id="payment-form">

      <div class="form-row email-row">
        <input type="email" name="customer" placeholder="Email">
      </div>

      <div class="form-row">
        <!-- <label for="card-element">
          Credit or debit card
        </label> -->
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button>Submit Payment</button>
    </form>
  
  </main>

  <script src="https://js.stripe.com/v3/"></script>
  <script src="script.js"></script>
</body>
</html>