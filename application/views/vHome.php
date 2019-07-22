<!DOCTYPE html>
<html>
<head>
    <title>Madera - Accueil</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<h1>Bienvenue, Vous êtes connecté.</h1>

<?php
echo "<pre>";
echo print_r($this->session->userdata());
echo "</pre>";
?>

<a href='<?php echo base_url() . "index.php/cConnection/logout"; ?>'>
    <button id="logoutSubmit" name="logoutSubmit" class="btn btn-secondary btn-lg">

        Déconnexion

    </button>
</a>

<a href='<?php echo base_url() . "index.php/cHome/loadCreateAccountView"; ?>'>
    <button id="createAccountSubmit" name="createAccountSubmit" class="btn btn-primary btn-lg"
        <?php if (!$this->CI->isAllowedToCreateAccount()) {
            echo 'disabled';
        } ?>>

        Création de Compte

    </button>
</a>


</body>
</html>