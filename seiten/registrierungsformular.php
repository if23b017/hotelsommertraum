<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hotel Sommertraum: Registrierung</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <?php include '../utils/navbar.php'; ?>

  <div class="container" style="margin-bottom: 100px;">
    <h1>
      Registrierung
    </h1>

    <?php
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
        $dateErr = "*Datum erforderlich";
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
    }

    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>

    <p>Haben Sie bereits einen Account?
      <a href="login-Formular.php">
        Zum Login
      </a>
    </p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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

    <p style="color: black;">
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
          $anredeErr != "" || $emailErr != "" || $firstnameErr != "" || $lastnameErr != "" || $passwordErr != "" ||
          $passwordErr2 != "" || $dateErr != ""
        ) {
          echo "⠀";
        } else if (
          isset($_POST['anrede']) && isset($_POST['email']) && isset($_POST['firstname'])
          && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['date'])
        ) {
          echo " ";
        } else {
          echo "*erforderlich";
        }
        if (
          $anredeErr == "" && $emailErr == "" && $firstnameErr == "" && $lastnameErr == "" && $passwordErr == "" &&
          $passwordErr2 == "" && $dateErr == ""
        ) {
          echo "Herzlich Willkommen " . $_POST["anrede"] . " " . $_POST["lastname"] . "! <br>";
        }
      }
      ?>
    </p>
    <?php
    if (
      $anredeErr == "" && $emailErr == "" && $firstnameErr == "" && $lastnameErr == "" && $passwordErr == "" && $passwordErr2 == "" && $dateErr == "" &&
      $passwordErrLength == "" && $passwordErrNumber == "" && $passwordErrBig == "" && $passwordErrLow == "" && $anrede != ""
    ) {
      require_once '../utils/dbaccess.php';
      
      if ($sql = "SELECT email FROM users WHERE email='$email'") {
        echo "Diese E-Mail-Adresse ist bereits registriert!";
        return;
      }
      
      $sql = "INSERT INTO users (email, password, role, firstname, lastname, gender, birthdate) 
      VALUES (?, ?, ?, ?, ?, ?, ?);";

      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement failed!";
      } else {
        $user = "user";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sssssss", $email, $hashedPassword, $user, $firstname, $lastname, $anrede, $date);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);

      $_SESSION["login"] = true;
      $_SESSION["email"] = $_POST["email"];
      echo "<a href='account.php'>
    <p>Zu Ihrem Profil</p>
  </a>";
    }

    ?>

    <?php include '../utils/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
      </script>
</body>

</html>