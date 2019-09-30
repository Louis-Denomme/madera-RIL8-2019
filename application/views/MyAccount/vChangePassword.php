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
                    <h3 class="card-title">Modification de mot de passe</h3>
                </div>
                <div class="card-text">
                    <?php
                    echo form_open('index.php/cMyAccount/tryChangePassword');

                    echo "<p class='form-group'> ";
                    //echo form_label('<b>Ancient mot de passe</b>');
                    echo form_password(array('name' => 'oldPassword', 'class' => 'form-control', 'placeholder' => 'Ancien mot de passe'));
                    echo form_error('oldPassword');
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    // echo form_label('<b>Nouveau mot de passe</b>');
                    echo form_password(array('name' => 'newPassword', 'class' => 'form-control', 'placeholder' => 'Nouveau mot de passe'));
                    echo form_error('newPassword');
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    //echo form_label('<b>Confirmation nouveau mot de passe</b>');
                    echo form_password(array('name' => 'confirmNewPassword', 'class' => 'form-control', 'placeholder' => 'Confirmation nouveau mot de passe'));
                    echo form_error('confirmNewPassword');
                    echo "</p> ";

                    echo "<div class='mt-3 text-right'> ";
                    echo form_submit('login_submit', 'Ok', array('class' => 'btn btn-primary btn-lg'));
                    echo form_label('<a class="btn btn-secondary btn-lg" href= ' . base_url() . 'index.php/cMyAccount/index> Annuler </a>');
                    echo "</div>";

                    echo form_close();

                    ?></div>
            </div>
        </div>
    </div>

</div>
</body>
</html>