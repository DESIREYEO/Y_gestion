<?php

require_once ('process/dbh.php');
$id = (isset($_GET['id']) ? $_GET['id'] : '');
$pid = (isset($_GET['pid']) ? $_GET['pid'] : '');

$sql = "SELECT project.pid, project.eid, project.pname, project.duedate, project.subdate, project.mark, rank.points, employee.firstName, employee.lastName, salary.base, salary.bonus, salary.total 
        FROM project 
        INNER JOIN rank ON project.eid = rank.eid 
        INNER JOIN employee ON project.eid = employee.id 
        INNER JOIN salary ON salary.id = employee.id 
        WHERE project.eid = $id AND project.pid = $pid";


if(isset($_POST['update'])) {
  $eid = mysqli_real_escape_string($conn, $_POST['eid']);
  $pid = mysqli_real_escape_string($conn, $_POST['pid']);
  $mark = mysqli_real_escape_string($conn, $_POST['mark']);
  $points = mysqli_real_escape_string($conn, $_POST['points']);
  $base = mysqli_real_escape_string($conn, $_POST['base']);
  $bonus = mysqli_real_escape_string($conn, $_POST['bonus']);
  $total = mysqli_real_escape_string($conn, $_POST['total']);

  $upPoint = $points + $mark;
  $upBonus = $bonus + $mark;
  $upSalary = $base + ($upBonus * $base) / 100;

  $result = mysqli_query($conn, "UPDATE project SET mark='$mark' WHERE eid=$eid AND pid = $pid");
  $result = mysqli_query($conn, "UPDATE rank SET points='$upPoint' WHERE eid=$eid");
  $result = mysqli_query($conn, "UPDATE salary SET bonus='$upBonus', total='$upSalary' WHERE id=$eid");

  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='assignproject.php';
    </SCRIPT>");
}

?>

<?php
$id = (isset($_GET['id']) ? $_GET['id'] : '');
$pid = (isset($_GET['pid']) ? $_GET['pid'] : '');
$sql1 = "SELECT project.pid, project.eid, project.pname, project.duedate, project.subdate, project.mark, rank.points, employee.firstName, employee.lastName, salary.base, salary.bonus, salary.total 
        FROM project 
        INNER JOIN rank ON project.eid = rank.eid 
        INNER JOIN employee ON project.eid = employee.id 
        INNER JOIN salary ON salary.id = employee.id 
        WHERE project.eid = $id AND project.pid = $pid";
$result1 = mysqli_query($conn, $sql1);

if($result1) {
  while($res = mysqli_fetch_assoc($result1)) {
    $pname = $res['pname'];
    $duedate = $res['duedate'];
    $subdate = $res['subdate'];
    $firstName = $res['firstName'];
    $lastName = $res['lastName'];
    $mark = $res['mark'];
    $points = $res['points'];
    $base = $res['base'];
    $bonus = $res['bonus'];
    $total = $res['total'];
  }
}
?>

<html>
<head>
  <title>Y_GESTION</title>
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

  
  <div class="divider"></div>
  

    <!-- <form id = "registration" action="edit.php" method="POST"> -->
  <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Noter Projet</h2>
                    <form id = "registration" action="mark.php" method="POST">



                        <div class="input-group">
                          <p>Nom Projet</p>
                            <input class="input--style-1" type="text"  name="pname" value="<?php echo $pname;?>" readonly>
                        </div>
                       
                        
                        <div class="input-group">
                          <p>Nom Employé</p>
                            <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstName;?> <?php echo $lastName;?>" readonly>
                        </div>

                       


                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                  <p>Date Début</p>
                                     <input class="input--style-1" type="text" name="duedate" value="<?php echo $duedate;?>" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                  <p>Date Soumission</p>
                                    <input class="input--style-1" type="text"  name="subdate" value="<?php echo $subdate;?>" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="input-group">
                          <p>Note du projet</p>
                            <input class="input--style-1" type="text"  name="mark" value="<?php echo $mark;?>">
                        </div>

                       
                        <input type="hidden" name="eid" id="textField" value="<?php echo $id;?>" required="required">
                        <input type="hidden" name="pid" id="textField" value="<?php echo $pid;?>" required="required">
                         <input type="hidden" name="points" id="textField" value="<?php echo $points;?>" required="required">
                        <input type="hidden" name="base" id="textField" value="<?php echo $base;?>" required="required">
                        <input type="hidden" name="bonus" id="textField" value="<?php echo $bonus;?>" required="required">
                        <input type="hidden" name="total" id="textField" value="<?php echo $total;?>" required="required">
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Noter Projet</button>
                        </div>
                        
                    </form>
                    <br>
                    
                </div>
            </div>
        </div>
    </div>


</body>
</html>
