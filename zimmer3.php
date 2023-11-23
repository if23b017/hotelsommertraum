<?php
session_start();

$_SESSION['zimmer'] = 'Einzelbett Zimmer';

header("Location: reservierung.php");
exit();
?>