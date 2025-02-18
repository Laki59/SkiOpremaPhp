<?php
$lang = "rs";


if (isset($_GET['lang'])) {
  $lang = $_GET['lang'];
  setcookie("lang", $lang, time() + (86400 * 30), "/"); // Stavi cookie na 30 dana
} elseif (isset($_COOKIE['lang'])) {
  $lang = $_COOKIE['lang']; // Koristi jezik iz cookija
}

$Language = parse_ini_file("assets/languages/$lang.ini");


?>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">

<!-- jQuery and Bootstrap Bundle (includes Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
        
          <li class="nav-item">
            <a href="shop.php" class="nav-link">Shop</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="blog.php">Blog</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">Kontakt</a>
          </li>

          <li class="nav-item">
            <a href="cart.php" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
          </li>
          
          <li class="nav-item">
            <a href="login.php" class="nav-link"><i class="fa-solid fa-user"></i></a>
          </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="nav-link" href="?lang=en"></i></i>engleski</a>
        <a class="nav-link" href="?lang=rs">srpski</a>
        </div>
      </li>

          <?php
                // Example PHP code to check admin status
                include('server/connection.php'); // Ensure this file connects to your database
                
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT admin FROM users WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    if ($row['admin'] == 'da') {
                        echo '<li class="nav-item">
                                <a href="admin.php" class="nav-link"></i> Admin</a>
                              </li>';
                    }
                }
              
                ?>

        </ul>

      </div>
    </div>
  </nav>