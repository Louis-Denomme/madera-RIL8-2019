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
            //Form rempli on doit redirect
            redirect('index.php/Devis/config');
        } else if (!is_null($idGamme)) {
            $devis['idGamme'] = $idGamme;
            //TODO load les modèles depuis la bdd
            $data['modeles'] = [
            ];
            $query = $this->db->get('modele');
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

    function recap()
    {
        //checkLogin();
        //TODO 

        $data = [];

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
        if (!array_key_exists('modules', $devis)) {
            $num = 1;
            $devis['modules'] = [
                ['num' => $num++, 'id' => 1, 'nom' => 'Enduit Exterieur'],
                ['num' => $num++, 'id' => 5, 'nom' => 'Salon'],
            ];
        }

        //TODO Chargement de la liste de tout les modules triés par types
        $data = [
            'modulesGroups' => [
                'Bati' => [
                    ['id' => 1, 'nom' => 'Enduit Exterieur'],
                    ['id' => 2, 'nom' => 'Construction sur pilotis'],
                    ['id' => 3, 'nom' => 'Vide sanitaire']
                ],
                'Pieces' => [
                    ['id' => 4, 'nom' => 'Cuisine'],
                    ['id' => 5, 'nom' => 'Salon'],
                    ['id' => 6, 'nom' => 'Salle de bain']
                ]
            ]
        ];


        $data['devis'] = $devis;

        $this->session->set_userdata('devis', $devis);

        $this->load->view('parts/vHeader');

        $this->load->view(
            'Devis/vChoixModules',
            $data
        );

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
