<?php
include './imports.php';

$searchValue = '';

if (isset($_REQUEST['is_search']) && ($_REQUEST['is_search'] == 'Y')) {
    $searchValue = $_REQUEST['search'];
}

$phones = getListOfContacts($searchValue);
?>

<?php include './templates/header.php'; ?>
<?php include './templates/navigation.php'; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <br />

            <form class="form-inline" action="contacts.php" method="get">
                <input type="hidden" name="is_search" value="Y">
                <div class="form-group">
                    <label for="search" class="sr-only">Text to search</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        id="search"
                        placeholder="Text to search"
                        value="<?= $searchValue ?>">
                </div>
                &nbsp;
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <br />

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Phone</th>
                    <th>First name</th>
                    <th>Last name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($phones as $phoneData) { ?>
                    <tr>
                        <td><?= $phoneData['id'] ?></td>
                        <td><?= $phoneData['phone'] ?></td>
                        <td><?= $phoneData['first_name'] ?></td>
                        <td><?= $phoneData['last_name'] ?></td>
                    </tr>
                <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './templates/footer.php'; ?>
