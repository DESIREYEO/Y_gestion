

<?php

session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page de connexion
    header("Location: index.php");
    exit();
}


require_once ('process/dbh.php');

//$sql = "SELECT * from `employee_leave`";
$sql = "Select employee.id, employee.firstName, employee.lastName, employee_leave.start, employee_leave.end, employee_leave.reason, employee_leave.status, employee_leave.token From employee, employee_leave Where employee.id = employee_leave.id order by employee_leave.token";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>Y_GESTION</title>
	<link href="styleview.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="stylesidebar.css">
	<link href="styleview.css" rel="stylesheet">
	<link rel="icon" href="assets/Y.png" type="image/png">

</head>
<body>
	
<!-- Sidebar -->
<div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>Y_</span>GESTION</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="aloginwel.php"><box-icon class="bx" name="user"></box-icon>Acceuil</a></li>
            <li><a href="addemp.php"><box-icon class="bx" name="user-plus"></box-icon>Ajouter employé</a></li>
            <li><a href="viewemp.php"><box-icon class="bx" name="analyse"></box-icon>Voir employé</a></li>
            <li><a href="assign.php"><box-icon class="bx" name="detail"></box-icon>Assigner projets</a></li>
            <li><a href="assignproject.php"><box-icon class="bx" name="check-shield"></box-icon>Status projets</a></li>
            <!-- <li><a href="salaryemp.php"><box-icon class="bx" name="briefcase-alt-2"></box-icon>Table salaire</a></li> -->
            <li><a href="empleave.php"><box-icon class='bx' type='solid' name='dashboard'></box-icon>Conger employé</a></li>
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
	 <!-- Navbar -->
	 <nav>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><box-icon name="search"></box-icon></button>
                </div>
            </form>
           
            
        </nav>
	 
	
<section class="recent-orders">

  <div class="table-container">
	<table>

		<thead>
			<tr>
				<th>Emp. ID</th>
				<th>Token</th>
				<th>Nom</th>
				<th>Date Debut</th>
				<th>Date Fin</th>
				<th>Jours Total</th>
				<th>Raisons</th>
				<th>Status</th>
				<th>Options</th>
			</tr>
        </thead>	

		<tbody>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {

				$date1 = new DateTime($employee['start']);
				$date2 = new DateTime($employee['end']);
				$interval = $date1->diff($date2);
				$interval = $date1->diff($date2);
				//echo "difference " . $interval->days . " days ";

					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['token']."</td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['start']."</td>";
					echo "<td>".$employee['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
					echo "<td><a href=\"approve.php?id=$employee[id]&token=$employee[token]\"  onClick=\"return confirm('Êtes vous sure de vouloir approuver cette demande?')\">Aprouver</a> | <a href=\"cancel.php?id=$employee[id]&token=$employee[token]\" onClick=\"return confirm('Êtes vous sure de vouloir rejeter cette demande?')\">Rejeter</a></td>";

				}


			?>

		</tbody>

	</table>

  </div>
</section>
		
	</div>
    <!-- Main JS-->
    <script src="js/index.js"></script>
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>