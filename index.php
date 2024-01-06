<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<?php include 'utils/head.php'; ?>

<body>

  <?php
  if (!isset($_SESSION["login"])) {
    $_SESSION["login"] = false;
  }
  if (!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = false;
  }
  ?>


  <?php include 'utils/navbar.php'; ?>


  <?php
  $page = (isset($_GET['page'])) ? $_GET['page'] : "landing";
  $pages = [
    "landing" => "seiten/landing.php",
    "account" => "seiten/account.php",
    "buchung" => "seiten/buchung.php",
    "faqs" => "seiten/faqs.php",
    "impressum" => "seiten/impressum.php",
    "kontakt" => "seiten/kontakt.php",
    "login-formular" => "seiten/login-formular.php",
    "news" => "seiten/news.php",
    "newsupload" => "seiten/newsupload.php",
    "registrierungsformular" => "seiten/registrierungsformular.php",
    "reservierung" => "seiten/reservierung.php",
    "reservierungen" => "seiten/reservierungen.php",
    //TODO: Seiten hinzugefügen
  ];
  if (isset($pages[$page])) {
    if (file_exists($pages[$page])) {
      include $pages[$page];
    }
  } else {
    include "utils/404.php";
  } ?>

  <?php include 'utils/footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>