<?php
ini_set("display_errors",0);error_reporting(0);
include_once('modele/connexion_sql.php');


?><!DOCTYPE html>
<html>
  <head>
    <title>Annuaire seraphin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
	<link href="css/medialibs-custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">TEST-MEDIALIBS-SERAPHIN</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Gestion <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
							  <li><a href="index.php?section=categorie">Gestion cat&eacute;gorie</a></li>
							  <li><a href="index.php?section=fiche">Gestion fiche</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-4">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
					<?php
						$cat_all	=	array();
						$cat_all = get_categorie_annuaire();
						foreach($cat_all as $cat_main){  
					?>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> <?php echo $cat_main['nom_cat_parent']; ?>
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
						 <ul>
						 <?php 
							$cat_all_s = array();
							$cat_all_s = get_sous_categorie_annuaire_menu($cat_main['id_cat']);
							foreach($cat_all_s as $cat){
						 ?>
                         
                            <li>
								<a href="index.php?cat=<?php echo $cat['id_cat'];?>"><?php echo $cat['nom_cat_parent'];?></a>
							</li>
                        
						<?php
							}
						?>
						</ul>
                    </li>
					<?php
						}
					?>
					 
                </ul>
             </div>
		  </div>
		  
		  <div class="col-md-8">
		  	<div class="row">
		  		
				<div class="col-md-12">
	  					<div class="content-box-large">
			  				<div class="panel-heading">
					            <div class="panel-title">Fiche de renseignement du site</div>
					        </div>
			  				<div class="panel-body">
			  					<form class="form-horizontal" method="POST" action="index.php?section=fiche" role="form">
								   <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Cat&eacute;gorie</label>
										<div class="col-sm-10">
										 
											<select class="form-control" name="id_categorie" id="select-1">
												<?php
												
												foreach($categories as $key=>$categorie)
												{
													//get_sous_categorie_annuaire($id_cat);
												if($categories_update[$key]['id_cat'] == $categories[$key]['id_cat']) $selected = "selected";
												else $selected = "";
												?>
												<option selected="<?php echo $selected;?>" value="<?php echo $categorie['id_cat'];?>"><?php echo $categorie['nom_cat_parent'];?></option>
												<?php
												}
												?>
											</select>
										</div>
								   </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Nom du site</label>
								    <div class="col-sm-10">
										<?php 
											if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
										?>
											<input type="text" class="form-control" name="name_site" id="inputEmail3" value="<?php echo $fiche_update[0]['nom_site']; ?>" placeholder="site seraphin">
										<?php
											}else{
										?>
											<input type="text" class="form-control" name="name_site" id="inputEmail3"  placeholder="site seraphin">
										<?php		
											}
										?>
									</div>
								  </div>
								  <?php 
										if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
									?>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Url du site</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="url_site" value="<?php echo $fiche_update[0]['url_site']; ?>" id="url_site" placeholder="https://www.site.com">
								    </div>
								  </div>
								  <div class="form-group">
								    <label class="col-sm-2 control-label">Description</label>
								    <div class="col-sm-10">
								      <textarea class="form-control" name="description"  placeholder="Apropos du site" rows="3"><?php echo $fiche_update[0]['description']; ?></textarea>
								    </div>
								  </div>
								  <div class="form-group">
										<label class="col-md-2 control-label">Image apercu du site (<font color="red">pas fonctionnel</font>)</label>
										<div class="col-md-10">
											<input type="file" name="fichier" class="btn btn-default" id="exampleInputFile1">
											<p class="help-block">
											</p>
										</div>
									</div>
								  
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-2">
								      <button type="submit" class="btn btn-primary">Modifier</button>
								    </div>
									<div class="col-sm-offset-2 col-sm-2">
								      <a href="index.php?section=fiche"><button class="btn btn-primary">cr&eacute;er</button></a>
								    </div>
								  </div>
								  <?php 
										}else{
								   ?>
									 <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Url du site</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="url_site" id="url_site" placeholder="https://www.site.com">
								    </div>
								  </div>
								  <div class="form-group">
								    <label class="col-sm-2 control-label">Description</label>
								    <div class="col-sm-10">
								      <textarea class="form-control" name="description" placeholder="Apropos du site" rows="3"></textarea>
								    </div>
								  </div>
								  <div class="form-group">
										<label class="col-md-2 control-label">Image apercu du site</label>
										<div class="col-md-10">
											<input type="file" name="fichier" class="btn btn-default" id="exampleInputFile1">
											<p class="help-block">
											</p>
										</div>
									</div>
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" class="btn btn-primary">Cr&eacute;er</button>
								    </div>
								  </div>
								   
								   <?php 
										}
									?>
								   
								   <?php 
									if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
									?>
										<input type="hidden" name="update_on" value="<?php echo $_REQUEST['update'];?>">
										<input type="hidden" name="id_fiche_update" value="<?php echo $_REQUEST['id_fiche_update'];?>">
										<input type="hidden" name="id_cat_parent" value="<?php echo $_REQUEST['id_cat_parent'];?>">
									<?php 
									}
									?>
								</form>
			  				</div>
			  			</div>
	  				</div>
		  		
		  	</div>
			
			<div class="row">
			<div class="col-md-12">
			<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">Listes des fiches</div>
				</div>
  				<div class="panel-body">
  					<div class="table-responsive">
  						<table class="table">
			              <thead>
			                <tr>
			                  <th>id</th>
			                  <th>Nom du site</th>
			                  <th>Description</th>
							  <th>visualiser</th>
			                  <th>modifier</th>
							  <th>supprimer</th>
			                </tr>
			              </thead>
			              <tbody>
							<?php
							foreach($fiches as $key=>$fiche)
							{
							?>
			                <tr>
			                  <td><?php echo $fiche['id_fiche'];?></td>
			                  <td><a href="<?php echo $fiche['id_fiche'];?>"><?php echo $fiche['nom_site'];?></a></td>
			                  <td><?php echo $fiche['description'];?></td>
							  <td><a href="index.php?section=fiche&update=on&id_fiche_view=<?php echo $fiche['id_fiche'];?>"><button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button></a></td>
			                  <td><a href="index.php?section=fiche&update=on&id_fiche_update=<?php echo $fiche['id_fiche'];?>&id_cat_parent=<?php echo $fiche['id_cat_parent'];?>"><button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button></a></td>
							  <td><a href="index.php?section=fiche&delete=on&id_fiche_delete=<?php echo $fiche['id_fiche'];?>"><button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></a></td>
			                </tr>
							<?php 
							}
							?>
			              </tbody>
			            </table>
  					</div>
  				</div>
  			</div>
			</div>
		</div>

		  </div>
		</div>
		
		
		
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2017 <a href='#'>seraprog</a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>