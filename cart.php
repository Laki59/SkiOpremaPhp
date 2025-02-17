<?php

session_start();

if(isset($_SESSION['logged_in'])){
}
else{
    header('location: index.php');
}
if(isset($_POST['addcart_btn'])){

    if(isset($_SESSION['cart'])){
        /*Vraca array sa datim product ID-om */
        $product_lista_id=array_column($_SESSION['cart'],"product_id");
        /*Proverava da li je data stvar vec dodata u array */
        if(!in_array($_POST['product_id'],$product_lista_id)){

            $product_id=$_POST['product_id'];

    
            $product_lista=array(
                'product_id'=>$_POST['product_id'],
                'product_name'=>$_POST['product_name'],
                'product_price'=>$_POST['product_price'],
                'product_image'=>$_POST['product_image'],
                'product_quantity'=>$_POST['product_quantity']
    
            );
            //ubacivanje u korpu
            $_SESSION['cart'][$product_id]=$product_lista;

        }else{
            //ako vec postoji iskace poruka
            echo "<script>alert('Already in cart')</script>";
        }

    }else{
        //ako cart ne postoji mi ga pravimo
        $product_id=$_POST['product_id'];
        $product_lista=array(
            'product_id'=>$_POST['product_id'],
            'product_name'=>$_POST['product_name'],
            'product_price'=>$_POST['product_price'],
            'product_image'=>$_POST['product_image'],
            'product_quantity'=>$_POST['product_quantity']

        );
        
        $_SESSION['cart'][$product_id]=$product_lista;
    }


    TotalCart();

}else if(isset($_POST['remove_btn'])){
    $product_id=$_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header('location: cart.php');
    TotalCart();

}else{
   //header('location: index.php');
}

function TotalCart(){
    $total=0;
    foreach($_SESSION['cart'] as $key=>$value){
        $product=$_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity=$product['product_quantity'];

        $total =$total +($price * $quantity);
    }
    $_SESSION['total'] = $total;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php include 'navbar.php';?>

      <section class="kolica container my-5 py-5">
      <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <!--top margina za kontejner bug-->
        <div class="container mt-5">
            <h2 class="font-weight-bold">Vasa kolica</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Proizvod</th>
                <th>Kolicina</th>
                <th>Cena</th>
            </tr>
            <?php if (!empty($_SESSION['cart'])) { ?>
    <?php foreach($_SESSION['cart'] as $key => $value) { ?>
        <tr>
            <td>
                <div class="info">
                    <img src="assets/imgs/proizvod/<?php echo $value['product_image']; ?>" />
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span></span><?php echo $value['product_price']; ?> din.</small>
                        <br>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                            <input type="submit" name="remove_btn" class="remove-btn" value="Remove" />
                        </form>
                    </div>
                </div>
            </td>
            <td>
                <input type="number" name="product_quantity" readonly value="<?php echo $value['product_quantity']; ?>">
            </td>
            <td>
                <span></span>
                <span class="proizvod"><?php echo $value['product_quantity'] * $value['product_price']; ?> din.</span>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="3" style="text-align: center;">Kolica su prazna</td>
    </tr>
<?php } ?>
        </table>
        
        <div class="kolica-total">
            <table>
                <tr>
                    <td>Totalna cena</td>
                    <td><?php echo $_SESSION['total'];?> din.</td>
                </tr>
            </table>
        </div>

        <div class="kupi-kontejner">
            <form method="POST" action="checkout.php">
            <input type="submit" class="kupi-btn" value="Kupi" name="checkout">
            </form>
        </div>
      </section>




      <?php include 'footer.html';?>


</body>
</html>