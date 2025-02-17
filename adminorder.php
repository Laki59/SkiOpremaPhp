<?php
    session_start();
    include('server/connection.php');
    include("server/all_orders.php");
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
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

    if (isset($_POST['delete_btn_order'])) {
        // Uzimamo order ID
        $order_id = $_POST['order_id'];
    
        
        $order_id = intval($order_id);
    
        // Upit za brisanje datog Order-a 
        $delete_query = "DELETE FROM orders WHERE order_id = $order_id";
    
        if (mysqli_query($conn, $delete_query)) {
            echo "Usepsno Izbrisan order";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        header("Location: adminorder.php");
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
            <h1 class="mt-4">Admin Order Preview</h1>
            <p>All orders in our database.</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Porudzbina ID</th>
                                    <th>Cena porudzbine</th>
                                    <th>Stauts porudzbine</th>
                                    <th>ID korisnika</th>
                                    <th>Broj korisnika</th>
                                    <th>Grad korisnika</th>
                                    <th>Adresa korisnika</th>
                                    <th>Datum porudzbine</th>
                                    <th>Brisi</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php while ($row = $stvari->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['order_cost']; ?></td>
            <td><?php echo $row['order_status']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['user_phone']; ?></td>
            <td><?php echo $row['user_city']; ?></td>
            <td><?php echo $row['user_address']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td>
                <form method="POST" action="adminorder.php" style="display:inline;">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <input type="submit" value="Brisi" name="delete_btn_order">
                </form>
                </td>
                <td>
    </td>
        </tr>
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