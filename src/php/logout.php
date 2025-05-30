<?php
session_start();
session_unset();
session_destroy();
header("Location: /WebDa/CLINIC-SYSTEM-3/index.php");
exit();
?>