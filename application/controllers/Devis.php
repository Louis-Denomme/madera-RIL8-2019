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

        redirect('index.php/Devis/recap/'.$idDevis);

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
        $data = ['gammes' => []];

        foreach ($query->result() as $row)
        {
            array_push($data['gammes'], ['id' => $row->id , 'nom' => $row->libelle]);
        }

        if (!is_null($idModele)) {
            $devis['idModele'] = $idModele;
            $this->session->set_userdata('devis', $devis);
            //Form rempli on doit redirect
            redirect('index.php/Devis/insert');
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

        //Ajout du devis
        $data = array(
            'id' => $idDevis,
            'idClient' => 1,
            'idModele' => $devis['idModele'],
            'etat' => '1',
            'dateCreation' => date("Y-m-d H:i:s"),
            'adresse' => 'TODO VIVIEN',
            'idUserCreation' => $this->session->userdata['idProfile'],
            'dateModif' => date("Y-m-d H:i:s"),
            'idUserModif' => $this->session->userdata['idProfile']
        );

        $this->db->insert('devis', $data);

        //Ajout des modules du modèle de base
        $this->db->query('INSERT INTO devismodules (devismodules.idDevis, devismodules.idModule) SELECT '. $idDevis .', moduledansmodele.idModule FROM moduledansmodele WHERE moduledansmodele.idModele = '. $devis['idModele'] .';');
        $this->majPrixDevis($idDevis);
        redirect('index.php/Devis/config/'.$idDevis);
    }

    function majPrixDevis($idDevis){
        $this->db->query('UPDATE devis SET devis.prixTotal = (SELECT SUM(composant.prix) FROM module INNER JOIN devismodules ON devismodules.idModule = module.id LEFT JOIN composantdansmodule ON composantdansmodule.idModule = module.id LEFT JOIN composant ON composantdansmodule.idComposant = composant.id WHERE devismodules.idDevis = '.$idDevis.') WHERE devis.id = '.$idDevis.';');
    }

    function edit($idDevis){

    }

    function recap($id)
    {
        //checkLogin();
        //TODO 
        $devis = $this->db->get_where('devis', array('id' => $id))->result()[0];
        $client = $this->db->get_where('client', array('id' => $devis->idClient))->result()[0];

        $this->db->select('module.libelle AS moduleLib, module.reference, typemodule.libelle AS typeModuleLib ');
        $this->db->from('module');
        $this->db->join('devismodules', 'devismodules.idModule = module.id','INNER');
        $this->db->join('typemodule','typemodule.id = module.idTypeModule','INNER');
        $this->db->join('devis','devis.id = devismodules.idDevis','INNER');
        $this->db->where('devis.id', $devis->id);
        $modules = $this->db->get()->result();
        //$modules = $this->db->get_where('devismodules', array('idDevis' => $devis->id))->result();

        $etatLibelle = $this->getEtatDevis($devis->etat);
        $data['devis'] = $devis;
        $data['client'] = $client;
        $data['etatLibelle'] = $etatLibelle;
        if(count($modules)<=0){
            $data['hasResult'] = false;
        }else{
            $data['hasResult'] = true;
            $data['modules'] = $modules;
        }

        //var_dump($modules);
        $this->session->set_userdata('devis', $devis);


        $this->load->view('parts/vHeader');

        $this->load->view(
            'Devis/vRecap',
            $data
        );

        $this->load->view('parts/vFooter');
    }

    function config($idDevis)
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            show_error('Le devis est incorrect');

        //TODO Chargement des modules pour le modèle selectionné et ajout au devis
        //$query = $this->db->get_where('moduledansmodele', array('idModele' => $devis["idModele"]));
        $this->db->select('module.id, module.libelle, devismodules.id As num');
        $this->db->select_sum('composant.prix');
        $this->db->from('module');
        $this->db->join('devismodules', 'devismodules.idModule = module.id','INNER');
        $this->db->join('composantdansmodule','composantdansmodule.idModule = module.id','LEFT');
        $this->db->join('composant','composantdansmodule.idComposant = composant.id','LEFT');
        $this->db->where('devismodules.idDevis', $idDevis);
        $this->db->group_by('module.id');
        $query = $this->db->get();

        $devis = $this->db->get_where('devis', array('id' => $idDevis))->result()[0];
        //var_dump($query->result());
        $devisModules = array();
        foreach ($query->result() as $row)
        {
            array_push($devisModules, ['num' => $row->num, 'id' => $row->id , 'nom' => $row->libelle]);
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
                    array_push($data["modulesGroups"][$rowTypeModule->libelle], ['id' => $rowModuleGlobal->id, 'nom' => $rowModuleGlobal->libelle, 'ref' => $rowModuleGlobal->reference]);
                }
            }
        }
        //$devis->id= $idDevis;
        $data['devis'] = $devis;
        $data['devisModules'] = $devisModules;
        //var_dump($devis);
        $this->session->set_userdata('devis', $devis);

        $this->load->view('parts/vHeader');

        $this->load->view(
            'Devis/vChoixModules',
            $data
        );
        //var_dump($devis);
        $this->load->view('parts/vFooter');
    }

    function addModule($idDevis)
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            show_error('Le devis est incorrect');

        $idModule = $this->input->post('idModule');

        if (is_null($idModule))
            show_error('Pas d\'id module envoyé ?');

        //TODO load le module de la bdd et y ajouter le numMax
        $newModule = array(
            'idDevis' => $idDevis,
            'idModule' => $idModule
        );

        $this->db->insert('devismodules', $newModule);
        $this->majPrixDevis($devis->id);

        $moduleDeLaBdd = ['num' => ++$numMax, 'id' => $idModule, 'nom' => 'load depuis la bdd'];

        //$devis['modules'][] = $moduleDeLaBdd;

        $this->session->set_userdata('devis', $devis);

        redirect('index.php/Devis/config/'.$idDevis);
    }

    function editModule()
    {
        //checkLogin();
        $devis = $this->session->devis;

        if (is_null($devis))
            show_error('Le devis est incorrect');

        $numModule = $this->input->post('numModule');
        $idModule = $this->input->post('idModule');

        //var_dump($devis);
        $this->db->set('idModule', $idModule);
        $this->db->where('id', $numModule);
        $this->db->update('devismodules');

        //$this->db->update('devismodules', array('id' => $numModule));

        redirect('index.php/Devis/config/'.$devis->id);
    }


    function delModule()
    {

        //checkLogin();
        $devis = $this->session->devis;
        $num = $this->input->get('num');

        if (is_null($num))
            show_error('num not set');

        $this->db->delete('devismodules', array('id' => $num));
        $this->majPrixDevis($devis->id);

        $this->session->set_userdata('devis', $devis);


        redirect('index.php/Devis/config/'.$devis->id);
    }

    public function getEtatDevis($etat){
        switch ($etat){
            case 1:
                return "en attente de la validation client";
                break;
            case 2:
                return "en attente de la validation du BU";
                break;
            case 3:
                return "en attente de l'acceptation du client";
                break;
            case 4:
                return "devis accepté";
                break;
            case 5:
                return "devis refusé par le client";
                break;
            case 6:
                return "devis refusé par le BU";
                break;
            default:
                return "";
                break;
        }
    }
}
