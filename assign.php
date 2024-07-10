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
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body-1">
                    <h2 class="title">Assigner Projet</h2>
                    <form action="process/assignp.php" method="POST" enctype="multipart/form-data">


                        

                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Employee ID" name="eid" required="required">
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Nom projet" name="pname" required="required">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="date" name="duedate" required="required">
                                   
                                </div>
                            </div>
                            
                        </div>
                        
                        



                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Assigner</button>
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
