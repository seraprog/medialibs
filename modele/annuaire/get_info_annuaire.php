<?php
ini_set("display_errors",0);error_reporting(0);
function get_fiche_annuaire($id_cat)
{
    global $bdd;

    if($id_cat!=""){
    $req = $bdd->prepare('SELECT * FROM fiche WHERE id_cat_parent=:id_cat ORDER BY id_fiche DESC');
    $req->execute(array(
    'id_cat' => $id_cat));
	}else{
		$req = $bdd->prepare('SELECT * FROM fiche ORDER BY id_fiche DESC');
		$req->execute();
	}
	
    
    $fiche = $req->fetchAll();
    
	
// On affiche la

    return $fiche;
}
function get_categorie_annuaire()
{
    global $bdd;
	
    $req = $bdd->prepare('SELECT * FROM categorie ORDER BY id_cat DESC');
   
    $req->execute();
    $categorie = $req->fetchAll();
    
	
// On affiche la

    return $categorie;
}

// selct 
function get_categorie_annuairenn()
{
    global $bdd;
	
    $req = $bdd->prepare('SELECT * FROM categorie ORDER BY id_cat DESC');
   
    $req->execute();
    $categorie = $req->fetchAll();
    
	
// On affiche la

    return $categorie;
}


function get_fiche_annuaire_all(){
	 global $bdd;
	
    $req = $bdd->prepare('SELECT * FROM fiche ORDER BY id_fiche DESC');
    $req->execute();
    $fiche = $req->fetchAll();
// On affiche la

    return $fiche;
}

function get_sous_categorie_annuaire($id_cat)
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT * FROM categorie WHERE id_cat=:id_cat');
   
	$req->execute(array(
    'id_cat' => $id_cat));
	
    $categorie = $req->fetchAll();
    
	
// On affiche la

    return $categorie;
}

function get_sous_categorie_annuaire_menu($id_cat)
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT * FROM categorie WHERE id_cat_fils=:id_cat');
   
	$req->execute(array(
    'id_cat' => $id_cat));
	
    $categorie = $req->fetchAll();
    
	
// On affiche la

    return $categorie;
}


function get_sous_fiche_annuaire($id_fiche)
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT * FROM fiche WHERE id_fiche=:id_fiche');
   
	$req->execute(array(
    'id_fiche' => $id_fiche));
	
    $categorie = $req->fetchAll();
    
	
// On affiche la

    return $categorie;
}

function get_categorie_annuaire_doublon($nom_cat_parent,$id_cat_fils)
{
    global $bdd;
        
    $req = $bdd->prepare('SELECT * FROM categorie WHERE nom_cat_parent=:nom_cat_parent AND id_cat_fils=:id_cat_fils');
   
	$req->execute(array(
    'nom_cat_parent' => $nom_cat_parent,
	'id_cat_fils' => $id_cat_fils));
	
    $categorie = $req->fetchAll();

// On affiche la

    return $categorie;
}

function get_fiche_annuaire_doublon($nom_cat_parent,$nom_site)
{
    global $bdd;
    
	
    $req = $bdd->prepare('SELECT * FROM fiche WHERE id_cat_parent=:id_cat_parent AND nom_site=:nom_site');
   
	$req->execute(array(
    'id_cat_parent' => $nom_cat_parent,
	'nom_site' => $nom_site));
	
    $categorie = $req->fetchAll();
	
// On affiche la

    return $categorie;
}


//update 

function update_info_categorie($nom_cat_parent,$id_categorie_parent,$id_cat){
	global $bdd;
$sql = "UPDATE categorie SET nom_cat_parent = :nom_cat_parent, 
            id_cat_fils = :id_cat_fils 
            WHERE id_cat = :id_cat";
			
$req = $bdd->prepare($sql); 
$req->execute(array(
    'nom_cat_parent' => $nom_cat_parent,
	'id_cat_fils' => $id_categorie_parent,
	'id_cat' => $id_cat
	));

}

function update_info_fiche($id_cat_parent,$name_site,$url_site,$description,$url_image,$name_image,$publish,$id_fiche){
	global $bdd;
$sql = "UPDATE fiche SET id_cat_parent = :id_cat_parent,nom_site=:nom_site,url_site=:url_site,description=:description,url_image=:url_image,name_image=:name_image,statut=:publish 
            WHERE id_fiche = :id_fiche";
			
$req = $bdd->prepare($sql); 
$req->execute(array(
    'id_cat_parent' => $id_cat_parent,
	'nom_site' => $name_site,
	'url_site' => $url_site,
	'description' => $description,
	'url_image' => $url_image,
	'name_image' => $name_image,
	'publish' => $publish,
	'id_fiche' => $id_fiche
	));


}

//update 

function delete_info_categorie($id_cat){
	global $bdd;
	
	$sql = "DELETE FROM categorie WHERE id_cat = :id_cat";
	$req = $bdd->prepare($sql);
	$req->bindParam(':id_cat',$id_cat, PDO::PARAM_INT);   
	$req->execute();
	
	//suppression des sous categories
	/*$sql = "DELETE FROM categorie WHERE id_cat_fils = :id_cat";
	$req = $bdd->prepare($sql);
	$req->bindParam(':id_cat',$id_cat, PDO::PARAM_INT);   
	$req->execute();*/

}

function delete_info_fiche($id_fiche){
	global $bdd;
	
	$sql = "DELETE FROM fiche WHERE id_fiche = :id_fiche";
	$req = $bdd->prepare($sql);
	$req->bindParam(':id_fiche',$id_fiche, PDO::PARAM_INT);   
	$req->execute();
	
	//suppression des sous categories
	/*$sql = "DELETE FROM categorie WHERE id_cat_fils = :id_cat";
	$req = $bdd->prepare($sql);
	$req->bindParam(':id_cat',$id_cat, PDO::PARAM_INT);   
	$req->execute();*/

}

function set_info_categorie($nom_cat_parent,$id_categorie_parent){
global $bdd;
$req = $bdd->prepare('INSERT INTO categorie(nom_cat_parent,id_cat_fils) VALUES(:nom_cat_parent,:id_categorie_parent)');
$req->execute(array(
	'nom_cat_parent' => $nom_cat_parent,
	'id_categorie_parent' => $id_categorie_parent
	));
	
}
//insertion fiche
function set_info_fiche($id_categorie,$name_site,$url_site,$description,$url_image,$name_image,$publish){
global $bdd;
$req = $bdd->prepare('INSERT INTO fiche(id_cat_parent,nom_site,url_site,description,url_image,name_image,statut) VALUES(:id_cat_parent,:nom_site,:url_site,:description,:url_image,:name_image,:publish)');
$req->execute(array(
	'id_cat_parent' => $id_categorie,
	'nom_site' => $name_site,
	'url_site' => $url_site,
	'description' => $description,
	'url_image' => $url_image,
	'name_image' => $name_image,
	'publish'	=> $publish
	
	));
	
}
?>