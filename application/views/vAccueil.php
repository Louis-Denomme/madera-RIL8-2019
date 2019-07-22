<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <!-- Balises obligatoires dans chaque vue-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/interface/Interface.css">
</head>
<body>
    <div> <?php require  'interface/vHeader.php'; ?></div>
    <div id="myBody">
        <?php require 'interface/vNavigation.php'; ?>
        <div id="corps">
            <div id="blocDevisEncours" class="homeBloc">
                <div class="tableHeader">Mes devis en cours</div>
                <?php foreach ($dicoDevisEnCours as $devis):
                    echo $devis;
                endforeach;?>
            </div>
            <div id="blocDevisAcceptes" class="homeBloc"></div>
            <div id="blocDevisRefuses" class="homeBloc"></div>
            <div id="blocNavigationRapide" class="homeBloc"></div>
        </div>
    </div>
</body>
</html>