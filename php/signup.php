<?php
    session_start();

    include_once "config.php";

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {

        // Check user's email is valid or not
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // if email is valid
            // Check if email already exists in the database
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");

            if (mysqli_num_rows($sql) > 0) { // if email already exists
                echo "$email - This email already exists!";
            } else { // Check if user uploads a file or not
                if (isset($_FILES['image'])) { // if file is uploaded
                    $img_name = $_FILES['image']['name']; // getting the uploaded image name
                    $tmp_name = $_FILES['image']['tmp_name']; // this temporary name will be used to save the file in our folder

                    // Explode the image and get its extension
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); // here, we finally get the extension of the uploaded image file

                    $extensions = ['png', 'jpeg', 'jpg', 'JPG', 'PNG', 'JPEG']; // allowed image extensions stored in array

                    if (in_array($img_ext, $extensions) === true) { // if the uploaded image extension matches the allowed ones
                        $time = time(); // this will get the current time so that we can rename images with the time

                        // Move the uploaded image to our folder
                        $new_img_name = $time.$img_name;

                        if (move_uploaded_file($tmp_name, "images/".$new_img_name)) { // if image is moved successfully
                            $status = "Active now"; // Once user signs up, status becomes active
                            $random_id = rand(time(), 100000000); // creating random id

                            // encrypt the password before storing it
                            $encrypt_pass = md5($password);

                            // Insert all user data in the table
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                 VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");

                            if ($sql2) { // if these data are inserted
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

                                if (mysqli_num_rows($sql3) > 0) {
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id']; // using this session we used user unique_id in other php file

                                    echo "Success!";
                                }
                            } else {
                                echo "Something went wrong!";
                            }
                        }

                    } else {
                        echo "Please select an image with any of these extensions - png, jpeg, jpg";
                    }
                } else {
                    echo "Please select an image file.";
                }
            }
        } else {
            echo "$email - This is not a valid email!";
        }

    } else {
        echo "All input fields are required!";
    }