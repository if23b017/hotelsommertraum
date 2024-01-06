<?php require_once 'utils/dbaccess.php'; ?>


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

  if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
    <p>SQL-Fehler</p>
  <?php }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  return mysqli_fetch_assoc($result);
}

$anrede = $email = $firstname = $lastname = $password = $password2 = $date = "";
$anredeErr = $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $passwordErr2 = $dateErr =
  $passwordErrLength = $passwordErrNumber = $passwordErrBig = $passwordErrLow = $passwordErrident = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $firstnameErr = "*Vorname erforderlich";
  } else {
    $firstname = test_input($_POST["firstname"]);
    if (!preg_match("/^[a-zA-Zäöü]*$/", $firstname)) {
      $firstnameErr = "Geben Sie einen richtigen Vornamen ein";
    }
  }

  if (empty($_POST["lastname"])) {
    $lastnameErr = "*Nachname erforderlich";
  } else {
    $lastname = test_input($_POST["lastname"]);
    if (!preg_match("/^[a-zA-Zäöü]*$/", $lastname)) {
      $lastnameErr = "Geben Sie einen richtigen Nachnamen ein";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "*Email erforderlich";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "*Passwort erforderlich";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["password2"])) {
    $passwordErr2 = "*erforderlich";
  } else if ($_POST['password'] != $_POST['password2']) {
    $passwordErrident = "Passwort ist nicht ident!";
  } else {
    $password2 = test_input($_POST["password2"]);
  }

  if (empty($_POST["date"])) {
    $dateErr = "*Geburtsdatum erforderlich";
  } else {
    $date = test_input($_POST["date"]);
  }

  if (empty($_POST["anrede"])) {
    $anredeErr = "*erforderlich";
  } else {
    $anrede = test_input($_POST["anrede"]);
  }
  if (strlen($_POST["password"]) < 8) {
    $passwordErrLength = "*Passwort muss mindestens 8 Zeichen lang sein";
  }
  if (!preg_match("#[0-9]+#", $password)) {
    $passwordErrNumber = "*Passwort muss mindestens eine Zahl enthalten";
  }
  if (!preg_match("#[A-Z]+#", $password)) {
    $passwordErrBig = "*Passwort muss mindestens einen Großbuchstaben enthalten";
  }
  if (!preg_match("#[a-z]+#", $password)) {
    $passwordErrLow = "*Passwort muss mindestens einen Kleinbuchstaben enthalten";
  }

  if (
    $anrede != "" && $firstname != "" && $lastname != "" && $email != "" && $password != "" && $password2 != "" && $date != "" &&
    $passwordErrLength == "" && $passwordErrNumber == "" && $passwordErrBig == "" && $passwordErrLow == "" && $anredeErr == "" &&
    $firstnameErr == "" && $lastnameErr == "" && $emailErr == "" && $passwordErr == "" && $passwordErr2 == "" && $dateErr == ""
  ) {
    if (emailExists($conn, $_POST["email"])) {
      header("Location: index.php?page=registrierungsformular&error=emailExists");
    } else {
      if ($_POST["anrede"] == "Herr") {
        $dbgender = "H";
      } else {
        $dbgender = "F";
      }
      $birth = test_input($_POST["date"]);
      $birthdate = date("Y-m-d", strtotime($birth));

      // Insert the data into the database
      $sql = "INSERT INTO users (email, password, role, firstname, lastname, gender, birthdate) VALUES (?, ?, ?, ?, ?, ?, ?);";

      // Execute the statement
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=registrierungsformular&error=sqlerror");
        exit();
      }
      $role = "user";
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      mysqli_stmt_bind_param($stmt, "sssssss", $email, $hashedPassword, $role, $firstname, $lastname, $dbgender, $birthdate);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("Location: index.php?page=loginformular&error=noneRegister");
      exit();
    }
  }
}

