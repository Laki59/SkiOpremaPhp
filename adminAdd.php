<?php
    session_start();
    include('server/connection.php');

    // Vidimo da li je user admin
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['admin'] !== 'da') {
        header('Location: index.php');
        exit();
    }

    // File upload
    $upload_dir = 'assets/imgs/proizvod/';  //Direktorijum za slike

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $product_special_offer = $_POST['product_special_offer'];
        $product_color = $_POST['product_color'];
        $product_category = $_POST['product_category'];

        // Procesujemo svaku sliku
        $product_image = uploadImage('product_image');
        $product_image2 = uploadImage('product_image2');
        $product_image3 = uploadImage('product_image3');
        $product_image4 = uploadImage('product_image4');

        // Insertujemo u data base
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_special_offer, product_color, product_category, product_image, product_image2, product_image3, product_image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssssss", $product_name, $product_description, $product_price, $product_special_offer, $product_color, $product_category, $product_image, $product_image2, $product_image3, $product_image4);

        if ($stmt->execute()) {
            header("location:adminProducts.php");
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }

    // Funkcija za upload fajla
    function uploadImage($input_name) {
        global $upload_dir;
        //proverava da li je fajl uplodovan,i da je error 0
        if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] == 0) {
            //Uzima ime fajla
            $file_name = basename($_FILES[$input_name]['name']);
            $target_path = $upload_dir . $file_name;  // Pravi putanju gde fajl treba da bude sacuvan

            // Proverava da li postoji data slika
            if (file_exists($target_path)) {
                // Izbacuje gresku ako postoji
                echo "<div class='alert alert-info'>File with name '$file_name' already exists. Skipping upload.</div>";
                return $file_name;
            }

            // Proverava da li je fajl slika putem MIME tipa
            $file_type = mime_content_type($_FILES[$input_name]['tmp_name']);
            if (strpos($file_type, 'image') === false) {
                echo "<div class='alert alert-danger'>Only images are allowed for file: " . $file_name . "</div>";
                return null;
            }

            if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_path)) {
                return $file_name; 
            } else {
                echo "<div class='alert alert-danger'>Error uploading file: " . $file_name . "</div>";
                return null;
            }
        }
        return null;  // Vrati nulu ako nema uplodovanog fajla
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
        input.form-control, textarea.form-control {
            border-radius: 0;
        }
    </style>
</head>
<body>
<?php include 'adminsidebar.html';?>

<body>
<div class="container col-lg-12 col-md-12 col-sm-12 mt-5">
    <h1 class="mb-4">Dodaj novu stvar</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Ime proizvoda</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Deskripcija proizvoda</label>
            <textarea class="form-control" id="product_description" name="product_description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="product_price" class="form-label">Cena proizvoda</label>
            <input type="text" step="0.01" class="form-control" id="product_price" name="product_price" required>
        </div>

        <div class="mb-3">
            <label for="product_special_offer" class="form-label">Special Offer</label>
            <input type="text" step="0.01" class="form-control" id="product_special_offer" name="product_special_offer">
        </div>

        <div class="mb-3">
            <label for="product_color" class="form-label">Boja proizvoda</label>
            <input type="text" class="form-control" id="product_color" name="product_color" required>
        </div>

        <div class="mb-3">
            <label for="product_category" class="form-label">Kategorija proizvoda</label>
            <input type="text" class="form-control" id="product_category" name="product_category" required>
        </div>

        <div class="mb-3">
            <label for="product_image" class="form-label">Glavna slika proizvoda</label>
            <input type="file" class="form-control" id="product_image" name="product_image" required>
        </div>

        <div class="mb-3">
            <label for="product_image2" class="form-label">Dodatna slika proizvoda 1</label>
            <input type="file" class="form-control" id="product_image2" name="product_image2">
        </div>

        <div class="mb-3">
            <label for="product_image3" class="form-label">Dodatna slika proizvoda 2</label>
            <input type="file" class="form-control" id="product_image3" name="product_image3">
        </div>

        <div class="mb-3">
            <label for="product_image4" class="form-label">Dodatna slika proizvoda 3</label>
            <input type="file" class="form-control" id="product_image4" name="product_image4">
        </div>

        <button type="submit" class="btn btn-primary">Dodaj proizvod</button>
    </form>
</div>

</body>
</html>
