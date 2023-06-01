<?php
  
//db config
$servername="localhost";
$username="root";
$password="";
$dbname="h20_helper";
/*if (file_exists('conx.php')) 
{
	require 'conx.php';
}
else {
	echo "File not found";
	die();
}*/
  //connexion
 $lien=mysqli_connect($servername,$username,$password,$dbname);

  //verifier la connexion 
  if(!mysqli_connect_error())
  {
    echo"La connexion a echoue ! <br>" ;
  }



  //connexion a un compte existant

if (isset($_POST['check'])) //verifier que les checkbox sont bien check
 {  
  $choix = $_POST['check']; //user ou fournisseur ?

  //utilisateur
 if ($choix == 'utilisateur') {

	$email_u=$_POST['email_u'];
	$password_u = $_POST['password_u'];
	$sql = "SELECT * FROM utilisateur WHERE email_u = '$email_u'";
	$result = $lien->query($sql);

	if ($result->num_rows > 0) {
		// L'e-mail existe déjà, verifie si email et mdp compatible
		$query = "SELECT * FROM utilisateur WHERE email_u='$email_u' AND mot_passe_u='$password_u'";
	    $resultat = mysqli_query($lien, $query);
		//true
		   if (mysqli_num_rows($resultat) >0) {
			    // redirection  
				session_start(); 
                $sessionid = session_id();
			    header('Location: +compte.html');
			    exit;}
		//false
		   else {
			     echo "<p > email ou mot de passe invalide.</p>";
				 header('Location: index.html');
		    }
			//mysqli_close($lien); //ferme le flux de connexion
	    }
	 else {
		// L'e-mail n'existe pas
		header('Location: user.html');
	     }
	
} //fournisseur
else if ($choix == 'fournisseur') {

	$email_f=$_POST['email_f'];
	$password_f = $_POST['password_f'];
	$sql = "SELECT * FROM fournisseur WHERE email_f = '$email_f'";
	$result = $lien->query($sql);
	print_r($result);

	if ($result->num_rows > 0) {
		// L'e-mail existe déjà, verifie si email et mdp compatible
		$query = "SELECT * FROM fournisseur WHERE email_f='$email_f' AND mot_passe_f='$password_f'";
	    $resultat = mysqli_query($lien, $query);
		//true
		   if (mysqli_num_rows($resultat) >0) {
			    // redirection  
				session_start(); 
                $sessionid = session_id();
			    header('Location: fourn2.html');
			    exit;}
		//false
		   else {
			     echo "<p > email ou mot de passe invalide.</p>";
				 header('Location: index.html');
		    }
			//mysqli_close($lien); //ferme le flux de connexion
	    }
	 else {
		// L'e-mail n'existe pas
		header('Location: fournisseur.html');
	     }
}

}
else{
	 header('Location: index.html');
}




//partie creation de compte

//user
if (isset($_POST['user'])) {
	// recuperer les donnees
	$nom_u=$_POST["nom_u"];
	$prenom_u=$_POST["prenom_u"];
	$mail_u=$_POST["email_u"];
	$mdp_u=$_POST["password_u"];
	$dn_u=$_POST["date_naissance_u"];
	$poids_u=$_POST["poids_u"];
	$taille_u=$_POST["taille_u"];
	$imc_u=(($poids_u -20)*15+1500)/1000;
	

	// insert into BDD
	$sql = "INSERT INTO utilisateur (nom_u, prenom_u, email_u, mot_passe_u, poids_u, taille_u) VALUES ('$nom_u', '$prenom_u', '$mail_u', '$mdp_u', '$poids_u', '$taille_u')";
	if (mysqli_query($lien, $sql)) {
		// redirection
		session_start(); 
		$sessionid = session_id();
		header('Location: +compte.html');
		exit();
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
		
	}
	mysqli_close($lien); //fermer le flux de connexion
}
else{
	header('Location: user.html');
}

//fournisseur
if (isset($_POST['fournisseur'])) {
	// recuperer les donnees
	$nom_f=$_POST["nom_f"];
	$prenom_f=$_POST["prenom_f"];
	$mail_f=$_POST["email_f"];
	$mdp_f=$_POST["password_f"];
	$dn_f=$_POST["date_naissance_f"];
	$wilaya_f=$_POST["wilaya_f"];
    
	// insert into BDD
	$sql = "INSERT INTO fournisseur (nom_f, prenom_f, email_f, mot_passe_f, wilaya_f) VALUES ('$nom_f', '$prenom_f', '$mail_f', '$mdp_f', '$wilaya_f')";
	if (mysqli_query($lien, $sql)) {
		// redirection
		session_start(); 
        $sessionid = session_id();
		header('Location: fourn2.php');
		exit();
	} else {
		echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
		
	}
	//mysqli_close($lien); //fermer le flux de connexion
}
else{
	header('Location: fournisseur.html');
}





//logout
if (isset($_POST['logout_u'])) {
	session_destroy();
	header('Location: index.html');
	exit();

}

if (isset($_POST['logout_f'])) {
	session_destroy();
	header('Location: index.html');
	exit();
}


//bouton ajouter
if(isset($_POST['ajt_marques_f']))
{
 
  header('Location: ajteau.html');
  exit;
}


//ajouter une eau pour un fournisseur
if (isset($_POST['ajouteau'])) {
	
	session_start(); 
	$sessionid = session_id();

$nom_e=$_POST['nom_e'];
$logo=$_POST['logo'];
$disponibilite=$_POST['litre'];
$potassium=$_POST['potassium'];
$calcium=$_POST['calcium'];
$magnesium=$_POST['magnesium='];
$sodium=$_POST['sodium'];
$bicarbonate=$_POST['bicarbonate'];
$sulfates=$_POST['sulfates'];
$chlrorure=$_POST['chlrorure'];
$nitrate=$_POST['nitrate'];
$nitrite=$_POST['nitrite'];
$ph=$_POST['ph'];

		// insert into BDD
		$sql = "INSERT INTO eau (IDF,Nom,Logo, Disponibilite, Potassium, Calicium,Magnesium,Sodium,Bicarbonate,Sulfates,Nitrate,Nitrite,PH, Wilaya) VALUES ('$sessionid', '$nom_f', '$logo', '$disponibilite', '$potassium', '$calcium', '$magnesium', '$sodium', '$bicarbonate', '$sulfates', '$chlorure', '$nitrate', '$nitrite', '$ph')";
		if (mysqli_query($lien, $sql)) {
			// redirection
			header('Location: fourn2.php');
			exit();}
		 else {
			echo "Erreur: " . $sql . "<br>" . mysqli_error($lien);
		}
}


?>
