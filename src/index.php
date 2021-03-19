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
$foods = [
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

$drinks = [
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

$validForm = "";
$errorForm = "";

$menu = $foods;

if (isset ($_POST['drink'])) {  
    $menu = $drinks;
} else{
    $menu = $foods;
}


/*if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Email
    if (!empty($_POST["email"])) {
    //     $emailErr = "Email is required";
    //   } else {  ==> remplacé par le ! du filter_var et le required dans le input du form-view.php
        $emailInput = test_input($_POST["email"]);    
        if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
            $emailErr = '<div class="alert alert-primary" role="alert"> Invalid email format </div>';
        };         
      }
    
    // Street
    if (!empty($_POST["street"])) {
    //     $streetErr = "Street is required";
    //   } else { ==> remplacé par le ! du filter_var et le required dans le input du form-view.php
        $streetInput = test_input($_POST["street"]);
    }

    // Street Number
    if (!empty($_POST["streetnumber"])) {
    //     $streetNumberErr = "Street is required";
    //   } else { ==> remplacé par le ! du filter_var et le required dans le input du form-view.php
        $streetNumberInput = test_input($_POST["streetnumber"]);
        if (! is_numeric($streetNumberInput)) {
            $streetNumberErr = '<div class="alert alert-primary" role="alert"> Invalid email format </div>';
        };
      }

    // City
    if (! empty($_POST["city"])) {
    //     $cityErr = "Street is required";
    //   } else { ==> remplacé par le ! du filter_var et le required dans le input du form-view.php
        $cityInput = test_input($_POST["city"]);
      }

    // Zip code
    if (! empty($_POST["zipcode"])) {
    //     $zipcodeErr = "Street is required";
    //   } else { ==> remplacé par le ! du filter_var et le required dans le input du form-view.php
        $zipcodeInput = test_input($_POST["zipcode"]);
      }
}; */

$var="email"; // obligation d'initialiser la variable au premier élément, sinon cela ne fonctionne pas/

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    switch ( $var){
        case "email":
            $emailInput = test_input($_POST["email"]); 
            if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
                $emailErr = '<div class="alert alert-danger" role="alert"> Invalid email format </div>';
            }

        case "street":
            $streetInput = test_input($_POST["street"]);

        case "streetnumber":
            $streetNumberInput = test_input($_POST["streetnumber"]);
            if (!filter_var($streetNumberInput, FILTER_VALIDATE_INT)){
                $streetNumberErr = '<div class="alert alert-danger"role="alert"> Invalid street number format </div>';
            }

        case "city":
            $cityInput = test_input($_POST["city"]);
            
        case "zipcode":
            $zipcodeInput = test_input($_POST["zipcode"]);
    }
};

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
};

if (isset ($_POST['submit'])) {  

    if ($emailErr == "" && $streetErr == "" && $streetNumberErr == "" && $cityErr == "" && $zipcodeErr == "") {  
        $validForm = '<div class="alert alert-success text-center text-uppercase my-4 fs-2" role="alert"> Thank you </div>'; 
    } else {  
        $errorForm = '<div class="alert alert-danger text-center text-uppercase my-4 fs-2" role="alert"> Sorry, there is a mistake </div>';   
    }
}  

require 'form-view.php';