<?php
    session_start();

    include_once "config.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password)) {
        // Check the entered email and password to see if it matches any record
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

        if(mysqli_num_rows($sql) > 0) { // if user's credentials matched
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];

            if($user_pass === $enc_pass) {
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                if($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "Success!";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Email or Password is incorrect!";
            }
        } else {
            echo "$email - This email does not exist!";
        }
    } else {
        echo "All input fields are required!";
    }