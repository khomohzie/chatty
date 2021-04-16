<?php
    $conn = mysqli_connect("localhost", "root", "", "chatty");

    if (!$conn) {
        echo "Database not connected" . mysqli_connect_error();
    }