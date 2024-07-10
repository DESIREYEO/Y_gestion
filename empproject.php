

<?php 

session_start();

if (!isset($_SESSION['employee_logged_in']) || $_SESSION['employee_logged_in'] !== true) {
    header("Location: index.php");
    exit();
}
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	require_once ('process/dbh.php');
	$sql = "SELECT * FROM `project` where eid = '$id'";
	$result = mysqli_query($conn, $sql);

	// Récupérer la recherche de l'utilisateur
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Requête SQL pour récupérer les projets correspondant à la recherche
$sql = "SELECT * FROM `project` WHERE `pname` LIKE ? ORDER BY `subdate` DESC";

$stmt = $conn->prepare($sql);
$search_term = "%$search%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();
	
?>



<html>
<head>
	<title>Y_GESTION</title>
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
		 <!-- Navbar -->
		 <nav>
            
            <form method="GET">
                <div class="form-input">
                    <input type="search" name="search" value="<?php echo $search; ?>" placeholder="Rechercher...">
                    <button class="search-btn" type="submit"><box-icon name="search"></box-icon></button>
                </div>
            </form>
        </nav>
	
	
<section class="recent-orders">
  <div class="table-container">
      <table>
         <thead>
			<tr>

				<th align = "center">Nom projet</th>
				<th align = "center">Due Date</th>
				<th align = "center">Sub Date</th>
				<th align = "center">Status</th>
				<th align = "center">Option</th>
			</tr>
		 </thead>
         <tbody>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {

					echo "<tr>";
					echo "<td>".$employee['pname']."</td>";
					echo "<td>".$employee['duedate']."</td>";
					echo "<td>".$employee['subdate']."</td>";
					echo "<td>".$employee['status']."</td>";
					

					 echo "<td><a href=\"psubmit.php?pid=$employee[pid]&id=$employee[eid]\">Submit</a>";

				}


			?>

        </tbody>
     </table>
  </div>
  </section>
</div>

<script src="js/index.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>