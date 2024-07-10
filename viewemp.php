
<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // L'utilisateur n'est pas connecté en tant qu'administrateur, rediriger vers la page de connexion
    header("Location: index.php");
    exit();
}

require_once('process/dbh.php');


// Récupérer la recherche de l'utilisateur
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Requête SQL pour récupérer les employés correspondant à la recherche
$sql = "SELECT employee.*, rank.*
        FROM employee
        INNER JOIN rank ON employee.id = rank.eid
        WHERE employee.firstName LIKE ? OR employee.lastName LIKE ?";

$stmt = $conn->prepare($sql);
$search_term = "%$search%";
$stmt->bind_param("ss", $search_term, $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<html>
<head>
    <title>Y_GESTION</title>
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
                        <th align="center">Emp. ID</th>
                        <th align="center">Image</th>
                        <th align="center">Nom</th>
                        <th align="center">Email</th>
                        <th align="center">Date de naissance</th>
                        <th align="center">Genre</th>
                        <th align="center">Contact</th>
                        <th align="center">Addresse</th>
                        <th align="center">Departement</th>
                        <th align="center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($employee = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $employee['id']; ?></td>
                            <td><img src='process/<?php echo $employee['pic']; ?>' height=60px width=60px></td>
                            <td><?php echo $employee['firstName'] . " " . $employee['lastName']; ?></td>
                            <td><?php echo $employee['email']; ?></td>
                            <td><?php echo $employee['birthday']; ?></td>
                            <td><?php echo $employee['gender']; ?></td>
                            <td><?php echo $employee['contact']; ?></td>
                            <td><?php echo $employee['address']; ?></td>
                            <td><?php echo $employee['dept']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $employee['id']; ?>">Edit</a> |
                                <a href="delete.php?id=<?php echo $employee['id']; ?>" onClick="return confirm('Êtes-vous sure de vouloir supprimer?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
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

<?php
// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>