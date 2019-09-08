<!DOCTYPE html>
<html>
<head>
    <title>Madera - Création de compte</title>
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<h1>Demande de création de compte.</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-4">
            <div class="card">
                <div class="card-header">Inscription</div>
                <div class="card-body">

                    <form class="form-horizontal" method="post"
                          action="<?= base_url() ?>index.php/cHome/tryCreateAccount">

                        <?= validation_errors(); ?>


                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Nom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nom"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Prenom</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="firstname" id="firstname"
                                           placeholder="Prénom" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Identifiant</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="username" id="username"
                                           placeholder="Identifiant" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Mot de passe" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label">Confirmer mot de passe</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="confirmPassword"
                                           id="confirmPassword"
                                           placeholder="Confirmation mot de passe" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="profil" class="cols-sm-2 control-label">Profil utilisateur</label>
                            <div class="cols-sm-10">

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="profilAdmin"
                                           name="profil">
                                    <label for="profilAdmin">Admin</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="profilCommercial"
                                           name="profil" checked>
                                    <label  for="profilCommercial">Commercial</label>
                                </div>

                            </div>
                        </div>


                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Envoyer</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


</body>
</html>