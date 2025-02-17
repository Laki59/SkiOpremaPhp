<?php
session_start();
include('server/connection.php'); 


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}


$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT admin FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['admin'] !== 'da') {
    header('Location: index.php');
    exit();
}

if (!isset($_GET['message_id'])) {
    header('Location: adminHome.php');
    exit();
}

$message_id = $_GET['message_id'];

$stmt = $conn->prepare("SELECT * FROM message WHERE message_id = ?");
$stmt->bind_param("i", $message_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows == 0) {
    header('Location: adminHome.php');
    exit();
}

$message = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php include 'adminsidebar.html';?>

<div id="content">
    <div class="container mt-4">
        <h1>Detalji poruke</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Naslov: <?php echo htmlspecialchars($message['subject']); ?></h5>
                <p class="card-text"><strong>ID poruke:</strong> <?php echo $message['message_id']; ?></p>
                <p class="card-text"><strong>ID korisnika:</strong> <?php echo $message['user_id']; ?></p>
                <p class="card-text"><strong>Ime:</strong> <?php echo htmlspecialchars($message['user_name']); ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($message['user_email']); ?></p>
                <p class="card-text"><strong>Poruka:</strong></p>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                
            </div>
        </div>
    </div>
</div>

</body>
</html>