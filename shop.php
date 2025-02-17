
<?php
include('server/connection.php');
session_Start();

if (isset($_POST['search'])) {
  $kategorija = $_POST['kategoriija'];
  $price = $_POST['cena_trazi'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
  $stmt->bind_param("si", $kategorija, $price);
  $stmt->execute();
  $stvari = $stmt->get_result();
} else {
  //proverava da li postoji parametar broj strane(page_no),ako postoji i nije prazan $page_no dobija tu vrednost,ako ne vrednost je 1(prva strana)
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
      $page_no = $_GET['page_no'];
  } else {
      $page_no = 1;
  }
  //gledamo koliko stvari ima,brojimo ih,i storujemo u $total_records
  $stmt1 = $conn->prepare("SELECT COUNT(*) as total_record FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  //hocemo 8 stvari po strani
  $total_records_per_page = 8;
  //offset sluzi da preskace stvari,znaci ako smo na strani 2,preskocice prvih 8 stvari
  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2";
  //ova funkcija broji koliko strana ce trebati ukupno
  $total_no_of_pages = ceil($total_records / $total_records_per_page);

  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
  $stmt2->bind_param("ii", $offset, $total_records_per_page);
  $stmt2->execute();
  $stvari = $stmt2->get_result();
}


if (!$stvari->num_rows) {
  echo "
  <script type='text/javascript'>
      alert('Nema stvari unetih za date kategorije');
      window.location.href = 'shop.php';
  </script>
  ";
  exit; 
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    
    <style>
        
        .pagination a{
            color:blue
        }
        .pagination li:hover a{
            color:#fff;
            background-color: blue;
        }
    </style>
</head>
<body>
<?php include 'navbar.php';?>

<section id="trazi" class="py-5">
  <div class="container mt-2 py-5">
    <p>Pronadji sta ti treba!</p>
    <hr>
  </div>
  
  <form method="POST" action="shop.php">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Kategorija</p>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Pancerice" type="radio" name="kategoriija" id="kategroija_prva" checked>
          <label class="trazi-forma-label" for="kategroija_prva"> Pancerice </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Skije" type="radio" name="kategoriija" id="kategroija_druga">
          <label class="trazi-forma-label" for="kategroija_druga"> Skije </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Rukavice" type="radio" name="kategoriija" id="kategroija_treca">
          <label class="trazi-forma-label" for="kategroija_treca"> Rukavice </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Kaciga" type="radio" name="kategoriija" id="kategroija_cetvrta">
          <label class="trazi-forma-label" for="kategroija_cetvrta"> Kaciga </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Aktivni ves" type="radio" name="kategoriija" id="kategroija_peta">
          <label class="trazi-forma-label" for="kategroija_peta"> Aktivni ves </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Stapovi" type="radio" name="kategoriija" id="kategroija_sesta">
          <label class="trazi-forma-label" for="kategroija_sesta"> Stapovi </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Fantomka" type="radio" name="kategoriija" id="kategroija_sedam">
          <label class="trazi-forma-label" for="kategroija_sedam"> Fantomka </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Vezovi" type="radio" name="kategoriija" id="kategroija_osam">
          <label class="trazi-forma-label" for="kategroija_osam"> Vezovi </label>
        </div>
        <div class="trazi-forma">
          <input class="trazi-forma-input" value="Naocare" type="radio" name="kategoriija" id="kategroija_devet">
          <label class="trazi-forma-label" for="kategroija_devet"> Naocare </label>
        </div>
      </div>
    </div>

    <div class="mx-auto-container mt-2 px-3">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <p>Cena</p>
        <input type="range" name="cena_trazi" class="cena-form w-50" min="1" max="9999" id="cenaRange" oninput="updatePrice(this.value)">
        <div class="w-50">
          <span style="float: left;">1</span>
          <span id="cenaValue" style="font-weight: bold; padding: 0 10px;">5000</span> 
          <span style="float: right;">9999</span>
        </div>
      </div>
    </div>
    <div class="form-group my-2 mx-2">
          <input type="submit" name="search" value="Trazi" class="btn btn-primary">
      </div>
      </form>

<script src="assets/js/slider.js"></script>
</section>


      <!--featured-->
      <section id="featured-shop" class="my-5 py-5">
        <div class="container mt-5 py-3">
          <h3>Nasi proizovdi</h3>
          <hr>
          <p>Nasi proizvodi</p>
        </div>
        <!--row stavlja stvari u red-->
        <div class="row mx-auto container-fluid">

        <?php while($row=$stvari->fetch_assoc()){?>
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
            
            <a href="<?php echo "single.php?product_id=" . $row['product_id'];?>"><button class="buy-btn">Kupi sada</button> </a>
          </div>
          <?php }?>
          <nav aria-label="page navigation example">
            <ul class="pagination mt-5">
                <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">
                  <a class="page-link" href="<?php if($page_no<=1){echo '#';} else{echo "?page_no=".$page_no-1;}?>">Previous</a></li>
                <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                <?php if($page_no >=3){?>
                  <li class="page-item"><a class="page-link" href="#">...</a></li>
                  <li class="page-item"><a class="page-link" href="<?php echo "?page_no=". $page_no; ?>"><?php echo $page_no;?></a></li>
                  <?php }?>
                <li class="page-item <?php if($page_no >= $total_no_of_pages) {echo 'disabled';}?>">
                  <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';} else{echo '?page_no='.$page_no+1;}?>">Next</a></li>
            </ul>
          </nav>
        </div>
</section>



<?php include 'footer.html';?>
  
</body>
</html>