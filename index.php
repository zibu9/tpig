<?php
		try 
		{
		    $sql = new PDO ('mysql:host=localhost;dbname=tpig;charset=utf8','root','') ;
		    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} 
		catch (Exception $e) 
		{
	   			die('Erreur : '. $e->getMessage());
	 	}

	 	if ((isset($_POST['couleur']) && isset($_POST['type']) && isset($_POST['origine'] )|| isset($_POST['achete']))) {

	 		$couleur = $_POST['couleur'];
	 		$type = $_POST['type'];
	 		$origine = $_POST['origine'];
	 			if (!(empty($_POST['couleur']) && !empty($_POST['type']) && !empty($_POST['origine']))) {
			 		$req = $sql->prepare( "SELECT * FROM `TP` WHERE (couleur = ? AND type = ? AND origine = ?)");
			 		$req->execute([$couleur,$type,$origine]);
			 		$nbr = $req->rowcount();
			 		$result = $req->fetch();	 				
	 			}

	 	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>TP|INFORMATIQUE DE GESTION</title>
 	 <link rel="stylesheet" href="bootstraps.css">
 	<meta charset="UTF-8">
 </head>
 <body>	 		
		 <form action="" method="POST">

		 	<div class="container-fluid row">
		 					<div class="col-lg-12"><h3 class="text-center">TRAVAIL PRATIQUE D'INFORMATIQUE DE GESTION</h3></div>
						 	<div class="col-lg-4 col-md-4 col-sm-12">
									<fieldset>
										<legend class="text-dark font-weight-bold">Couleurs</legend>
											
											  <div class="container">
												 <div class="row">
													    <div class="form-label-group col-lg-12">
													    	<label class="text-danger"><input type="radio" name="couleur" value="Rouge">&nbsp; Rouge</label>&nbsp;
													    	<label class="text-warning"><input type="radio" name="couleur" value="Jaune">&nbsp; Jaune</label>
						                                  </div>
													</div> 
												</div> 
												<br><br>
											
									</fieldset>
							 </div>
							 	<div class="col-lg-4 col-md-4 col-sm-12">
									<fieldset>
										<legend class="text-dark font-weight-bold">Type</legend>
											
											  <div class="container">
												 <div class="row">
													    <div class="form-label-group col-lg-12">
													    	<label><input type="radio" name="type" value="Sports">&nbsp; Sports</label>&nbsp;
													    	<label><input type="radio" name="type" value="Staff">&nbsp; Staff</label>
						                                  </div>
													</div> 
												</div> 
												<br><br>
											
									</fieldset>
								</div>
							 	<div class="col-lg-4 col-md-4 col-sm-12">
									<fieldset>
										<legend class="text-dark font-weight-bold">Origine</legend>
											
											  <div class="container">
												 <div class="row">
													    <div class="form-label-group col-lg-12">
													    	<label><input type="radio" name="origine" value="Domestique">&nbsp; Domestique</label>&nbsp;
													    	<label><input type="radio" name="origine" value="Importer">&nbsp; Importer</label>
						                                  </div>
													</div> 
												</div> 
												<br><br>
											
									</fieldset>
								</div>
								<div class="col-lg-12"><br></div>
								<div class="col-lg-12 text-center"><input type="submit" value="Soumettre"></div>
								<div class="col-lg-12"><br></div>


			</div>
		</form>
		<div class="container-fluid row">
				<div class="col-lg-4 col-md-4">
					<table class="table table-dark">
							<thead>
								<tr>
									<th scope="col">Voiture</th>												
									<th scope="col">Couleurs</th>
									<th scope="col">Type</th>
									<th scope="col">Origine</th>
									<th scope="col">Acheté</th>
								</tr>
							</thead>
							<tbody>
								<?php $tab = $sql->query( "SELECT * FROM `TP`");
							  		while ( $donnees =$tab->fetch())
							  		 {?>
								 <tr>
									<th scope="row"><?= $donnees->voiture;?></th>
									<td> <?= $donnees->couleur;?></td>
									<td> <?= $donnees->type; ?></td>
									<td> <?= $donnees->origine; ?></td>
									<td> <?= $donnees->achete; ?></td>
							    </tr>
							<?php }$tab->closeCursor();?>	
							</tbody>
					</table>
				</div>
				<div class="col-lg-1 col-md-1"></div>
				<div class="col-lg-7 col-md-12">
					<div class="container row">
						<h2 class="col-lg-12 text-center"> Résultats</h2>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<fieldset>
									<legend class="text-dark font-weight-bold">Couleurs & Acheté</legend>
										
										  <div class="container">
											 <div class="row">
												   <?php $r = $sql->query( "SELECT * FROM `TP` WHERE (couleur = 'rouge')");
												   		 $r1 = $sql->query( "SELECT * FROM `TP` WHERE (couleur = 'jaune')");
												   		$r2 = $sql->query( "SELECT * FROM `TP` WHERE (couleur = 'rouge' AND achete = 'oui')");
												   		$r3 = $sql->query( "SELECT * FROM `TP` WHERE (couleur = 'rouge' AND achete = 'non')");
												   		$o = $r2->rowcount();
												   		$qr = $r->rowcount();
												   		$qj = $r->rowcount();
												   		$n = $r3->rowcount();
												     ?>
												    <h6>P(rouge/oui) = <?php echo $o."/".$qr; ?> </h6>
												    <h6>P(rouge/non) = <?php echo $n."/".$qj; ?> </h6>
													   <?php
													   		$r2 = $sql->query( "SELECT * FROM `TP` WHERE (couleur = 'jaune' AND achete = 'oui')");
													   		$r3 = $sql->query( "SELECT * FROM `TP` WHERE (couleur = 'jaune' AND achete = 'non')");
													   		$o = $r2->rowcount();
													   		$n = $r3->rowcount();
													     ?>
													<h6>P(jaune/oui) = <?php echo $o."/".$qr; ?> </h6>
												    <h6>P(jaune/non) = <?php echo $n."/".$qj; ?> </h6>
												</div> 
											</div> 
											<br><br>
										
								</fieldset>

						 </div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<fieldset>
									<legend class="text-dark font-weight-bold">Origine & Acheté</legend>
										
										  <div class="container">
											 <div class="row">
												   <?php $r = $sql->query( "SELECT * FROM `TP` WHERE (origine = 'domestique')");
												   		 $r1 = $sql->query( "SELECT * FROM `TP` WHERE (origine = 'importer')");
												   		$r2 = $sql->query( "SELECT * FROM `TP` WHERE (origine = 'domestique' AND achete = 'oui')");
												   		$r3 = $sql->query( "SELECT * FROM `TP` WHERE (origine = 'domestique' AND achete = 'non')");
												   		$o = $r2->rowcount();
												   		$qr = $r->rowcount();
												   		$qj = $r->rowcount();
												   		$n = $r3->rowcount();
												     ?>
												    <h6>P(Domest/oui) = <?php echo $o."/".$qr; ?> </h6>
												    <h6>P(Domest/non) = <?php echo $n."/".$qj; ?> </h6>
													   <?php
													   		$r2 = $sql->query( "SELECT * FROM `TP` WHERE (origine = 'importer' AND achete = 'oui')");
													   		$r3 = $sql->query( "SELECT * FROM `TP` WHERE (origine = 'importer' AND achete = 'non')");
													   		$o = $r2->rowcount();
													   		$n = $r3->rowcount();
													     ?>
													<h6>P(Import/oui) = <?php echo $o."/".$qr; ?> </h6>
												    <h6>P(Import/non) = <?php echo $n."/".$qj; ?> </h6>
												</div> 
											</div> 
											<br><br>
										
								</fieldset>
						 </div>
						 <div class="col-lg-4 col-md-4 col-sm-12">
								<fieldset>
									<legend class="font-weight-bold text-success">Question</legend>
										
										  <div class="container">
											 <div class="row">
											 <?php if ((!empty($couleur) && !empty($type) && !empty($origine))AND isset($_POST)): ?>
													<h6 class=" text-success">P(<?=$couleur;?>/<?=$type;?>/<?=$origine;?>) = <?php echo $nbr."/".$nbr; ?> </h6>
												</div> 
											</div>
											<?php  endif;?>

											<br><br>
										
								</fieldset>
						 </div>
					</div>				
				</div>


		</div>
 </body>
 </html>