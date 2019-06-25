<html>

<head>

    <title>Madera - Connexion</title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<h1 align="center">Madera</h1>

<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Veuillez vous connecter</h3>
                </div>
                <div class="panel-body">
                    <?php

                    echo form_open('index.php/Connexion/tentativeConnexion');

                    echo validation_errors();

                    echo "<p class='form-group'> ";
                    echo form_input('username', $this->input->post('username'), ['class' => 'form-control', 'placeholder' => 'Identifiant']);
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_password(['name' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe']);
                    echo "</p>";

                    echo "<p>";
                    echo form_submit('login_submit', 'Connexion', ['class' => 'btn btn-primary btn-lg']);
                    echo "</p>";

                    echo form_close();

                    ?></div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</div>
</body>

</html>