<?php
    session_start();
    include('server/connection.php');
    include("server/all_users.php");
    if (!isset($_SESSION['user_id']) ) {
        header('Location: index.php'); // Redirekcija na index ako nisi ulogovan
        exit();
    }

    // Uzimamo ID iz sesije
    $user_id = $_SESSION['user_id'];

    // User koji je ulogovan pretrazujemo BP pomocu njegovom ID-a i pitamo se da li je admin
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['admin'] !== 'da') {
        header('Location: index.php');
        exit();
    }

    /*dugme za brisanje */
    if (isset($_POST['delete_btn'])) {
        $user_id = $_POST['user_id'];
    
        // Uzimamo user ID
        $user_id = intval($user_id);
    
        // Upit za brisanje datog Order-a 
        $delete_query = "DELETE FROM users WHERE user_id = $user_id";
        $delete_order_query ="DELETE FROM orders WHERE user_id = $user_id";
    
        if (mysqli_query($conn, $delete_query)) {
            echo "Dobro obrisano";
        } else {
            echo "Brisanje usera je lose: " . mysqli_error($conn);
        }
        if (mysqli_query($conn, $delete_order_query)) {
            echo "Dobro brisanje";
        } else {
            echo "Brisanje je lose: " . mysqli_error($conn);
        }
    
        header("Location: admin.php");
        exit();
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
<style>
        body {
            font-family: Arial, sans-serif;
            margin-top:30px;
        }
        
    </style>
</head>
<body>
<?php include 'adminsidebar.html';?>

    <div id="content">
        <div class="container-fluid">
            <h1 class="mt-4">Svi korisnici</h1>
            <p>u nasoj bazi podataka</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Korisnik ID</th>
                                    <th>Ime</th>
                                    <th>Email</th>
                                    <th>Sifra</th>
                                    <th>Admin</th>
                                    <th>Brisi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($row=$ljudi->fetch_assoc()){
                                ?>
                                <?php
                                echo "<tr><td>" . $row['user_id'] . "</td><td>" . $row['user_name'] . "</td><td>" . $row['user_email'] . "</td><td>" . $row['user_password'] . "</td><td>" . $row['admin'] . "</td><td><form method='POST' action='admin.php'> <input type='hidden' name='user_id' value='" . $row['user_id'] . "'> <input type='submit' value='Brisi' name='delete_btn'> </form></td></tr>";
                                ?>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>