<?php
include_once('modele/connexion_sql.php');

if (!isset($_REQUEST['section']))
{
    include_once('controleur/annuaire/index.php');
}

if (isset($_REQUEST['section']) && $_REQUEST['section'] == 'categorie')
{
    include_once('controleur/annuaire/categorie.php');
}

if (isset($_REQUEST['section']) && $_REQUEST['section'] == 'fiche')
{
    include_once('controleur/annuaire/fiche.php');
}
if (isset($_REQUEST['section']) && $_REQUEST['section'] == 'recherche')
{
    include_once('controleur/annuaire/recherche.php');
}
?>