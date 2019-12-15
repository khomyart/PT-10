<?php
include './config.php';
include './lib/db.php';
include './lib/users.php';
include './lib/contacts.php';

initSession();
$isIndex = basename($_SERVER['SCRIPT_FILENAME']) == 'index.php';

if (isAuth()) {
    // User is not authorized
    if ($isIndex) {
        // Current file is index.
        // No need to show auth form.
        // Let's show phones page
        header("Location: contacts.php");
        die();
    }
} else {
    // User is not authorized
    if (!$isIndex) {
        // Current file is not index.
        // We need to redirect user to index page
        header("Location: index.php");
        die();
    }
}
