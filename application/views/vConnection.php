<html>

<head>

    <title>Madera - Connexion</title>

    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/Connection.js"></script>
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

                    <form action="<?= base_url() ?>index.php/cConnection/tryConnection" method="post">
                        <?= validation_errors(); ?>

                        <p class='form-group'>
                            <input type="text" id="username" name="username" class="form-control"
                                   placeholder="Identifiant" required/>
                        </p>

                        <p class='form-group'>
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="Mot de passe" required/>
                        </p>

                        <button id="loginSubmit" name="loginSubmit" class="btn btn-primary btn-lg"> Se connecter </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
