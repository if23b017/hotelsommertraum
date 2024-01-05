<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hotel Sommertraum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body style></body>
</body>
<?php
if (!isset($_SESSION["login"])) {
  $_SESSION["login"] = false;
}
if (!isset($_SESSION["admin"])) {
  $_SESSION["admin"] = false;
}
?>


<?php include '../utils/navbar.php'; ?>

<div class="container" style="margin-bottom: 100px;">
  <div class=überschrift class="container-xxl">
    <h1>
      Hotel Sommertraum - Startseite
    </h1>
    <h3>
      Willkommen auf der Startseite des Hotel Sommertraum!
    </h3>
  </div>
</div>

<?php include '../utils/footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>