<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>navbar</title>
</head>

<body>

  <nav class="navbar navbar-expand bg-light border-bottom border-body sticky-top" data-bs-theme="light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php
          if ($_SESSION["login"] == true) {
            echo '<li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                          <h4>Home</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="account.php">
                            <h4>Profil</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <h4>Logout</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="Buchung.php">
                            <h4>Neue Reservierung</h4>
                        </a>';
          } else {
            $_SESSION["login"] = false;
            echo '<li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                          <h4>Home</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="registrierungsformular.php">
                            <h4>Registrierung</h4>
                        </a>';
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="news.php">
              <h4>News</h4>
            </a>
          </li>
          <?php
          if ($_SESSION["admin"] == true) {
            echo '<li class="nav-item">
            <a class="nav-link" href="newsupload.php">
            <h4>Upload</h4>
            </a> ';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

</body>

</html>