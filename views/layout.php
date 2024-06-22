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
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-print-3.0.2/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/app.css?v=<?= strtotime(date('YmdHis')) ?>">
</head>

<body class="bg-body-secondary">
    <div class="container-fluid p-4">
        <?php include_once 'partials/navbar.php' ?>
        <?php include_once 'index.php' ?>
        <?php include_once 'partials/footer.php' ?>
        <?php include_once 'partials/fab.php' ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-print-3.0.2/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.js?v=<?= strtotime(date('YmdHis')) ?>"></script>
</body>

</html>