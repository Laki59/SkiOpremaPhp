<?php
session_start();
include('server/connection.php');
$error=$_GET['error'];

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['btn_login'])){

    $email=$_POST['email'];
    $password=$_POST['sifra'];
    /*Pravimo statement koji ce uzeti sve iz usrea i pomocu njega trazimo koriisnika koji ima bas taj email i bas taj password */
    $stmt=$conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email=? AND user_password=? LIMIT 1");
    $stmt->bind_param('ss',$email,$password);

    if($stmt->execute()){
        $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
        $stmt->store_result();
        if($stmt->num_rows()==1){
            $stmt->fetch();
            $_SESSION['user_id']= $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            header('location: account.php?message=Uspesno logovanje');
        }else{
            header('location: login.php?error=Los unos Emaila ili sifre.');
        }
    }else{
        header('location: login.php?error=Something went wrong');
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
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="login-forma" method="post" action="login.php">
            <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
            <div class="form-groupa text-center">
                <label >Email</label><br>
                <input type="text" class="forma-kontrole" id="email-login" name="email" placeholder="Email" required/>
</div>
<div class="form-groupa">
                <label>Sifra</label><Br>
                <input type="password" class="forma-kontrole" id="sifra-login" name="sifra" placeholder="Sifra" required/><br>
                <input type="checkbox" onclick="myFunction()">Prikazi lozinku
</div>
<div class="form-groupa">
                <br><input type="submit" class="btn" id="btn-login" name="btn_login" value="Login"/>
</div>
<div class="form-groupa">
                <a id="registracija" href="register.php" class="btn">Nemate nalog? Registruji se!</a>
</div>
</form>
    </div>
</section>
<script src="assets/js/passwordShow.js">
</script>

<?php include 'footer.html';?>
</body>
</html>
