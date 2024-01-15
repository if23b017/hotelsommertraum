<?php require_once 'utils/dbaccess.php'; ?>

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
  if ($_GET["error"] == "noneLogin") {
    $email = $_COOKIE["email"];

    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: index.php?page=landing&error=stmtfailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if ($user = mysqli_fetch_assoc($resultData)) { ?>
      <h3 style="color: green">Herzlich Willkommen
        <?php echo $user["firstname"]; ?>!
      </h3>
      <?php
    }
  }
}
?>