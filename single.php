<?php
session_start();
include('server/connection.php');
if(isset($_SESSION['logged_in'])){
if(isset($_GET['product_id']))
{
  $product_id=$_GET['product_id'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
  $stmt->bind_param("i",$product_id);

  $stmt ->execute();

  $product = $stmt -> get_result();

}else{
  header('location: index.php');
}
}else{
  header('location: login.php?error=U must log in first');
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

      <section class="single-product my-5 pt-5">
        <div class="row mt-5">
          <?php while($row =$product->fetch_assoc()){?>
            <div class="col-lg-5 col-md-6 col-md-12">
                <img class="img-fluid w-80 pb-1" src="assets/imgs/proizvod/<?php echo $row['product_image']; ?>" id="glavnaSlika"/>
                <div class="small-slika-group">
                    <div class="small-slika-col">
                    <img class="small-slika"   width="100%" src="assets/imgs/proizvod/<?php echo $row['product_image']; ?>"/>
                    </div>
                    <div class="small-slika-col">
                      <!--onerror obezbedjuje da ako pomocne slike nisu ubacene da se prikazuju kao prazne kutije i da nemaju "no data" slicicu u gornjem levom uglu-->
                    <img class="small-slika" width="100%" onerror="this.style.display='none'"  src="assets/imgs/proizvod/<?php echo $row['product_image2']; ?>"/>
                    </div>
                    <div class="small-slika-col">
                    <img class="small-slika" width="100%" onerror="this.style.display='none'"   src="assets/imgs/proizvod/<?php echo $row['product_image3']; ?>"/>
                    </div>
                    <div class="small-slika-col">
                    <img class="small-slika" width="100%" onerror="this.style.display='none'" src="assets/imgs/proizvod/<?php echo $row['product_image4']; ?>"/>
                    </div>
                </div>
            </div>
          
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h6><?php echo $row['product_category']; ?></h6>
                <!--proveri padding ako treba i margine-->
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2><?php echo $row['product_price']; ?> din.</h2>
                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                  <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                  <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                  <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                  <input type="number" name="product_quantity" value="1"/>
                  <button class=buy-btn type="submit" name="addcart_btn">Dodaj u korpu</button>
                </form>
                <h4 class="mt-5 mb-5">Detalji proizvoda</h4>
                <span><?php echo $row['product_description']; ?></span>
            </div>
            <?php }?>
        </div>
      </section>

      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Nasi najbolji proizvodi!</h3>
          <hr>
          <p>Nasi proizovdi</p>
        </div>
        <!--fluid stavlja stvari kako treba-->
        <div class="row mx-auto container-fluid">
          <!--PHP KOD KOJI PROLAZI KROZ BAZU I UZIMA PRVA 4 PROIZVODA-->
        <?php include('server/get_featured_products.php');?>

        <?php while($row=$featured_products->fetch_assoc()){?>
          <div onclick="window.location.href='<?php echo "single.php?product_id=" . $row['product_id'];?>'" class="proizvod text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/imgs/proizvod/<?php echo $row['product_image'];?>"/>
            <div class="Star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row['product_name'];?></h5>
            <h4 class="p-price"><?php echo $row['product_price'];?> din.</h4>
          <a href="<?php echo "single.php?product_id=" . $row['product_id'];?>"><button class="buy-btn">Buy now</button> </a>
          </div>
          <?php }?>

        </div>
</section>


<?php include 'footer.html';?>



    <!--JS nadjena na netu za zamenu fokusa slika-->
    <script src="assets/js/slika.js"></script>
</body>
</html>