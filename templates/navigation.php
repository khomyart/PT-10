<?php
$currentScript = basename($_SERVER['SCRIPT_FILENAME']);

$contactsCss = $currentScript == 'contacts.php' ? 'active' : '';
$usersCss = $currentScript == 'users.php' ? 'active' : '';
?>

<div class="container">
    <div class="row">
    <div class="col">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ContactsBook</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $contactsCss; ?>" href="./contacts.php">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $usersCss; ?>" href="./users.php">Users</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    </div>
</div>
