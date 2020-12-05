<?php 
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=discussion;charset=utf8', 'root', '');


if (isset($_POST['submit']))
{

	$login = htmlspecialchars($_POST['login']);
	$password = sha1($_POST['password']);
		
	if (!empty($login) AND !empty($password))
	{	
		
		$req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
		$req->execute(array($login, $password));
		$userexist = $req->rowCount();
		if ($userexist == 1) 
		{
			$userinfo = $req->fetch();
			
			$_SESSION['conect'] == true;
			$_SESSION['id'] = $userinfo['id'];

			$_SESSION['login'] = $userinfo['login'];
			$_SESSION['password'] = $userinfo['password'];
			header("location:index.php?id=".$_SESSION['id']);
		}
		
		else
		{
			$erreur="Mauvais identifiants!";
		}
			
	}
	else
	{
		$erreur="tous les champs doivent etre remplis";
	}
	

		
}		

	

?>







<!DOCTYPE html>
<html lang="fr">
	<head>
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta charset="utf-8">
		<meta name="viewport" content="with=device-with , initial-scale=1.0">
		
		<link rel="stylesheet"  href="http://fonts.googleapis.com/css?family=Crete+Round">
		<link rel="stylesheet" href="discussion.css">
		<title>Connexion</title>
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
		
		<div class="form">
			<form  action="" method="POST">
				<h1>Connexion</h1>
				<p>Login</p>
				<i class="fa fa-user"></i>
				<input type="text" name="login" placeholder="login"></input>
				<p>Password</p>
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" name="password" placeholder="mot de passe">
				<br>
				<input type="submit" name="submit" value="Connexion">
			</form>
			<?php 
			if (isset($erreur)) {
				echo "$erreur";
			}
			?>
		</div>	
	</body>
</html>