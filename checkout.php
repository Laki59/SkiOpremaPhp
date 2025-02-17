<?php

session_start();

if(!empty($_SESSION['cart'])&& isset($_POST['checkout'])){

}else{
    header('location: cart.php?error=Your cart is empty');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php include 'navbar.php';?>


<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Checkout</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
        <form id="checkout-forma" method="POST" action="place_order.php">
        <div class="form-groupa text-center checkout-element">
                <label >Ime</label><br>
                <input type="text" class="forma-kontrole" id="name-checkout" name="ime" value="<?php echo $_SESSION["user_name"];?>" required/>
</div>
            <div class="form-groupa text-center checkout-element">
                <label >Email</label><br>
                <input type="text" class="forma-kontrole" id="email-checkout" name="email" value="<?php echo $_SESSION["user_email"];?>" required/>
</div>
<div class="form-groupa text-center checkout-element ">
                <label>Broj telefona</label><Br>
                <input type="text" class="forma-kontrole" id="number-checkout" name="broj" placeholder="Broj telefona" required/>
</div>
<div class="form-groupa text-center checkout-element">
                <label>Grad</label><Br>
                <input type="text" class="forma-kontrole" id="city-checkout" name="grad" placeholder="Grad" required/>
</div>
<div class="form-groupa text-center checkout-element">
                <label>Adresa</label><Br>
                <input type="text" class="forma-kontrole" id="address-checkout" name="adresa" placeholder="Adresa" required/>
</div>
<div class="form-groupa text-center checkout-btn-container">
                <br><input type="submit" class="btn" id="btn-checkout" name="place_order_btn" value="Kupi sada"/>
                <p>Ukupna cena: <?php echo $_SESSION['total'];?> din.
</div>
</form>
    </div>
</section>


<?php include 'footer.html';?>
</body>
</html>