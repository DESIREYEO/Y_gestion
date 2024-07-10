<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page de connexion
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Y_GESTION</title>
    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <link href="stylesidebar.css" rel="stylesheet" media="all">
    <link href="assign.css" rel="stylesheet" media="all">
    <link rel="icon" href="assets/Y.png" type="image/png">


</head>

<body>
<?php
	include 'sidebar.php';
	?>
   <div class="content">
	 <!-- Navbar -->
	 <nav>
            
        </nav>

    
     <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Formulaire d'ajout</h2>
                    <form action="process/addempprocess.php" method="POST" enctype="multipart/form-data">


                        

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="Prenom" name="firstName" required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Nom" name="lastName" required="required">
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email" required="required">
                        </div>
                        <p>Date de naissance</p>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="Date de naissance" name="birthday" required="required">
                                   
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">GENRE</option>
                                            <option value="Male">Homme</option>
                                            <option value="Female">Femme</option>
                                            <option value="Other">Autres</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Numéro téléphone" name="contact" required="required" >
                        </div>

                        
                        
                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Addresse" name="address" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Departement" name="dept" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="file" placeholder="file" name="file">
                        </div>

                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Main JS-->
    <script src="js/index.js"></script>

</body>

</html>
<!-- end document-->
