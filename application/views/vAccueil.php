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

        </div>
    </div>
</body>
</html>