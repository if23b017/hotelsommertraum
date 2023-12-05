<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"/>
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
                        <a class="nav-link" href="../seiten/account.php">
                            <h4>Profil</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="../utils/logout.php">
                            <h4>Logout</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="../seiten/Buchung.php">
                            <h4>Neue Reservierung</h4>
                        </a>';
          } else {
            $_SESSION["login"] = false;
            echo '<li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                          <h4>Home</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="../seiten/registrierungsformular.php">
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
            <a class="nav-link" href="../seiten/newsupload.php">
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