<?php
session_start();
session_unset();
session_destroy();
header("location:../adminsignup.php?logout=success");
?>