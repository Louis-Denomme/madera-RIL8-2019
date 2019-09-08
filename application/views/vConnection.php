<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card p-5">
                <div class="card-body">
                    <h3 class="card-title">Veuillez vous connecter</h3>
                </div>
                <div class="card-text">
                    <?php

                    echo form_open('index.php/cConnection/tryConnection');

                    echo validation_errors();

                    echo "<p class='form-group'> ";
                    echo form_input('username', $this->input->post('username'), array('class' => 'form-control', 'placeholder' => 'Identifiant'));
                    echo "</p> ";

                    echo "<p class='form-group'> ";
                    echo form_password(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe'));
                    echo "</p>";

                    echo "<div class='mt-3 text-right'>";
                    echo form_submit('login_submit', 'Connexion', array('class' => 'btn btn-primary btn-lg'));
                    echo "</div>";

                    echo form_close();

                    ?></div>
            </div>
        </div>
    </div>

</div>