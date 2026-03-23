<?php

require_once('lib.php');


$pdo = connexionPDO();

$action = $_GET['action'] ?? 'afficher';
$mode = $_GET['mode'] ?? ($_POST['mode'] ?? 'np');
$zonePrincipale = '';

$from = $_GET['from'] ?? null;
$to   = $_GET['to'] ?? null;

if ($pdo === null) {
    $zonePrincipale = "<p style='color:red;'>Connexion à la base impossible.</p>";
    require('squelette.php');
    exit;
}
else{
    $zonePrincipale = "<p style='color:green;'>Connexion établie.</p>";
}



switch($action)
{


    case 'saisir':

        // A COMPLETER :
        // afficher le formulaire de saisie

        $val = ['nom' => '', 'prenom' => '', 'dateN' => ''];
        $err = ['nom' => '', 'prenom' => '', 'dateN' => ''];

        $zonePrincipale .= "<h2>Nouvelle personne</h2>";
        $zonePrincipale .= formPersonne('enregistrer&mode=' . $mode, $val, $err);
        break;

    case 'enregistrer':

        // A COMPLETER :
        // récupérer les données POST
        // valider
        // insérer en base

        list($val, $err) = validerPersonne($_POST);

        
        if (empty($err['nom']) && empty($err['prenom']) && empty($err['dateN'])) {
            $p = new Personne(null, $val['nom'], $val['prenom'], $val['dateN']);
            
            if ($p->insert($pdo, $mode)) {
                $zonePrincipale .= "<p style='color:green;'>Personne ajoutée avec succès.</p>";
            } else {
                $zonePrincipale .= "<p style='color:red;'>Erreur lors de l'ajout.</p>";
            }
            
            $action = 'afficher';
        } else {
            $zonePrincipale .= "<h2>Nouvelle personne</h2>";
            $zonePrincipale .= formPersonne('enregistrer&mode=' . $mode, $val, $err);
        }

        break;



    case 'edit':

        // A COMPLETER :
        // récupérer id
        // charger la personne
        // afficher le formulaire pré-rempli

        $id = (int)($_GET['id'] ?? 0);
        $p = Personne::findById($pdo, $id, $mode);
        
        if ($p) {
            $val = ['nom' => $p->getNom(), 'prenom' => $p->getPrenom(), 'dateN' => $p->getDateN()];
            $err = ['nom' => '', 'prenom' => '', 'dateN' => ''];
            
            $zonePrincipale .= "<h2>Modifier personne</h2>";
            $zonePrincipale .= formPersonne('update&mode=' . $mode, $val, $err, $id, $from, $to);
        } else {
            $zonePrincipale .= "<p style='color:red;'>Personne non trouvée.</p>";
        }

        break;



    case 'update':

        // A COMPLETER :
        // mettre à jour la personne

        list($val, $err) = validerPersonne($_POST);
        $id = (int)($_POST['id'] ?? 0);
        
        if (empty($err['nom']) && empty($err['prenom']) && empty($err['dateN'])) {
            $p = new Personne($id, $val['nom'], $val['prenom'], $val['dateN']);
            
            if ($p->update($pdo, $mode)) {
                $zonePrincipale .= "<p style='color:green;'>Personne mise à jour avec succès.</p>";
            } else {
                $zonePrincipale .= "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
            }
            
            $action = 'afficher';
        } else {
            $zonePrincipale .= "<h2>Modifier personne</h2>";
            $zonePrincipale .= formPersonne('update&mode=' . $mode, $val, $err, $id, $from, $to);
        }

        break;



    case 'delete':

        // A COMPLETER :
        // supprimer la personne

        $id = (int)($_GET['id'] ?? 0);
        $p = Personne::findById($pdo, $id, $mode);
        
        if ($p) {
            if ($p->delete($pdo, $mode)) {
                $zonePrincipale .= "<p style='color:green;'>Personne supprimée avec succès.</p>";
            } else {
                $zonePrincipale .= "<p style='color:red;'>Erreur lors de la suppression.</p>";
            }
        }
        
        $action = 'afficher';
        break;



    case 'afficher':
    default:

        // A COMPLETER :
        // afficher la liste des personnes

        $total = Personne::countAll($pdo);

        $zonePrincipale .= "<h2>Liste des personnes</h2>";
        $zonePrincipale .= "<p>Mode courant : <b>" . ($mode === 'p' ? 'requêtes préparées' : 'requêtes non préparées') . "</b></p>";
        $zonePrincipale .= formRecherche($mode, '');
        $zonePrincipale .= "<p>affichage des lignes <strong>1</strong> à <strong>" . $total ."</strong></p>";
        $zonePrincipale .= "<p><a href='index.php?action=saisir&mode={$mode}'>➕ Ajouter une personne</a></p>";
        // Formulaire de recherche par ID
        $searchId = (int)($_GET['searchId'] ?? 0);
        $zonePrincipale .= "<form action='index.php' method='get'>"; // envoie dans l url les value
        $zonePrincipale .= "<input type='hidden' name='action' value='afficher'>";
        $zonePrincipale .= "<input type='hidden' name='mode' value='{$mode}'>";
        $zonePrincipale .= "<label for='searchId'><b>Afficher détail personne :</b></label>";
        $zonePrincipale .= "<input type='text' id='searchId' name='searchId' placeholder='IDd' value='{$searchId}'>"; // value permet que le champ reste préremplis
        $zonePrincipale .= "<button type='submit'>Chercher</button>";
        $zonePrincipale .= "</form>";

        // GITHUB COPILOT : Affichage du détail si un ID est fourni
        if ($searchId > 0) {
            $p = Personne::findById($pdo, $searchId, $mode);
            if ($p) {
                $zonePrincipale .= afficherPersonneDetail($p);
            } else {
                $zonePrincipale .= "<p style='color:red;'>Personne non trouvée.</p>";
            }
        }
        
        // GITHUB COPILOT : Affichage de la liste complète
        $personnes = Personne::findAll($pdo, $mode);
        $zonePrincipale .= tablePersonnes($personnes, $mode);
        break;

}


require('squelette.php');
