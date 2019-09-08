<!DOCTYPE html>
<html>
<head>
    <title>Madera - Mon compte</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card p-5">
                <div class="card-body">
                    <h3 class="card-title">Mon Compte</h3>
                </div>
                <div class="card-text">
                    <?php

                    echo "<p class='form-group'> ";
                    echo form_label('<b>Profil</b>');
                    echo form_input(array('class' => 'form-control', 'value' => $this->profil, 'readonly' => 'true'));
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_label('<b>Identifiant</b>');
                    echo form_input(array('class' => 'form-control', 'value' => $this->username, 'readonly' => 'true'));
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_label('<a class="fa-link" href= ' . base_url() . 'index.php/cMyAccount/loadViewChangePassword> <b>Modifier le mot de passe</b> </a>');
                    echo "</p> ";

                    ?></div>
            </div>
        </div>
    </div>

</div>
</body>
</html>