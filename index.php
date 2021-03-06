<?php
session_start();

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
$pizza = [
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
$emailInput = $streetInput = $streetNumberInput = $cityInput = $zipcodeInput = $menuInput= "";
$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipcodeErr = $menuErr = "";

$validForm = "";
$errorForm = "";

$menu = $pizza;

$localTime= localtime();
$minute = $localTime[1];
$heure = $localTime[2]+1; // + 1 car nous sommes au fuseau horaire +1
if($minute<10){
    $minute= '0'.$minute;
}

$deleveryTime = ""; 
$choiceMenu ="";

// changement entre menu pizza et drink. GET est utilisé ca c'est sur base de des donnée dans url qu'on va effecté le changement. 
if(isset($_GET['food'])){
    // pas de valeur car c'est la valeur par défaut qui équivaut
    if($_GET['food'] == false){
        $menu = $drinks;
    }
}


/* Code détaillé
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Email
    if (!empty($_POST["email"])) {
    $emailErr = "Email is required";
    } else {  ==> remplacé par le ! du filter_var et le required dans le input du form-view.php
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
    
    //checkbox
    if (!isset ($_POST["products"])) {  
            $menuErr = '<div class="alert alert-danger"role="alert"> Invalid selection </div>';  
    } 
}; */

$var="email"; // obligation d'initialiser la variable au premier élément, sinon cela ne fonctionne pas/

// code compressé
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

        //checkbox
        case "products":
            $menuInput = ['products'];
            if (!isset ($_POST["products"])){
                $menuErr = '<div class="alert alert-danger"role="alert"> Invalid selection </div>';  
            }
        }
};

//Fonction pour filter les données encodée
function test_input($data) {
    $data = trim($data); // espace innutile
    $data = stripslashes($data); // supprime les anti slach
    $data = htmlspecialchars($data); // évite les caractères spéciaux. 
    return $data;
};



// bouton de validation
if (isset ($_POST['submit'])) {  

    if(isset($_POST['products'])){
        
        $food = $_POST['products'];
        foreach($food AS $i => $choice){
            $choiceMenu = $menu[$i]['name'];
            $choice= $menu[$i]['price'];
            $totalValue += $choice;
        }
    };

    if ($emailErr == "" && $streetErr == "" && $streetNumberErr == "" && $cityErr == "" && $zipcodeErr == ""&& $menuErr == "") {  
        $validForm = '<div class="alert alert-success text-center text-uppercase my-4 fs-2" role="alert"> Thank you </div>';

        // Express delivery
        if (isset ($_POST['express_delivery'])){
            $minute = $minute + 30;
            if($minute >= 60){
            $heure = $heure - 1 ;
            $minute = $minute - 60;
            }

            $deleveryTime = "Delivery will arrive at ". $heure . ": " . $minute;
            $totalValue = 5; // pour ajouter le prix des l'express delivery au prix total
            
        }else{
            $deleveryTime = "Delivery will arrive at ". $heure + 1 . ": " . $minute; 
        };

        echo $validForm;
        echo $errorForm;
        // echo $emailInput . "<br>";
        // echo $streetInput . "<br>";
        // echo $streetNumberInput . "<br>";
        // echo $cityInput . "<br>";
        // echo $zipcodeInput . "<br>";
        echo '<div class="alert alert-primary text-center text-uppercase my-4 fs-2" role="alert">';
        echo "<h2>Your order</h2>";
        echo $deleveryTime . "<br>";
        echo "TOTAL amount: " .$totalValue . " euro <br>";
        echo '</div>';

    } else {  
        $errorForm = '<div class="alert alert-danger text-center text-uppercase my-4 fs-2" role="alert"> Sorry, there is a mistake </div>';   
    };
}

require 'form-view.php';
