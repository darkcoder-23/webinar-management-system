<?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "webinar_project";
    $conn = mysqli_connect($servername,$username,$password,$database);

    if(!$conn) {
        die("sorry we failed to connect: ".mysqli_connect_error());
    }
    else {
        "conecction was successful<br>";
    }

?>