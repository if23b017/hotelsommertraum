<div class="container" style="margin-bottom: 100px;">
  <div class="container-xxl überschrift">
    <h1>
      Hotel Sommertraum
    </h1>
    <h3>
      Willkommen auf der Startseite des Hotel Sommertraum!
    </h3>
  </div>
</div>
<?php
if (isset($_GET["error"])) {
  if ($_GET["error"] == "noneLogin") { ?>
    <h3 style="color: green">Herzlich Willkommen
      <?php
      //TODO: maybe Daten aus Datenbank holen und echoen
      echo strstr($_COOKIE["email"], "@", true); ?>
    </h3>
    <?php
  }
}
?>