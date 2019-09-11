<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Devis extends CI_Controller
{

    function index($idDevis)
    {
        checkLogin();

        $idDevis = intval($idDevis);
        if (!is_int($idDevis))
            show_error('ID incorrect ' . $idDevis);

        //TODO

        $this->load->view('parts/vHeader');

        //TODO afficher page recap ?

        $this->load->view('parts/vFooter');
    }

    function new()
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            $devis = [];

        $idClient = $this->input->post('idClient');
        $idGamme = $this->input->post('idGamme');
        $idModele = $this->input->post('idModele');
        if ($idClient) {
            $devis = []; //on reset le devis
            $devis['idClient'] = $idClient;
        }

        //TODO load les gammes depuis la bdd
        $this->load->database();
        $query = $this->db->get('gamme');
        $data =
            [
                'gammes' => []
            ];

        foreach ($query->result() as $row)
        {
            array_push($data['gammes'], ['id' => $row->id , 'nom' => $row->libelle]);
        }

        if (!is_null($idModele)) {
            $devis['idModele'] = $idModele;
            $this->session->set_userdata('devis', $devis);
            //Form rempli on doit redirect
            redirect('index.php/Devis/config');
        } else if (!is_null($idGamme)) {
            $devis['idGamme'] = $idGamme;
            //TODO load les modèles depuis la bdd
            $data['modeles'] = [];
            $query = $this->db->get_where('modele', array('idGamme' => $idGamme));
            foreach ($query->result() as $row)
            {
                array_push($data['modeles'], ['id' => $row->id , 'nom' => $row->libelle]);
            }
        }

        $data['devis'] = $devis;

        $this->session->set_userdata('devis', $devis);

        $this->load->view('parts/vHeader');

        $this->load->view(
            'Devis/vChoixGammeModele',
            $data
        );

        $this->load->view('parts/vFooter');
    }

    function insert(){
        $this->db->select_max('id');
        $this->db->from('devis');
        $query = $this->db->get();
        $resultat = $query->result();

        $idDevis = $resultat[0]->id == null ? 1 : $resultat[0]->id + 1 ;
        $devis = $this->session->devis;

        $data = array(
            'id' => $idDevis,
            'idClient' => 1,
            'idModele' => $devis['idModele'],
            'etat' => 'en attente BU',
            'dateCreation' => date("Y-m-d H:i:s"),
            'adresse' => 'TODO VIVIEN',
            'idUserCreation' => $this->session->userdata['idProfile'],
            'dateModif' => date("Y-m-d H:i:s"),
            'idUserModif' => $this->session->userdata['idProfile']
        );

        $this->db->insert('devis', $data);

        foreach ($devis['modules'] as $module){
            $data = array(
                'idDevis' => $idDevis,
                'idModule' => $module['id']
            );
            //var_dump($data);
            $this->db->insert('devismodules', $data);
        }
        //var_dump($devis);

        $this->recap();
    }

    function recap($id)
    {
        //checkLogin();
        //TODO 
        $devis = $this->db->get_where('devis', array('id' => $id))->result()[0];
        $client = $this->db->get_where('client', array('id' => $devis->idClient))->result()[0];

        $this->db->select('module.libelle, module.reference, typemodule.libelle ');
        $this->db->from('module');
        $this->db->join('devismodules', 'devismodules.idModule = module.id','INNER');
        $this->db->join('typemodule','typemodule.id = module.idTypeModule','INNER');
        $this->db->join('devis','devis.id = devismodules.idDevis','INNER');
        $this->db->where('devis.id', $devis->id);
        $modules = $this->db->get();
        //$modules = $this->db->get_where('devismodules', array('idDevis' => $devis->id))->result();

        if(count($modules)<=0){
            $data['hasResult'] = false;
        }else{
            $data['hasResult'] = true;
        }

        //var_dump($modules->result());


        $this->load->view('parts/vHeader');

        $this->load->view(
            'Devis/vRecap',
            $data
        );

        $this->load->view('parts/vFooter');
    }

    function config()
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            show_error('Le devis est incorrect');

        //TODO Chargement des modules pour le modèle selectionné et ajout au devis
        //$query = $this->db->get_where('moduledansmodele', array('idModele' => $devis["idModele"]));
        $this->db->select('module.id, module.libelle');
        $this->db->select_sum('composant.prix');
        $this->db->from('module');
        $this->db->join('moduledansmodele', 'moduledansmodele.idModule = module.id','INNER');
        $this->db->join('composantdansmodule','composantdansmodule.idModule = module.id','LEFT');
        $this->db->join('composant','composantdansmodule.idComposant = composant.id','LEFT');
        $this->db->where('moduledansmodele.idModele', $devis["idModele"]);
        $this->db->group_by('module.id');
        $query = $this->db->get();

        if (!array_key_exists('modules', $devis)) {
            $num = 1;
            $devis['modules'] = [];
            $devis['prixTotal'] = 0;
            foreach ($query->result() as $row)
            {
                array_push($devis['modules'], ['num' => $num, 'id' => $row->id , 'nom' => $row->libelle]);
                $devis['prixTotal'] += $row->prix != null ? $row->prix : 0;
                $num+=1;
            }
        }

        //TODO Chargement de la liste de tout les modules triés par types
        $modulesGlobale = $this->db->get("module");
        $typeModule = $this->db->get("typemodule");
        $data = ['modulesGroups' => []];

        foreach ($typeModule->result() as $rowTypeModule){
            foreach ( $modulesGlobale->result() as $rowModuleGlobal){
                if(!array_key_exists($rowTypeModule->libelle, $data["modulesGroups"])){
                    $data["modulesGroups"][$rowTypeModule->libelle] = [];
                }
                if($rowModuleGlobal->idTypeModule == $rowTypeModule->id){
                    array_push($data["modulesGroups"][$rowTypeModule->libelle], ['id' => $rowModuleGlobal->id, 'nom' => $rowModuleGlobal->libelle]);
                }
            }
        }
        $data['devis'] = $devis;

        $this->session->set_userdata('devis', $devis);

        $this->load->view('parts/vHeader');

        $this->load->view(
            'Devis/vChoixModules',
            $data
        );
        var_dump($devis['prixTotal']);
        $this->load->view('parts/vFooter');
    }

    function addModule()
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            show_error('Le devis est incorrect');

        $idModule = $this->input->post('idModule');

        if (is_null($idModule))
            show_error('Pas d\'id module envoyé ?');

        $numMax = 0;
        foreach ($devis['modules'] as $module) {
            if ($module['num'] > $numMax)
                $numMax = $module['num'];
        }

        //TODO load le module de la bdd et y ajouter le numMax
        $moduleDeLaBdd = ['num' => ++$numMax, 'id' => $idModule, 'nom' => 'load depuis la bdd'];

        $devis['modules'][] = $moduleDeLaBdd;

        $this->session->set_userdata('devis', $devis);

        redirect('index.php/Devis/config');
    }

    function editModule()
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            show_error('Le devis est incorrect');

        $numModule = $this->input->post('numModule');
        $idModule = $this->input->post('idModule');

        if (is_null($idModule) || is_null($numModule))
            show_error('Pas d\'id /num module envoyé ?');

        //TODO load le module de la bdd et y ajouter le numMax
        $moduleDeLaBdd = ['id' => $idModule, 'nom' => 'load depuis la bdd'];

        foreach ($devis['modules'] as &$module) {
            if ($module['num'] == $numModule) {
                $module = $moduleDeLaBdd;
                $module['num'] = $numModule;
                break;
            }
        }

        $this->session->set_userdata('devis', $devis);

        redirect('index.php/Devis/config');
    }

    function delModule()
    {
        //checkLogin();
        $devis = $this->session->devis;

        $num = $this->input->get('num');

        if (is_null($num))
            show_error('num not set');

        $index = 0;
        foreach ($devis['modules'] as $module) {
            if ($module['num'] == $num) {
                break;
            }
            $index++;
        }

        array_splice($devis['modules'], $index, 1);

        $this->session->set_userdata('devis', $devis);


        redirect('index.php/Devis/config');
    }
}
