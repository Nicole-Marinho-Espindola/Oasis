<?php
    session_start();
    $logged_user = !empty($_SESSION['logged_user']) ? $_SESSION['logged_user'] : null;

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis/admin',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'))
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/4719b1c3ae.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/global.css') ?>">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/navbar.css') ?>">
        <link rel="stylesheet" href="<?= baseUrl('/assets/css/form.css') ?>">
        <title>Admin</title>
    </head>
    
<?php
    include_once(includeURL('views/includes/navbar.php'));
?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>