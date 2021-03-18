<?php


//this line makes PHP behave in a more strict way
// declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
// session_start();

function whatIsHappening() {
    // echo '<h2>$_GET</h2>';
    // var_dump($_GET);
    // echo '<h2>$_POST</h2>';
    // var_dump($_POST);
    // echo '<h2>$_COOKIE</h2>';
    // var_dump($_COOKIE);
    // echo '<h2>$_SESSION</h2>';
    // var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Margherita', 'price' => 8],
    ['name' => 'Hawaï', 'price' => 8.5],
    ['name' => 'Salami pepper', 'price' => 10],
    ['name' => 'Prosciutto', 'price' => 9],
    ['name' => 'Parmiggiana', 'price' => 9],
    ['name' => 'Vegetarian', 'price' => 8.5],
    ['name' => 'Four cheeses', 'price' => 10],
    ['name' => 'Four seasons', 'price' => 10.5],
    ['name' => 'Scampi', 'price' => 11.5]
];

$products = [
    ['name' => 'Water', 'price' => 1.8],
    ['name' => 'Sparkling water', 'price' => 1.8],
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 2.2],
];

$totalValue = 0;

// define variables and set to empty values
$emailInput = $streetInput = $streetNumberInput = $cityInput = $zipcodeInput = "";
$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipcodeErr = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // var_dump($_POST['email']);
    // echo $_POST['street'];
    // $emailInput = test_input($_POST['email']);
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $emailInput = test_input($_POST["email"]);
            
        if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        };
            
      }
    
    // $streetInput = test_input($_POST['street']);
    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
      } else {
        $streetInput = test_input($_POST["street"]);
      }

    // $streetNumberInput = test_input($_POST['streetnumber']);
    if (empty($_POST["streetnumber"])) {
        $streetNumberErr = "Street is required";
      } else {
        $streetNumberInput = test_input($_POST["streetnumber"]);
        if (! is_numeric($streetNumberInput)) {
            $streetNumberErr = "Invalid street number";
        };
      }

    // $cityInput = test_input($_POST['city']);
    if (empty($_POST["city"])) {
        $cityErr = "Street is required";
      } else {
        $cityInput = test_input($_POST["city"]);
      }

    // $zipcodeInput = test_input($_POST['zipcode']);
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Street is required";
      } else {
        $zipcodeInput = test_input($_POST["zipcode"]);
      }
};

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require 'form-view.php';