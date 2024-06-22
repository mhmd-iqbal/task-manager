<?php
function base_url()
{
    return dirname($_SERVER['SERVER_NAME']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Manager App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/app.css">
</head>

<body class="bg-body-secondary">
    <div class="container py-4">
        <?php include_once 'partials/navbar.php' ?>
        <?php include_once 'index.php' ?>
        <?php include_once 'partials/footer.php' ?>
        <?php include_once 'partials/fab.php' ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.js"></script>
</body>

</html>