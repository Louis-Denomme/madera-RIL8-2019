<!DOCTYPE html>
<html>
<head>
    <title>Madera - Création de compte</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card p-5">
                <div class="card-body">
                    <h3 class="card-title">Création d'un compte</h3>
                </div>
                <div class="card-text">
                    <?php

                    echo form_open('index.php/cHome/tryCreateAccount');

                    echo "<p class='form-group'> ";
                    echo form_input('lastname', $this->input->post('lastname'), array('class' => 'form-control', 'placeholder' => 'Nom'));
                    echo form_error('lastname');
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_input('firstname', $this->input->post('firstname'), array('class' => 'form-control', 'placeholder' => 'Prénom'));
                    echo form_error('firstname');
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_input('email', $this->input->post('email'), array('class' => 'form-control', 'placeholder' => 'Email'));
                    echo form_error('email');
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_input('username', $this->input->post('username'), array('class' => 'form-control', 'placeholder' => 'Identifiant'));
                    echo form_error('username');
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_password(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe'));
                    echo form_error('password');
                    echo "</p>";

                    echo "<p class='form-group'> ";
                    echo form_password(array('name' => 'confirmPassword', 'class' => 'form-control', 'placeholder' => 'Confirmation mot de passe'));
                    echo form_error('confirmPassword');
                    echo "</p>";

                    echo "<div><label class='radio-inline'>";
                    echo form_radio(array('name' => 'profil', 'class' => '', 'value' => 'profilAdmin'));
                    echo "Admin";
                    echo "</label></div>";

                    echo "<div><label class='radio-inline'>";
                    echo form_radio(array('name' => 'profil', 'class' => '', 'checked' => 'checked', 'value' => 'profilCommercial'));
                    echo "Commercial";
                    echo "</label></div>";

                    echo "<div class='mt-3 text-right'>";
                    echo form_submit('login_submit', 'Valider', array('class' => 'btn btn-primary btn-lg'));
                    echo "</div>";

                    echo form_close();

                    ?></div>
            </div>
        </div>
    </div>

</div>
</body>
</html>