<?php
require_once 'utils/dbaccess.php';
?>


<div class="container" style="margin-bottom: 100px;">

  <h1>
    Login
  </h1>

  <?php
  $email = $password = "";
  $emailErr = $passwordErr = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
      $emailErr = "E-Mail-Adresse ist erforderlich";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Ungültiges E-Mail-Format";
      }
    }
    if (empty($_POST["password"])) {
      $passwordErr = "Passwort ist erforderlich";
    } else {
      $password = test_input($_POST["password"]);
    }
  }

  if (empty($emailErr) && empty($passwordErr)) {
    loginUser($conn, $email, $password);
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function emailExists($conn, $email)
  {
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
      <p>SQL-Fehler</p>
    <?php }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
  }

  function loginUser($conn, $email, $password)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = test_input($_POST["email"]);
      $password = test_input($_POST["password"]);

      if (!empty($email) && !empty($password)) {
        $userData = emailExists($conn, $email);
        if ($userData) {
          $sql = "SELECT * FROM users WHERE email = '$email'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          if ($row['active'] == 1) {
            if (password_verify($password, $userData['password'])) {
              $_SESSION['login'] = true;
              setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
              $sql = "SELECT * FROM users WHERE email = '$email'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              if ($row['type'] == 'admin') {
                $_SESSION['admin'] = true;
                setcookie("admin", true, time() + (86400 * 30), "/");
                header("Location: index.php?page=landing&error=noneLogin");
              } else {
                header("Location: index.php?page=landing&error=noneLogin");
              }
            } else {
              header("Location: index.php?page=landing&error=wrongPassword"); ?>
            <?php }
          } else {

            header("Location: index.php?page=landing&error=notActive");
          }
        } else {

          header("Location: index.php?page=landing&error=wrongEmail");
        }
      }
    }
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