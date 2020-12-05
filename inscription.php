<?php 

$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', '');	

if (isset($_POST['forminscription'])) 
{
	if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['password1'])) 
	{
		$login = htmlspecialchars($_POST['login']);
		$password = sha1($_POST['password']);
		$password1 = sha1($_POST['password1']);

		
		$loginlenght = strlen($login);
		if ($loginlenght <= 255) 
		{
				if ($password == $password1) 
				{
					$insertnbr = $bdd->prepare("INSERT INTO utilisateurs (login, password) VALUES (?,?)");
					$insertnbr->execute(array($login, $password));
					$erreur = "votre compte a bien été crée!";
					header('location:connexion.php');
				}
				else
				{
					$erreur = "les mots de passes ne correspondents pas !";
				}	
		}
		else
		{
			$erreur = "Votre login depasse 255 caractéres!";
		}	
	}
	else
	{
		$erreur = "tous les champs doivents etre remplis!";
	}	




}
?>




<!DOCTYPE html>
<html>
	<head>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta charset="utf-8">
		<meta name="viewport" content="with=device-with , initial-scale=1.0">
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" type="text/css" href="discussion.css">
		<title>Inscription</title>
	</head>
	<body class="debut1">
		<nav>

			<label>Discussion</label>
			<ul>
				<li><a  class="active"href="connexion.php"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="inscription.php"><i class="fa fa-commenting-o"></i>s'incrire</a></li>
				<li><a href="connexion.php"><i class="fa fa-user"></i>Connexion</a></li>
			</ul>

		</nav>
		<section>
			
		</section>	
		<div class="inscription">
			<form action="" method="POST">
				<h1>Inscription</h1>
				<p>login:</p>
				
				<i class="fa fa-user" aria-hidden="true"></i><input type="text" name="login" placeholder="login">
				<p>password:</p>
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" name="password" placeholder="password">
				<p>Confirmer mot de passe:</p>
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" name="password1" placeholder="confirm password">
				<br>
				<input type="submit" name="forminscription" value="Valider" class="envoie" >
			</form>
		</div>
		<?php 
			if (isset($erreur)) {
				echo "$erreur";
			}
		?>

	</body>
</html>