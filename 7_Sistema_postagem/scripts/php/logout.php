<?php

    session_start();

    unset( $_SESSION['user'],  $_SESSION['iduser']);

    header("location: ../../index.php");

?>