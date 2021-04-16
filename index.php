<?php
    include_once "header.php";

    session_start();

    if(isset($_SESSION['unique_id'])) { // if user is logged in (on the same browser)
        header("location: users.php");
    }
?>

<body>

    <div class="wrapper">
        <section class="form signup">
            <header>Chatty</header>

            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>

                    <div class="field input">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i>
                </div>

                <div class="field image">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" required>
                </div>

                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>

            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>

</body>