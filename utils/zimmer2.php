<?php
session_start();

$_SESSION['zimmer'] = 'Luxussuite';

header("Location: ../index.php?page=reservierung");
exit();
?>