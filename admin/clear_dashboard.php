<?php
session_start();

/* set flag clear */
$_SESSION['clear_dashboard'] = true;

header("Location: dashboard.php");
exit();
