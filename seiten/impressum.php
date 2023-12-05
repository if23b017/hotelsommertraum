<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Sommertraum: Impressum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <?php include '../utils/navbar.php'; ?>

  <div class="container" style="margin-bottom: 100px;">
    <h1>Impressum</h1>
    <p>Hotel Sommertraum GmbH</p>
    <p>Hotellerie</p>
    <p>UID-Nr: ATU14578965</p>
    <p>FN: 145368a</p>
    <p>FB-Gericht: Wien</p>
    <p>Sitz: 1110 Wien</p>
    <p>Leberweg 11 | Austria</p>
    <p>Tel.:
      <a class="impressum-link" href="tel:+436604789621">+436604789621</a>
    </p>
    <p>E-Mail:
      <a class="impressum-link" href="mailto:office@hotelsommertraum.at">office@hotelsommertraum.at</a>
    </p>
    <p>Mitglied der WKÖ</p>
    <p>Berufsrecht: Gewerbeordnung:
      <a class="impressum-link" href="https://www.ris.bka.gv.at" target="_blank">www.ris.bka.gv.at</a>
    </p>
    <p>Bezirkshauptmannschaft Wien</p>
    <p>Verbraucher haben die Möglichkeit,Beschwerden an die Online-Streitbeilegungsplattform der EU zu richten:
      <a class="impressum-link" href=" http://ec.europa.eu/odr" target="_blank"> http://ec.europa.eu/odr</a>.
    </p>
    <p>Sie können allfällige Beschwerde auch an die oben angegebene E-Mail-Adresse richten.</p>
    <p>Hotelverwaltung:</p>
    <div class="container text-center">
      <div class="row align-items-end ">
        <div class="col">
          <p>Raphael Leitgeb</p>
          <img src="img/Leitgeb.png" alt="Raphael" title="Raphael" height="350" />
        </div>
        <div class="col">
          <p>Andy Mihalca</p>
          <img src="img/Mihalca.jpg" alt="Andy" title="Andy" height="350" />
        </div>
      </div>
    </div>
  </div>


  <?php include '../utils/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>