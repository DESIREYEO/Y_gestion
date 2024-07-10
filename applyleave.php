
<?php 

session_start();

if (!isset($_SESSION['employee_logged_in']) || $_SESSION['employee_logged_in'] !== true) {
    header("Location: index.php");
    exit();
}
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	require_once ('process/dbh.php');
	$sql = "SELECT * FROM `employee` where id = '$id'";
	$result = mysqli_query($conn, $sql);
	$employee = mysqli_fetch_array($result);
	$empName = ($employee['firstName']);
	//echo "$id";
?>

<html>
<head>
	<title>Y_GESTION</title>
    <link href="stylesidebar.css" rel="stylesheet" media="all">
	<link href="css/main.css" rel="stylesheet" media="all">
    <link href="assign.css" rel="stylesheet" media="all">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" href="assets/Y.png" type="image/png">
</head>
<body bgcolor="#F0FFFF">
<!-- Sidebar -->
<div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Y_</span>GESTION</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="eloginwel.php?id=<?php echo $id?>""><box-icon class="bx" name="user"></box-icon>Acceuil</a></li>
            <li><a href="empproject.php?id=<?php echo $id?>""><box-icon class="bx" name="detail"></box-icon>Mes projets</a></li>
            <li><a href="applyleave.php?id=<?php echo $id?>""><box-icon class='bx' type='solid' name='dashboard'></box-icon>Demande congé</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="logout.php" class="logout">
                <box-icon class="bx" name="log-out-circle" color= 'var(--danger)'></box-icon>
                    Déconnexion
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->
	 
<div class="content">
	<nav>
            
        </nav>
	 

	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Formulaire Demande Congé</h2>
                    <form action="process/applyleaveprocess.php?id=<?php echo $id?>" method="POST">


                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Raison" name="reason">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                            	<p>Date Début</p>
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="start" name="start">
                                   
                                </div>
                            </div>
                            <div class="col-2">
                            	<p>Date Fin</p>
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="end" name="end">
                                   
                                </div>
                            </div>
                        </div>
                        



                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		

















</div>





<script src="js/index.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>
</html>