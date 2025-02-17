<?php
    session_start();
    include('server/connection.php');
    include("server/all_messages.php");
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php'); // Redirect to index if not logged in
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
<body>
<?php include 'adminsidebar.html';?>

<div id="content">
    <div class="container-fluid">
        <h1 class="mt-4">Admin User Preview</h1>
        <p>All users in our database.</p>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Poruka ID</th>
                                <th>Korisnik ID</th>
                                <th>Ime korisnika</th>
                                <th>Email</th>
                                <th>Naslov</th>
                                <th>Poruka</th>
                                <th>Pregled</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($row = $poruke->fetch_assoc()){
                                echo "<tr>
                                        <td>" . $row['message_id'] . "</td>
                                        <td>" . $row['user_id'] . "</td>
                                        <td>" . $row['user_name'] . "</td>
                                        <td>" . $row["user_email"] . "</td>
                                        <td>" . $row['subject'] . "</td>
                                        <td>" . substr($row['message'], 0, 50) . "...</td> <!-- Show partial message -->
                                        <td>
                                            <a href='adminViewMessage.php?message_id=" . $row['message_id'] . "' class='btn btn-primary'>Pregled</a>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
