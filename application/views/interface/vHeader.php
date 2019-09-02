<!DOCTYPE html>
<html>
    <body>
        <div id="myHeader">
            <div id="logo">
                MADERA
            </div>
            <div id="createAccountSubmit" class="btn">
                <button id="createAccountSubmit" name="createAccountSubmit" class="btn btn-primary btn-lg" onclick="window.location='<?php echo base_url() . "index.php/cHome/loadCreateAccountView"; ?>'">Création de Compte</button>
            </div>


            <div id="disconnectionButton" class="btn">
                <button type="button" class="btn" onclick="window.location='<?php echo base_url()?>index.php/cConnection/logout'">Déconnexion</button>
            </div>

        </div>
    </body>
</html>
