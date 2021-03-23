<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order pizzas in restaurant "the Personal Pizza Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order pizzas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post" >
        <p><span class="error">* Required field</span></p>
        <div class="form-row">
            <div class="form-group col-md-6">
                
                <label for="email">E-mail: </label> 
                <span class="error">* </span> <?php echo $emailErr;?>
                <input type="text" id="email" name="email" class="form-control" value="<?php echo $emailInput;?>" required />
                
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <span class="error">* <?php echo $streetErr;?></span>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $streetInput;?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <span class="error">* <?php echo $streetNumberErr;?></span>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $streetNumberInput;?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <span class="error">* <?php echo $cityErr;?></span>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo $cityInput;?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <span class="error">* <?php echo $zipcodeErr;?></span>
                    <input type="number" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcodeInput;?>" required>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products <span class="error">* <?php echo $menuErr;?></span> </legend>
            
            <?php foreach ($menu AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
            
        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in pizza(s) and drinks.</footer>
</div>  

<?php

echo $validForm;
echo $errorForm;
echo "<h2>Your order</h2>";
echo $emailInput . "<br>";
echo $streetInput . "<br>";
echo $streetNumberInput . "<br>";
echo $cityInput . "<br>";
echo $zipcodeInput . "<br>";
// echo $menuInput . "<br>";
echo $deleveryTime . "<br>";
echo $choiceMenu . "<br>";
?>

<style>
    footer {
        text-align: center;
    }
    .error {
        color: red;
    }
</style>
</body>
</html>
