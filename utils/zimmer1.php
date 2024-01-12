<?php
session_start();

$_SESSION['zimmer'] = 'Doppelbettzimmer';

header("Location: ../index.php?page=reservierung");
exit();
?>