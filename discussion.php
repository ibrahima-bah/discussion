<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', 'root');

if (!$_SESSION['conect']) 
{
	//header('location:index.php');
}

if (isset($_POST['forminscription'])) 
{
	if (!empty($_POST['text'])) 
	{
		$id_utilisateur = $_SESSION['id'];
		$text = htmlspecialchars($_POST['text']);
		//var_dump($_SESSION);
		//var_dump($_POST['text']);
		// User connecté en insertion dans la base de données du message!
		if ($text <= 1000) 
		{
			
			$in = date("Y-m-d");
			
			$insertnbr = $bdd->prepare("INSERT INTO messages (message, id_utilisateur, date) VALUES (?,?,?)");
			$insertnbr->execute(array($text, $id_utilisateur, $in));
			
			$erreur = "votre message a bien été posté!";
					
					
		}
		else
		{
			$erreur = "Votre message depasse 1000 caractéres!";
		}	
	}
	else
	{
		$erreur = "tous les champs doivents etre remplis!";
	}	
}

?>





<?php 

// affichage des messages

//$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', 'root');

//$messages1 = $bdd->query("SELECT * FROM utilisateurs INNER JOIN messages ON utilisateurs.id = messages.id_utilisateur ");

//while ($c = $messages1->fetch()) 
//{
	//echo '<p><strong>' . htmlspecialchars($c['login']) . '</strong> : ' . htmlspecialchars($c['message']) . '</p>';
//}	

?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" type="text/css" href="discussion.css">
		<title>discussion</title>
	</head>

	<body class="debut1">
		<nav>

			<label>Discussion</label>
			<ul>
				<li><a  class="active"href="index.php"><i class="fa fa-home"></i>Home</a></li>
				
				<li><a href="profil.php"><i class="fa fa-user"></i>Modifier Mon profil</a></li>
				<li><a href="connexion.php"><i class="fa fa-sign-out"></i>Deconnexion</a></li>
			</ul>
		</nav>
		<br><br><br><br>
<?php 



// affichage des messages

$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', 'root');

$messages1 = $bdd->query("SELECT * FROM utilisateurs INNER JOIN messages ON utilisateurs.id = messages.id_utilisateur ");

while ($c = $messages1->fetch()) 
{
	echo '<p><center><strong>' . htmlspecialchars($c['login']) . '</strong> : ' . htmlspecialchars($c['message']) . '</center></p>';
}	






 ?>		
 		<br><br><br><br><br><br><br><br>
		<div class="message">
			<form action="discussion.php" method="POST">
				
				
				<textarea name="text" placeholder="votre message!" cols="45" rows="3"></textarea>
				<br><br>
				<input type="submit" name="forminscription" value="Valider" class="envoie">
			</form>
		</div>
		<?php if (isset($erreur)) { echo $erreur;}?>
	</body>
</html>