?>
<div class="container" style="margin-bottom: 100px;">
  <h1>
    Registrierung
  </h1>
  <p>Haben Sie bereits einen Account?
    <a href="index.php?page=loginformular">
      Zum Login
    </a>
  </p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?page=registrierungsformular"; ?>">
    <div class="container">
      <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="anrede" <?php if (isset($anrede) && $anrede == "Herr")
            echo "checked"; ?> value="Herr">
          <p>Herr</p>
        </div>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="anrede" <?php if (isset($anrede) && $anrede == "Frau")
          echo "checked"; ?> value="Frau">
        <p>Frau</p>
      </div>
      <span class="error">
        <p style="color: red;">
          <?php
          if ($anredeErr != "") {
            echo $anredeErr;
          } else if (empty($_POST['anrede'])) {
            echo "*";
          } else {
            echo "⠀";
          } ?>
        </p>
      </span>
      <div class="row row-cols-1 row-cols-md-2 align-items-start">
        <div class="col">
          <div class="mb-3">
            <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
              value="<?php echo $firstname; ?>">
            <span class="error">
              <p style="color: red;">
                <?php
                if ($firstnameErr != "") {
                  echo $firstnameErr;
                } else if (empty($_POST['firstname'])) {
                  echo "*";
                } else {
                  echo "⠀";
                } ?>
              </p>
            </span>
          </div>
          <div class="mb-3">
            <input type="date" class="form-control" name="date" tabindex="3" value="<?php echo $date; ?>">
            <span class="error">
              <p style="color: red;">
                <?php
                if ($dateErr != "") {
                  echo $dateErr;
                } else if (empty($_POST['date'])) {
                  echo "*";
                } else {
                  echo "⠀";
                } ?>
              </p>
            </span>
          </div>
          <div class="mb-3">
            <input data-toggle="password" class="form-control" type="password" name="password" placeholder="Passwort"
              tabindex="5">
            <span class="error">
              <p style="color: red;">
                <?php
                if ($passwordErr != "") {
                  echo $passwordErr;
                } else if (empty($_POST['password'])) {
                  echo "*";
                } else {
                  echo "⠀";
                } ?>
              </p>
            </span>
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
              value="<?php echo $lastname; ?>">
            <span class="error">
              <p style="color: red;">
                <?php
                if ($lastnameErr != "") {
                  echo $lastnameErr;
                } else if (empty($_POST['lastname'])) {
                  echo "*";
                } else {
                  echo "⠀";
                } ?>
              </p>
            </span>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="4"
              value="<?php echo $email; ?>">
            <span class="error">
              <p style="color: red;">
                <?php
                if ($emailErr != "") {
                  echo $emailErr;
                } else if (empty($_POST['email'])) {
                  echo "*";
                } else {
                  echo "⠀";
                } ?>
            </span>
          </div>
          <div class="mb-3">
            <input data-toggle="password" class="form-control" type="password" name="password2"
              placeholder="Passwort wiederholen" tabindex="5">
            <span class="error">
              <p style="color: red;">
                <?php
                if ($passwordErr2 != "") {
                  echo $passwordErr2;
                } else if (empty($_POST['password2'])) {
                  echo "*";
                } else {
                  echo "⠀";
                } ?>
              </p>
            </span>
            <span class="error">
              <p style="color: red;">
                <?php
                echo $passwordErrLength;
                ?>
              </p>
              <p style="color: red;">
                <?php
                echo $passwordErrNumber;
                ?>
              </p>
              <p style="color: red;">
                <?php
                echo $passwordErrBig;
                ?>
              </p>
              <p style="color: red;">
                <?php
                echo $passwordErrLow;
                ?>
              </p>
              <p style="color: red;">
                <?php
                echo $passwordErrident;
                ?>
              </p>
            </span>
          </div>
        </div>
      </div>
      <div class="d-grid gap-2">
        <input class="btn btn-primary" type="submit" value="Submit" tabindex="7">
      </div>
    </div>
  </form>
</div>

<?php
if (isset($_GET["error"])) {
  if ($_GET["error"] == "emailExists") { ?>
    <h3 style="color: red;">Diese Email ist bereits registriert!</h3>
  <?php } else if ($_GET["error"] == "sqlerror") { ?>
      <h3 style="color: red;">Etwas ist schief gelaufen!</h3>
  <?php }
}