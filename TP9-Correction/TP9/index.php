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

switch ($action) {

    case 'saisir':
        $val = ['nom' => '', 'prenom' => '', 'dateN' => ''];
        $err = ['nom' => '', 'prenom' => '', 'dateN' => ''];

        $zonePrincipale .= "<h2>Nouvelle personne</h2>";
        $zonePrincipale .= formPersonne('enregistrer&mode=' . $mode, $val, $err);
        break;

    case 'enregistrer':
        [$val, $err] = validerPersonne($_POST);

        $aErreur = false;
        foreach ($err as $e) {
            if ($e !== '') {
                $aErreur = true;
                break;
            }
        }

        if ($aErreur) {
            $zonePrincipale .= "<h2>Nouvelle personne</h2>";
            $zonePrincipale .= formPersonne('enregistrer&mode=' . $mode, $val, $err);
        } else {
            $p = new Personne(null, $val['nom'], $val['prenom'], $val['dateN']);
            $ok = $p->insert($pdo, $mode);

            if ($ok) {
                $taille = 10;
                $total = Personne::countAll($pdo);

                $from = (int)(floor(($total - 1) / $taille) * $taille + 1);
                $to   = min($from + $taille - 1, $total);

                header("Location: index.php?action=afficher&mode={$mode}&from={$from}&to={$to}");
                exit;
            } else {
                $zonePrincipale .= "<p style='color:red;'>Erreur lors de l'ajout.</p>";
            }
        }
        break;

    case 'edit':
        $id = (int)($_GET['id'] ?? 0);
        $from = (int)($_GET['from'] ?? 1);
        $to   = (int)($_GET['to'] ?? 10);

        $p = Personne::findById($pdo, $id, $mode);

        if ($p === null) {
            $zonePrincipale .= "<p style='color:red;'>Personne introuvable.</p>";
        } else {
            $val = [
                'nom'    => $p->getNom(),
                'prenom' => $p->getPrenom(),
                'dateN'  => $p->getDateN()
            ];
            $err = ['nom' => '', 'prenom' => '', 'dateN' => ''];

            $zonePrincipale .= "<h2>Modifier une personne</h2>";
            $zonePrincipale .= formPersonne('update&mode=' . $mode, $val, $err, $p->getId(), $from, $to);
        }
        break;

    case 'update':
        $id = (int)($_POST['id'] ?? 0);
        [$val, $err] = validerPersonne($_POST);

        $aErreur = false;
        foreach ($err as $e) {
            if ($e !== '') {
                $aErreur = true;
                break;
            }
        }

        if ($aErreur) {
            $from = (int)($_POST['from'] ?? 1);
            $to   = (int)($_POST['to'] ?? 10);

            $zonePrincipale .= "<h2>Modifier une personne</h2>";
            $zonePrincipale .= formPersonne('update&mode=' . $mode, $val, $err, $id, $from, $to);
        } else {
            $p = new Personne($id, $val['nom'], $val['prenom'], $val['dateN']);
            $ok = $p->update($pdo, $mode);

            if ($ok) {
                $page = Personne::findPageOfId($pdo, $id, 10);
                $from = $page['from'];
                $to   = $page['to'];

                header("Location: index.php?action=afficher&mode={$mode}&from={$from}&to={$to}");
                exit;
            } else {
                $zonePrincipale .= "<p style='color:red;'>Aucune modification effectuée.</p>";
            }
        }
        break;

    case 'delete':
        $id   = (int)($_GET['id'] ?? 0);
        $from = (int)($_GET['from'] ?? 1);
        $to   = (int)($_GET['to'] ?? 10);

        $p = Personne::findById($pdo, $id, $mode);

        if ($p !== null) {
            $p->delete($pdo, $mode);
        }

        $total = Personne::countAll($pdo);
        $taillePage = 10;

        if ($total <= 0) {
            header("Location: index.php?action=afficher&mode={$mode}");
            exit;
        }

        if ($from < 1) $from = 1;

        if ($from > $total) {
            $from = (int)(floor(($total - 1) / $taillePage) * $taillePage + 1);
        }

        $to = min($from + $taillePage - 1, $total);

        header("Location: index.php?action=afficher&mode={$mode}&from={$from}&to={$to}");
        exit;

    case 'rechercher':
        $q = trim($_GET['q'] ?? '');

        $total = Personne::countSearch($pdo, $q, $mode);

        $from = (int)($_GET['from'] ?? 1);
        $to   = (int)($_GET['to'] ?? min(10, max(1, $total)));

        if ($from < 1) $from = 1;
        if ($to > $total) $to = $total;
        if ($to < $from) $to = $from;

        $personnes = Personne::search($pdo, $q, $mode, $from, $to);

        $zonePrincipale  = "<h2>Résultats de la recherche</h2>";
        $zonePrincipale .= "<p>Recherche : <b>" . h($q) . "</b></p>";
        $zonePrincipale .= "<p>Mode courant : <b>" . ($mode === 'p' ? 'requêtes préparées' : 'requêtes non préparées') . "</b></p>";
        $zonePrincipale .= "<p>Affichage des lignes <b>{$from}</b> à <b>{$to}</b> sur <b>{$total}</b>.</p>";
        $zonePrincipale .= tablePersonnes($personnes, $mode, $from, $to);
        $zonePrincipale .= boutonsPaginationRecherche($q, $from, $to, $total, 10, $mode);
        break;

    case 'afficher':
    default:
        $total = Personne::countAll($pdo);

        $from = (int)($_GET['from'] ?? 1);
        $to   = (int)($_GET['to'] ?? min(10, max(1, $total)));

        if ($from < 1) $from = 1;
        if ($to > $total) $to = $total;
        if ($to < $from) $to = $from;

        $personnes = Personne::findInterval($pdo, $from, $to, $mode);

        $zonePrincipale .= "<h2>Liste des personnes</h2>";
        $zonePrincipale .= "<p>Mode courant : <b>" . ($mode === 'p' ? 'requêtes préparées' : 'requêtes non préparées') . "</b></p>";
        $zonePrincipale .= "<p>Affichage des lignes <b>{$from}</b> à <b>{$to}</b> sur <b>{$total}</b>.</p>";
        $zonePrincipale .= tablePersonnes($personnes, $mode, $from, $to);
        $zonePrincipale .= boutonsPagination($from, $to, $total, 10, $mode);
        break;
}

require('squelette.php');
