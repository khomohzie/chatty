<?php
    include_once "header.php";

    session_start();

    if(isset($_SESSION['unique_id'])) { // if user is logged in (on the same browser)
        header("location: users.php");
    }
?>

<body>

    <div class="wrapper">
        <section class="form login">
            <header>Chatty</header>

            <form action="#">
                <div class="error-txt">This is an error message!</div>

                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter new password">
                    <i class="fas fa-eye"></i>
                </div>

                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>

            <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>

</body>

</html>