<?php
session_start();

$_SESSION['zimmer'] = 'Einzelsuite';

header("Location: reservierung.php");
exit();
?>