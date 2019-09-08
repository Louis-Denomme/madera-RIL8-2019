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
                <?php if (isLogedIn()) {
                    $maderaUrl = base_url()."index.php/Home";
                } else {
                    $maderaUrl = "";
                }
                ?>
                <a class="btn btn-dark" href="<?php echo $maderaUrl ?>">
                    MADERA
                </a>
            </div>
        </div>
        <?php if (isLogedIn()) { ?>
            <div id="nav" class="col-5 text-left">
                <div class="text-left">
                    <a class="btn btn-dark" href="#">Modalité de paiement</a>
                    <a class="btn btn-dark" href="#">Configuration</a>
                    <a class="btn btn-dark" href="<?php echo base_url() ?>index.php/cMyAccount">Mon Compte</a>
                </div>
            </div>
            <div class="col text-right pr-5">
                <?php if (isAllowedToCreateAccount()) { ?>
                    <a class="btn btn-dark" href="<?php echo base_url() ?>index.php/cHome/loadCreateAccountView">Créer
                        un
                        compte</a>
                <?php } ?>
                <a class="btn btn-light" href="<?php echo base_url() ?>index.php/cConnection/logout">Déconnexion</a>
            </div>

        <?php } ?>
    </div>