<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log In | Y_GESTION</title>
	<link rel="stylesheet" type="text/css" href="stylelogin.css">
    <link rel="icon" href="assets/Y.png" type="image/png">
</head>
<body>
	
	<div class="loginbox">
        <h1>CONNEXION</h1>
        <form action="process/aprocess.php" method="POST">
            <p>Email</p>
            <input type="email" name="mailuid" placeholder="Entrer votre adresse mail" required="required">
            <p>Password</p>
            <input type="password" name="pwd" placeholder="Entrer votre mot de passe" required="required">
            <input type="submit" name="login-submit" value="Connexion">
           
        </form>

    </div>
</body>
</html>