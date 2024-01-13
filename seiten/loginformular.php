<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<div class="container" style="margin-bottom: 100px;">
  <h1>Login</h1>

  <?php //TODO: error handling + divs
  
  <?php //TODO: error handling + divs
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "noneRegister") { ?>
      <h3>Erfolgreich registriert. Bitte Einloggen</h3>
    <?php }
    if ($_GET["error"] == "wrongPassword") { ?>
      <h3>Passwort Falsch</h3>
    <?php }
    if ($_GET["error"] == "wrongEmail") { ?>
      <h3>E-Mail-Adresse nicht gefunden</h3>
    <?php } }
    ?>
    

<?php

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

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: index.php?page=landing&error=stmtfailed");
      exit();
  }

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
  
              if ($userData && password_verify($password, $userData['password'])) {
                  $_SESSION['login'] = true;
                  setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
  
                  if ($userData['role'] == 'admin') {
                      $_SESSION['admin'] = true;
                      header("Location: index.php?page=landing&error=noneAdminLogin");
                  } else {
                      header("Location: index.php?page=landing&error=noneLogin");
                  }
              } else {
                  header("Location: index.php?page=landing&error=wrongPassword");
              }
          } else {
              header("Location: index.php?page=landing&error=wrongEmail");
          }
      }
  }


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

  ?>



<!-- TODO: HTML CODE fixen -->
  

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="container margin-bottom 100px">
      <div class="d-grid gap-4 col-5 mx-auto">
        <div class="mb-3">
          <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse">
        </div>
      </div>
      <div class="d-grid gap-4 col-5 mx-auto">
        <div class="mb-3">
          <input type="password" class="form-control" name="password" placeholder="Passwort">
        </div>
        <div class="d-grid gap-4 col-5 mx-auto">
          <input class="btn btn-primary" type="submit" value="Login">
        </div>
      </div>
    </div>
  </form>
  <br>
</div>
