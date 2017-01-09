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
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My gestion <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
							  <li><a href="index.php?section=categorie">Gestion cat&eacute;gorie</a></li>
							  <li><a href="index.php?section=fiche">Gestion fiche</a></li>
	                          <li><a href="">Logout</a></li>
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
		  <div class="col-md-2">
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
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-12">
	  					<div class="content-box-large">
			  				<div class="panel-heading">
					            <div class="panel-title">Gestion des cat&eacute;gories</div>
					        </div>
			  				<div class="panel-body">
			  					<form class="form-horizontal" role="form" method="POST" action="index.php">
								    <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Cat&eacute;gorie parents</label>
										<div class="col-sm-10">
											<?php 
												if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
													
											?>
											<select class="form-control" id="select-1" name="id_categorie_parent">
											
												<?php
												$selected = "";
												foreach($categories as $key=>$categorie)
												{
													//get_sous_categorie_annuaire($id_cat);
													
														$sous_categories =	get_sous_categorie_annuaire($categorie['id_cat_fils']);
														$a_sous_cat	=	array();
														$a_sous_cat_id	=	array();
														$s_sous_cat	=	"";
														$n_sous_cat	=	0;
														foreach($sous_categories as $key2=>$sous_categorie)
														{
															$a_sous_cat[]	=	$sous_categorie['nom_cat_parent'];
															$a_sous_cat_id[]	=	$sous_categorie['id_cat'];
														}
														
														 $s_sous_cat	=	implode(',',$a_sous_cat);
														 $n_sous_cat	=    intval(implode(',',$a_sous_cat_id));
														 if($categorie['id_cat'] == $n_sous_cat){
														?>
														<option selected value="<?php echo $n_sous_cat;?>"><?php echo $s_sous_cat;?></option>
														 <?php }
													    else{
														?>
														<option value="<?php echo $categorie['id_cat'];?>"><?php echo $categorie['nom_cat_parent'];?></option>
														<?php
														}
												}
												?>
											</select>
											<?php 
												}else{
											?>
												<select class="form-control" id="select-1" name="id_categorie_parent">
											
												<option value="0" >aucun</option>
												<?php
												$selected = "";
												foreach($categories as $key=>$categorie)
												{
												?>
												<option value="<?php echo $categorie['id_cat'];?>"><?php echo $categorie['nom_cat_parent'];?></option>
												<?php
												}
												?>
											</select>
											<?php 
												}
											?>
											
										</div>
								   </div>
								   <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Cat&eacute;gorie </label>
										<div class="col-sm-10">
											<?php 
												if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
											?>
												<input type="text" class="form-control" name="nom_cat_parent" value="<?php echo $categories_update[0]['nom_cat_parent'];?>" id="inputEmail3" placeholder="site seraphin">
											<?php
												}else{
											?>
											<input type="text" class="form-control" name="nom_cat_parent" id="inputEmail3" placeholder="site seraphin">
											<?php
											}
											?>
											<input type="hidden" name="section" value="categorie">
											<?php 
											if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
											?>
												<input type="hidden" name="update_on" value="<?php echo $_REQUEST['update'];?>">
												<input type="hidden" name="id_cat_update" value="<?php echo $_REQUEST['id_cat_update'];?>">
											<?php 
											}
											?>
											
										</div>
								   </div>
								  
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
									  <?php 
											if(isset($_REQUEST['update']) && $_REQUEST['update']=='on'){
										?>
								      <button type="submit" name="valide" class="btn btn-primary">Modifier</button>
									  <?php 
											}else{
									  ?>
										<button type="submit" name="valide" class="btn btn-primary">Cr&eacute;er</button>
									  <?php 
											}
									  ?>
								    </div>
								  </div>
								</form>
			  				</div>
			  			</div>
	  				</div>
					
					
		  	</div>
			<div class="row">
			<div class="col-md-12">
			<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">Listes des cat&eacute;gories</div>
				</div>
  				<div class="panel-body">
  					<div class="table-responsive">
  						<table class="table">
			              <thead>
			                <tr>
			                  <th>id</th>
			                  <th>cat&eacute;gories</th>
			                  <th>modifier</th>
							  <th>supprimer</th>
			                </tr>
			              </thead>
			              <tbody>
							<?php
							foreach($categories as $key=>$categorie)
							{
								$sous_categories =	get_sous_categorie_annuaire($categorie['id_cat_fils']);
								$a_sous_cat	=	array();
								$s_sous_cat	=	"";
								foreach($sous_categories as $key2=>$sous_categorie)
								{
									$a_sous_cat[]	=	$sous_categorie['nom_cat_parent'];
								}
								
								$s_sous_cat	=	implode(',',$a_sous_cat);
								
							?>
			                <tr>
			                  <td><?php echo $categorie['id_cat'];?></td>
			                  <td><?php echo $categorie['nom_cat_parent'];?></td>
			                  <td><a href="index.php?section=categorie&update=on&id_cat_update=<?php echo $categorie['id_cat'];?>"><button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button></a></td>
							  <td><a href="index.php?section=categorie&delete=on&id_cat_delete=<?php echo $categorie['id_cat'];?>"><button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></td>
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