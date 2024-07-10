<?php
require_once('dbh.php');
session_start(); // Démarrer la session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['mailuid'];
    $password = $_POST['pwd'];

    $login_successful = false;

    // Préparer la requête pour alogin
    $stmt = $conn->prepare("SELECT * FROM `alogin` WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Connexion réussie pour l'administrateur
        $_SESSION['admin_logged_in'] = true;
        $login_successful = true;
        header("Location: ../aloginwel.php");
        exit();
    }

    $stmt->close();

    // Préparer la requête pour employee
    $stmt = $conn->prepare("SELECT id FROM `employee` WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $employee = $result->fetch_assoc();
        $empid = $employee['id'];

        // Connexion réussie pour l'employé
        $_SESSION['employee_logged_in'] = true;
        $_SESSION['employee_id'] = $empid;
        $login_successful = true;
        header("Location: ../eloginwel.php?id=$empid");
        exit();
    }

    $stmt->close();

    if (!$login_successful) {
        echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('Invalid Email or Password'); window.location.href='javascript:history.go(-1)'; </SCRIPT>");
    }
}

$conn->close();
?>
