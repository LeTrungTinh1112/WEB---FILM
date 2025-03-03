<?php
    session_start();
    $response = array();

    if(isset($_SESSION['TenDN'])) {
        $response['loggedIn'] = true;
        $response['username'] = $_SESSION['TenDN'];
    } else {
        $response['loggedIn'] = false;
    }

    echo json_encode($response);
?>