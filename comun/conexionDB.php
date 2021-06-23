<?php
    $user="root";
    $passwor="";
    $server="localhost";
    $name="practiques";
    $mysqli = new mysqli("$server", "$user", "$passwor", "$name");
    if ($mysqli->connect_errno) {
        echo ("Connect failed: " . $mysqli->connect_error);
        exit();
    }
