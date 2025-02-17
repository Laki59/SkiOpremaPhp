<?php
    session_start();
    include('server/connection.php');
    include("server/all_products.php");
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
        $product_id = $_POST['product_id'];
    
        
        $product_id = intval($product_id);
    
        // Upit za brisanje datog Order-a 
        $delete_query = "DELETE FROM products WHERE product_id = $product_id";
    
        if (mysqli_query($conn, $delete_query)) {
            echo "Usepsno Izbrisan order";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        header("Location: adminProducts.php");
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 30px;
        }
        .add-product-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
<?php include 'adminsidebar.html';?>

    <div id="content">
        <div class="container-fluid">
            <h1 class="mt-4">Svi proizvodi</h1>
            <p>U nasoj bazi podataka</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID proizvoda</th>
                                    <th>Ime proizvoda</th>
                                    <th>Kategorija proizvoda</th>
                                    <th>Proizvod velika slika</th>
                                    <th>Proizvod mala slika 1</th>
                                    <th>Proizvod mala slika 2</th>
                                    <th>Proizvod mala slika 3</th>
                                    <th>Proizvod cena</th>
                                    <th>Proizvod boja</th>
                                    <th>Brisi</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php while ($row = $all_products->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['product_category']; ?></td>
            <td><?php echo $row['product_image']; ?></td>
            <td><?php echo $row['product_image2']; ?></td>
            <td><?php echo $row['product_image3']; ?></td>
            <td><?php echo $row['product_image4']; ?></td>
            <td><?php echo $row['product_price']; ?></td>
            <td><?php echo $row['product_color']; ?></td>
            <td>
                <form method="POST" action="adminProducts.php" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="submit" value="Brisi" name="delete_btn_order">
                </form>
            </td>
            <td>
                <a href="adminProductEdit.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
            </td>
        </tr>
    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Product Button -->
        <a href="adminAdd.php" class="btn btn-success btn-lg add-product-btn">
            <i class="fa fa-plus"></i> Add Product
        </a>
    </div>

</body>
</html>
