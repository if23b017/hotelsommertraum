<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hotel Sommertraum: Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

  <?php include 'navbar.php'; ?>

  <div class="container" style="margin-bottom: 100px;">

    <h1>
      Login
    </h1>

    <?php
    $email = $password = "";
    if (!empty($_POST["email"])) {
      $email = test_input($_POST["email"]);
    }
    if (!empty($_POST["password"])) {
      $password = test_input($_POST["password"]);
    }

    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="container margin-bottom 100px">
        <div class="d-grid gap-4 col-5 mx-auto">
          <div class="mb-3">
            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" required>
          </div>
        </div>
        <div class="d-grid gap-4 col-5 mx-auto">
          <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Passwort" required>
          </div>
          <div class="d-grid gap-4 col-5 mx-auto">
            <input class="btn btn-primary" type="submit" value="Login" tabindex="9">
          </div>
        </div>
      </div>
    </form>
    <br>
    <div class="d-grid mx-auto">
      <div class="text-center">
        <?php
        if ($email == 'admin@localhost' && $password == 'admin') {
          $_SESSION['login'] = true;
          $_SESSION['admin'] = true;
          $_SESSION['firstname'] = 'admin';
          $_SESSION['lastname'] = 'admin';
          $_SESSION['email'] = 'admin@localhost';
          $_SESSION['date'] = '01.01.2000';
          $_SESSION['password'] = 'admin';
          echo '<p>Willkommen ' . $_SESSION['firstname'] . '!</p>';
          echo "<a href='account.php'<h2>Zum Profil</h2></a>";
        } else if (isset($_SESSION['email']) && (isset($_SESSION['email']))) {
          if ($email == $_SESSION['email'] && $password == $_SESSION['password'] && isset($_POST["email"]) && isset($_POST["password"])) {
            $_SESSION['login'] = true;
            echo '<p>Willkommen zurück ' . $_SESSION["anrede"] . " " . $_SESSION["lastname"] . '!</p>';
            echo "<a href='account.php'<h3>Zum Profil</h3></a>";
          } else if (isset($_POST["email"]) && isset($_POST["password"])) {
            echo '<p style="color: red;">E-Mail-Adresse oder Passwort falsch!</p>';
            echo "<a class='btn btn-primary' role='button' href='registrierungsformular.php'<h2>Zur Registrierung</h2></a>";
          }
        }


        ?>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>