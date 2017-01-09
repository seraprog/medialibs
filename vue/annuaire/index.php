<?php
ini_set("display_errors",0);error_reporting(0);
include_once('modele/connexion_sql.php');

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('controleur/annuaire/index.php');
}

?>
<!DOCTYPE html>
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
					<form method="GET" action="index.php?section=recherche">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
					  </form>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
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
		  <div class="col-md-3">
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
		  <div class="col-md-9">
			<?php
			foreach($fiches as $key=>$fiche)
			{
				if($key!=0) $key = $key+1;
				
			?>
			<?php
				if(isset($fiches[$key+1]['nom_site']) && $fiches[$key+1]['nom_site']!=""){
					$col_md = "col-md-6";
				}else{
					$col_md = "col-md-12";
				}
				?>
		  	<div class="row">
		  		<div class="<?php echo $col_md;?>">
		  			<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title"><?php echo $fiches[$key]['nom_site'];?></div>
							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<p><img style="margin:0px 15px 15px 0px;" src="<?php echo $fiches[$key]['url_image'].$fiches[$key]['name_image'];?>" width="120" />
										
										<ul class="list-group">
											<li class="list-group-item">Url : <?php echo $fiches[$key]['url_site'];?></li>
											<li class="list-group-item">Type du site : <?php echo $fiches[$key]['id_cat_parent'];?></li>
											<li class="list-group-item">Date de cr&eacute;ation  : <?php echo $fiches[$key]['date'];?></li>
										</ul>
								</div>
								<div class="col-md-6">
									<?php echo $fiches[$key]['description'];?>
								</div>
							</div>
		  				</div>
		  			</div>
		  		</div>
				<?php
				if(isset($fiches[$key+1]['nom_site']) && $fiches[$key+1]['nom_site']!=""){
				?>
				<div class="col-md-6">
		  			<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title"><?php echo $fiches[$key+1]['nom_site'];?></div>
							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<p><img style="margin:0px 15px 15px 0px;" src="<?php echo $fiches[$key]['url_image'].$fiches[$key]['name_image'];?>" width="120" />
										
										<ul class="list-group">
											<li class="list-group-item">Url : <?php echo $fiches[$key+1]['url_site'];?></li>
											<li class="list-group-item">Type du site : <?php echo $fiches[$key+1]['id_cat_parent'];?></li>
											<li class="list-group-item">Date de cr&eacute;ation  : <?php echo $fiches[$key+1]['date'];?></li>
										</ul>
								</div>
								<div class="col-md-6">
									<?php echo $fiches[$key+1]['description'];?>
								</div>
							</div>
		  				</div>
		  			</div>
		  		</div>
				<?php
				}
				?>
		  	</div>
			<?php
				}
			?>
			<div class="row">
			<div class="col-md-12 medialibs-index-position">
				<nav aria-label="Page navigation example">
					  <ul class="pagination">
						<li class="page-item"><a class="page-link" href="#">Previous</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
					  </ul>
					</nav>
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