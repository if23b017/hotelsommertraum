<div class="container" style="margin-bottom: 100px;">
  <h1>Login</h1>

  <?php


  require_once 'utils/dbaccess.php';
  require_once 'utils/functions.php';

  // Überprüfen, ob das Formular abgeschickt wurde
  // und Validierung der Eingabefelder
  
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

  // Überprüfen, ob die Eingaben korrekt sind
  // und Weiterleitung basierend auf dem Benutzerstatus
  if (empty($emailErr) && empty($passwordErr)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = test_input($_POST["email"]);
      $password = test_input($_POST["password"]);

      if (!empty($email) && !empty($password)) {
        $userData = emailExists($conn, $email);
        if ($userData["active"] == 1) {
          if ($userData) {
            if (password_verify($password, $userData['password'])) {
              $_SESSION['login'] = true;
              setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
              if ($userData['role'] == 'admin') {
                $_SESSION['admin'] = true;
                header("Location: index.php?page=landing&error=noneAdminLogin");
              } else {
                header("Location: index.php?page=landing&error=noneLogin");
              }
            } else {
              header("Location: index.php?page=loginformular&error=wrongPassword");
            }
          } else {
            header("Location: index.php?page=loginformular&error=wrongEmail");
          }
        } else {
          header("Location: index.php?page=loginformular&error=notActive");
        }
      }
    }
  }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=loginformular" ?>">
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
</div>

<?php
// Anzeigen von Fehlermeldungen
if (!empty($emailErr)) { ?>
  <h3>
    <?php echo $emailErr ?>
  </h3>
<?php }

if (!empty($passwordErr)) { ?>
  <h3>
    <?php echo $passwordErr ?>
  </h3>
<?php }

// Anzeigen von Erfolgsmeldungen oder Fehlermeldungen
if (isset($_GET["error"])) {
  if ($_GET["error"] == "noneRegister") { ?>
    <h3>Erfolgreich registriert. Bitte Einloggen</h3>
  <?php }
  if ($_GET["error"] == "wrongPassword") { ?>
    <h3>Passwort falsch</h3>
  <?php }
  if ($_GET["error"] == "wrongEmail") { ?>
    <h3>E-Mail-Adresse nicht gefunden</h3>
  <?php }
  if ($_GET["error"] == "notActive") { ?>
    <h3>Dein Account ist nicht aktiv. Melde dich bei einem Admin</h3>
  <?php }
}
?>