<?php
function logInteraction($username, $form_code, $details, $status) {
    global $conn; // Use the database connection from db.php

    $log_date = date('Y-m-d H:i:s'); // Current date and time
    $username = $conn->quote($username); // Sanitize username
    $form_code = $conn->quote($form_code); // Sanitize form code
    $details = $conn->quote($details); // Sanitize details

    // Insert the log into the database
    $sql = "INSERT INTO logs (log_date, username, form_code, details, status) 
            VALUES ('$log_date', $username, $form_code, $details, '$status')";
    $conn->exec($sql);
}
?>