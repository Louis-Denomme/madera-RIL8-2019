<div class="container h-100 scroll-auto bg-light p-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h4 class="mb-5 h4">Pourcentages appliqués aux prix de base pour définir le prix de vente</h4>

            <div class="card-text">
                <?php
                echo "<table class='table'>";
                echo "<thead class='black white-text' align='center'>";
                echo "<tr>";

                echo "<th scope='col'>";
                echo "Marge Commerciale (%)";
                echo "</th>";

                echo "<th scope='col'>";
                echo "Marge Entreprise (%)";
                echo "</th>";

                echo "<th colspan='2' scope='col'>";
                echo "Action";
                echo "</th>";

                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                echo "<tr>";

                echo "<td scope='col'>";
                echo form_input(array('id' => 'idMargeCommerciale', 'name' => 'margeCommerciale', 'type' => 'number', 'min' => '0', 'max' => '100', 'class' => 'form-control', 'value' => $this->currentMarge->getMargeCommerciale(), 'disabled' => 'true'));
                echo form_error('margeCommerciale');
                echo "</td>";

                echo "<td scope='col'>";
                echo form_input(array('id' => 'idMargeEntreprise', 'name' => 'margeEntreprise', 'type' => 'number', 'min' => '0', 'max' => '100', 'class' => 'form-control', 'value' => $this->currentMarge->getMargeEntreprise(), 'disabled' => 'true'));
                echo form_error('margeEntreprise');
                echo "</td>";

                echo "<td scope='col'>";
                echo "<input id='idButtonSubmit' class='btn btn-primary btn-lg' type='button' value='Modifier' onclick='Parameter.ChangeMode(this.value)'></input>";
                echo "</td>";

                echo "<td scope='col'>";
                echo "<input id='idButtonCancel' class='btn btn-secondary btn-lg' type='button' value='Annuler' style='visibility: hidden' onclick='Parameter.ChangeMode(this.value)'></input>";
                echo "</td>";

                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
</div>