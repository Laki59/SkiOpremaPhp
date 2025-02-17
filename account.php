<?php
session_start();
include('server/connection.php');

/*Da li sesija postoji? da nastavi dalje. ne? na login.php */
if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}
/*Referenca stackoverflow,pitamo se da li hocemo logout,ako da,pitamo da li smo ulogovani,ako da unsetujemo  sve vrednosti i redirektujemo ka login.php */
if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        session_unset();
        exit;
    }
}

/*Ako je user ulogovan uzimamo njegove narudzbine */
if(isset($_SESSION['logged_in'])){

    $user_id=$_SESSION['user_id'];
    $stmt=$conn->prepare("SELECT * FROM orders WHERE user_id=?");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $proizvodi=$stmt->get_result();
}

/*Menjanje password */
if(isset($_POST['change_password'])){
    $password=$_POST['password'];
    $confirm_password= $_POST['password-confirm'];
    $email=$_SESSION['user_email'];

    if($password !== $confirm_password){
        header("location: account.php?error=Password don't match");
    }
    else if(strlen($password) < 5) {
        header('location: account.php?error=Password must be longer than 5 characters');
}
else{
   $stmt= $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
   $stmt->bind_param("ss",$password,$email);

   if($stmt->execute()){
    header('location: account.php?message=Password has been changed successfully.');
   }
   else{
    header('location: account.php?error=Coulndt update he password.');
   }
}
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
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p style="color:red" id="form-error">
                <?php if (isset($_GET['error'])) { echo $_GET['error']; } ?>
            </p>
            <p style="color:green" id="form-error">
                <?php if (isset($_GET['message'])) { echo $_GET['message']; } ?>
            </p>
            <h3> Vas nalog </h3>
            <div class="nalog-info">
                <p><b>Ime: </b><span><?php echo $_SESSION["user_name"];?></span></p>       
                <p><b>Email: </b><span><?php echo $_SESSION["user_email"];?></span></p>  
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <form id="sifra-form" method="post" action="account.php">
                <h3>Promeni lozinku</h3>
                <div class="form-groupa">
                    <label>Lozinka</label><br>
                    <input type="password" class="kontrola-forma" id="nalog-sifra" placeholder="Lozinka" name="password">
                </div>
                <br>
                <div class="form-groupa">
                    <label>Potvrdi Lozinku</label><br>
                    <input type="password" class="kontrola-forma" id="nalog-password-confirm" placeholder="Potvrdi Lozinku" name="password-confirm">
                </div>
                <br>
                <div class="form-groupa">
                    <input type="submit" value="Promeni lozinku" name="change_password" class="btn" id="btn-change">
                </div>
            </form>
        </div>
    </div>
</section>

<section class="proizvod container my-2 py-2">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Vase porudzbine</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
            <th>ID porudzbine</th>
                <th>Cena porudzbine</th>
                <th>Status porudzbine</th>
                <th>Datum porudzbine</th>
                <th>Detalji</th>
            </tr>
            <?php while($row=$proizvodi->fetch_assoc()){  ?>
            <tr>
                <td>
                <span><?php echo $row['order_id'];?></span>
                </td>
                <td>
                    <span><?php echo $row['order_cost'];?></span>
                </td>
                <td>
                    <span><?php echo $row['order_status'];?></span>
                </td>
                <td>
                <span><?php echo $row['order_date'];?></span>
                </td>

                <td>
                    <form method="POST" action="order_details.php">
                        <input type="hidden" value="<?php echo $row['order_id']; ?>" name='order_id'/>
                        <input class="btn proizvod-detalji-btn" name="detalji-btn" type="submit" value="Detalji"/>
                   </form>
              </td>
            </tr>

            <?php } ?>
        </table>
        
      </section>


<?php include 'footer.html';?>
</body>
</html>