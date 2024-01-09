<?php
$sql = "SELECT * FROM /* Reservierungstabelle */;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    /* Fehlermeldung */
}

/* Überprüfung ob zumindest eine Reservierung in der Datenbank ist */

/* alle Reservierungen ausgeben mithilfe einer while Schleife ausgeben */

//TODO: Reservierung updaten

$sql = "UPDATE /* Reservierungstabelle */ SET /* room = ?, arrivalDate = ?, ... */ WHERE reservationId = ?";

//TODO: Filter mithilfe eines weiteren Formulars und verschiedenen SELECT-Statements einbauen