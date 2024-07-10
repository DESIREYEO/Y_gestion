<?php
session_start();

// Supprimer les indicateurs de session
unset($_SESSION['admin_logged_in']);
unset($_SESSION['employee_logged_in']);
unset($_SESSION['employee_id']);

// Détruire la session complètement
session_destroy();

// Rediriger vers la page de connexion
header("Location: index.php");
exit();