<?php 
session_start();

if (!isset($_SESSION['employee_logged_in']) || $_SESSION['employee_logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

// Récupérer l'ID de l'employé depuis la session
$empid = $_SESSION['employee_id'];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
require_once ('process/dbh.php');

// Vérifier si l'ID est valide avant d'exécuter la requête
if ($id > 0) {
    $sql1 = "SELECT * FROM `employee` WHERE id = '$id'";
    $result1 = mysqli_query($conn, $sql1);

    // Vérifier que la requête a retourné des résultats
    if ($result1 && mysqli_num_rows($result1) > 0) {
        $employeen = mysqli_fetch_array($result1);
        $empName = $employeen['firstName'];
    } else {
        $empName = '';
    }
} else {
    $empName = '';
}

// Requêtes SQL
$sql = "SELECT id, firstName, lastName, points FROM employee, rank WHERE rank.eid = employee.id ORDER BY rank.points DESC";
$sql1 = "SELECT pname, duedate FROM project WHERE eid = $id AND status = 'Due'";
$sql2 = "SELECT * FROM employee, employee_leave WHERE employee.id = $id AND employee_leave.id = $id ORDER BY employee_leave.token";
$sql3 = "SELECT * FROM salary WHERE id = $id";

// Exécution des requêtes
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
?>

<!DOCTYPE html>
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
            <li class="active"><a href="eloginwel.php?id=<?php echo $id ?>"><box-icon class="bx" name="user"></box-icon>Acceuil</a></li>
            <li><a href="empproject.php?id=<?php echo $id ?>"><box-icon class="bx" name="detail"></box-icon>Mes projets</a></li>
            <li><a href="applyleave.php?id=<?php echo $id ?>"><box-icon class='bx' type='solid' name='dashboard'></box-icon>Demande congé</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="logout.php" class="logout">
                <box-icon class="bx" name="log-out-circle" color='var(--danger)'></box-icon>
                Déconnexion
                </a>
            </li>
        </ul>
    </div> 
    <!-- End of Sidebar -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <form>
                <div class="form-input">
                    <input type="search" name="search" placeholder="Rechercher...">
                    <button class="search-btn" type="submit"><box-icon name="search"></box-icon></button>
                </div>
            </form>
        </nav>
        <div>
            <!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

            <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Classement des employés</h2>
            <section class="recent-orders">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr bgcolor="#000">
                                <th align="center">Seq.</th>
                                <th align="center">Emp. ID</th>
                                <th align="center">Nom</th>
                                <th align="center">Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $seq = 1;
                            while ($employee = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$seq."</td>";
                                echo "<td>".$employee['id']."</td>";
                                echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
                                echo "<td>".$employee['points']."</td>";
                                $seq++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Projets</h2>
            <section class="recent-orders">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th align="center">Nom Projet</th>
                                <th align="center">Date D'assignation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($employee1 = mysqli_fetch_assoc($result1)) {
                                echo "<tr>";
                                echo "<td>".$employee1['pname']."</td>";
                                echo "<td>".$employee1['duedate']."</td>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Statut congés</h2>
            <section class="recent-orders">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th align="center">Date Debut</th>
                                <th align="center">Date Fin</th>
                                <th align="center">Jour Total</th>
                                <th align="center">Raison</th>
                                <th align="center">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($employee = mysqli_fetch_assoc($result2)) {
                                $date1 = new DateTime($employee['start']);
                                $date2 = new DateTime($employee['end']);
                                $interval = $date1->diff($date2);

                                echo "<tr>";
                                echo "<td>".$employee['start']."</td>";
                                echo "<td>".$employee['end']."</td>";
                                echo "<td>".$interval->days."</td>";
                                echo "<td>".$employee['reason']."</td>";
                                echo "<td>".$employee['status']."</td>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <script src="js/index.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
