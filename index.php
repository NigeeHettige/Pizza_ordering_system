<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4.3</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        /* *{
            margin: 0 auto;
            padding: 0;
        } */

        #inputNumberPizza, #inputNumberBurger{
            display: none;
        }   

    </style>

</head>
<body>
<div class="container">
<script>
    function isCheckedPizza(){
        var x = document.getElementById("inputNumberPizza");
        var check = document.getElementById("checkBoxPizza");
        if(check.checked == true){
            x.style.display = 'inline';
            //console.log(checkbox.checked);
        }
        else{
            x.style.display = 'none';
        }
    }
    function isCheckedBurger(){
        var x = document.getElementById("inputNumberBurger");
        var check = document.getElementById("checkBoxBurger");
        if(check.checked == true){
            x.style.display = 'inline';
            //console.log(checkbox.checked);
        }
        else{
            x.style.display = 'none';
        }
    }
</script>

    

<?php

    if(isset($_POST["step"])){
        if($_POST["step"] == "1"){
            display2();
        } else if($_POST["step"] == "2"){
            process2();
        }

    } else {
        display1();
    }

    function process2(){
        if(isset($_POST["back"]) and $_POST["back"] == "Back"){
            display1();
        } else {
            display3();
            setcookie("name","",time()-3600);
            setcookie("address","",time()-3600);
            setcookie("mobile","",time()-3600);
        }
    }

    function calculateAmount(){
        $pizzaAmount = 0;
        $burgerAmount = 0;
        if(isset($_POST["pizza"]) and isset($_POST["pizzaitem"]) and $_POST["pizza"] > 0){
            $pizzaAmount = $_POST["pizza"] * 1000;
        } 
        if(isset($_POST["burger"]) and isset($_POST["burgeritem"]) and $_POST["burger"] > 0){
            $burgerAmount = $_POST["burger"] * 500;
        }
        return ($pizzaAmount + $burgerAmount);
        
    }

    function setValue($name){
        if(isset($_POST[$name])){
            setcookie($name,$_POST[$name]);
            echo $_POST[$name];
        }
    } 


    function Print_Value($name){
        if(isset($_COOKIE[$name])){
            echo $_COOKIE[$name];
        }
    }

    function Print_textArea($text){
        echo $_COOKIE[$text];
    }
   


    function display1(){
?>
    <div>
    <form action="index.php" method="POST">
        <input type="hidden" name="step" value="1">
        <h2>Incredible Food: Step 1: Customer details</h2>
        
        <label for="name">Name : </label>
        <input type="text" name="name" value="<?php isset($_POST['name'])? Print_Value('name'): setValue("name")?>"><br>
        <br><br>


        <label for="mobile">Mobile : </label>
        <input type="tel" name="mobile" value="<?php isset($_POST['mobile'])? Print_Value('mobile'): setValue("mobile")?>"><br>
        <br><br>


        <label for="address">Address : </label>
        <textarea name="address" id="address" cols="20" rows="5"  ><?php isset($_POST['address'])? Print_textArea('address'): setValue("address")?></textarea><br>
        <br><br>

        <input type="submit" name="submitted" class ="btn">
    </form>
    </div>
<?php
    }

    function display2(){
?>
    <form action="index.php" method="POST">
        <input type="hidden" name="step" value="2">
        <h2>Incredible Food: Step 2: Your Order</h2>

        <p>Select Item</p>
        <input type="checkbox" name="pizzaitem" id="checkBoxPizza" onclick="isCheckedPizza()"   >
        <label for="pizza">Pizza (Rs: 1000/=)</label>
        <input type="number" id="inputNumberPizza" name="pizza" value="<?php setValue("pizza")?>" placeholder= "Quantity">
        <br>
        <input type="checkbox" name="burgeritem" id="checkBoxBurger" onclick="isCheckedBurger()">
        <label for="burger">Burger (Rs: 500/=)</label>
        <input type="number" id="inputNumberBurger" name="burger" value="<?php setValue("burger")?>" placeholder= "Quantity">
        <br><br>

        <!-- store values -->
        <input type="hidden" name="name" value="<?php setValue("name")?>">
        <input type="hidden" name="mobile" value="<?php setValue("mobile")?>">
        <input type="hidden" name="address" value="<?php setValue("address")?>">
        <input type="hidden" name="amount" value="<?php calculateAmount()?>">

       <center>
        <input type="submit" name="back" value="Back" class ="btn">
        <input type="submit" name="next" value="Place Order" class ="btn">
        </center>
    </form>

<?php
    }

    function display3(){
?>
    <form action="index.php" method="POST">
        <input type="hidden" name="step" value="3">
        <h2>Thank You!</h2>

        <label for="name">Name : </label>
        <p><?php echo $_POST["name"]?></p>
        <br>
        <label for="mobile">Mobile : </label>
        <p><?php echo $_POST["mobile"]?></p>
        <br>
        <label for="address">Address : </label>
        <p><?php echo $_POST["address"]?></p>

        <p>Your order has been placed for amount of <?php echo " Rs.".calculateAmount()?></p>

    </form>

<?php
    }
?>
</div>
</body>
</html>