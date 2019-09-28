<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <!-- Balises obligatoires dans chaque vue-->
    <meta name="robots" content="noindex, nofollow" />
    <meta name="robots" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Balises obligatoires dans chaque vue-->
    <link href="<?php echo base_url(); ?>assets/css/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/interface/Interface.css"/>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?= base_url() ?>favicon.ico"/>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>"use strict"; var base_url = "<?= base_url(); ?>";</script>
    <script src="<?= base_url() ?>assets/js/client.js"></script>
    <script src="<?= base_url() ?>assets/js/tools.js"></script>

</head>

<body>
<div class="container-fluid h-100 d-flex flex-column bg-secondary">
    <div class="row bg-dark pt-2 pb-2">
        <div class="col-2">
            <div id="logo">
                <?php if (isLogedIn()) {
                    $maderaUrl = base_url()."index.php/Home";
                } else {
                    $maderaUrl = base_url()."index.php";
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