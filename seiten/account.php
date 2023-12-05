<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Sommertraum - Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <?php include '../utils/navbar.php'; ?>

    <h1>Ihr Account</h1>

    <div class="container" style="margin-bottom: 100px;">

        <?php
        $firstname = $lastname = $email = $date = $password = "";
        $passwordErr = $passwordErrident = $newPasswordErr = $passwordErrLength =
            $passwordErrNumber = $passwordErrBig = $passwordErrLow = $wrongOldPassword = "";
        if (isset($_SESSION["firstname"])) {
            $firstname = test_input($_SESSION["firstname"]);
        } else {
            $firstname = "Max";
        }
        if (isset($_SESSION["lastname"])) {
            $lastname = test_input($_SESSION["lastname"]);
        } else {
            $lastname = "Mustermann";
        }
        if (isset($_SESSION["email"])) {
            $email = test_input($_SESSION["email"]);
        } else {
            $email = "max.mustermann@gmail.com";
        }
        if (isset($_SESSION["date"])) {
            $date = test_input($_SESSION["date"]);
        } else {
            $date = "1999-12-31";
        }
        $newDate = date("Y-m-d", strtotime($date));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["firstname"])) {
                $firstname = test_input($_POST["firstname"]);
            }
            if (isset($_POST["lastname"])) {
                $lastname = test_input($_POST["lastname"]);
            }
            if (isset($_POST["email"])) {
                $email = test_input($_POST["email"]);
            }
            if (isset($_POST["date"])) {
                $date = test_input($_POST["date"]);
            }

            $newDate = date("Y-m-d", strtotime($date));
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["email"] = $email;
            $_SESSION["date"] = $date;

            //neues Passwort und dazu Validierung
            if (isset($_POST["newPassword"])) {
                $password = test_input($_POST["newPassword"]);
            }
            if (empty($_POST["oldPassword"]) || empty($_POST["newPassword"]) || empty($_POST["newPassword2"])) {
                $passwordErr = "*Passwort erforderlich";
            }
            //error bei Email Änderung im Profil
            if (strlen($_POST["newPassword"]) < 8) {
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
            if (isset($_POST["newPassword"])) {
                if ($_POST["newPassword"] != $_POST["newPassword2"]) {
                    $passwordErrident = "Passwörter sind nicht ident!";
                }
            }
            if (isset($_POST["oldPassword"])) {
                if ($_POST["oldPassword"] != $_SESSION["password"]) {
                    $wrongOldPassword = "Altes Passwort ist falsch!";
                }
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


        <div class="mb-3">
            <div class="d-grid gap-4 col-5 mx-auto">
                <a class="btn btn-primary" role="button" href="reservierungen.php">Meine Reservierungen</a>
            </div>
        </div>


        <br>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="d-grid gap-3 col-5 mx-auto">
                    <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                        value="<?php echo $firstname; ?>">
                    <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                        value="<?php echo $lastname; ?>">
                    <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="3"
                        value="<?php echo $email; ?>">
                    <input type="date" class="form-control" name="date" tabindex="4" value="<?php echo $newDate; ?>">
                    <div class="mb-3">
                        <div class="d-grid gap-4 col-5 mx-auto">
                            <input class="btn btn-primary" type="submit" value="Änderungen übernehmen" tabindex="5">
                        </div>
                    </div>
                    <br>
                    <h3>
                        Passwort ändern:
                    </h3>
                </div>
            </div>
        </form>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="d-grid gap-4 col-5 mx-auto">
                    <input data-toggle="password" class="form-control" type="password" name="oldPassword"
                        placeholder="Altes Passwort" tabindex="6">
                </div>
                <div class="mb-3">
                </div>
                <div class="d-grid gap-3 col-5 mx-auto">
                    <input data-toggle="password" class="form-control" type="password" name="newPassword"
                        placeholder="Neues Passwort" tabindex="7">
                    <input data-toggle="password" class="form-control" type="password" name="newPassword2"
                        placeholder="Neues Passwort wiederholen" tabindex="8">
                    <div class="mb-3">
                        <div class="d-grid gap-4 col-5 mx-auto">
                            <input class="btn btn-primary" type="submit" value="Passwort ändern" tabindex="9">
                        </div>
                    </div>
                    <span class="error">
                        <p style="color: red;">
                            <?php
                            echo $wrongOldPassword;
                            ?>
                        </p>
                        <p style="color: red;">
                            <?php
                            echo $passwordErr;
                            ?>
                        </p>
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
    </form>


    <div class="container col-5" style="margin-bottom: 150px;" >

    <?php
    if (isset($_POST["newPassword"])) {
        if (
            ($_POST["newPassword"] == $_POST["newPassword2"]) && ($_POST["oldPassword"] == $_SESSION["password"]) &&
            ($passwordErr == "") && ($passwordErrident) == ""
        ) {
            $_SESSION["password"] = $_POST["newPassword"];
            echo '<div class="alert alert-success" role="alert">
                        Passwort erfolgreich geändert!
                </div>';
        }
    }
    ?>

    </div>





    <?php include '../utils/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js">
    </script>

</body>

</html>