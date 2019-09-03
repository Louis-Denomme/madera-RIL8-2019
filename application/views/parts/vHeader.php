<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <!-- Balises obligatoires dans chaque vue-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/interface/Interface.css">
</head>

<body>
    <div class="container-fluid h-100 d-flex flex-column">
        <div class="row bg-dark pt-2 pb-2">
            <div class="col-2">
                <div id="logo">
                    MADERA
                </div>
            </div>
            <?php if (isLogedIn()) { ?>
                <div class="col text-right pr-5">
                    <a class="btn btn-light" href="<?php echo base_url() ?>index.php/cConnection/logout">Déconnexion</a>
                </div>
            <?php } ?>
        </div>