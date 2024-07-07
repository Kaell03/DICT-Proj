<?php
session_start();
include 'connections.php';


if (isset($_POST['login_request'])) {
    // echo "hey";
    $type = $_POST['typeInput'];
    $username = $_POST['usernameInput'];
    $password = $_POST['passwordInput'];

    if (!$conn) {
        echo "<script>alert('Connection to database failed!');</script>";
    }

    $query = "";

    if ($type == "user") {
        $query = "SELECT * FROM  users WHERE username = '$username' AND password ='$password'";
    } else if ($type == "admin") {
        $query = "SELECT * FROM  admin WHERE username = '$username' AND password ='$password'";
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }

    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert('Login Successful!');</script>";
        $_SESSION['sessionUsername'] = $username;
        $_SESSION['sessionPassword'] = $password;

        if ($type == "user") {
            header("Location: user_dashboard.php");
        } else if ($type == "admin") {
            header("Location: admin_dashboard.php");
        }
    } else {
        echo "<script>alert('Incorrect username or passsword!');</script>";
        ;
    }



}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">

<head>

    <style>
        ul img {
            width: 175px;
            height: auto;
            margin: 0;
            padding: 0;
        }

        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #f1f1f1;
            /* background-color: aqua; */
            /* margin-top: 2522; */
            display: flex;
            justify-content: space-between;

        }

        ul.navbar li {
            float: left;
        }

        ul.navbar li a {
            display: block;
            color: #333;
            text-align: end;
            padding: 14px 16px;
            text-decoration: none;
            font-family: 'Merriweather Sans', sans-serif;
        }

        ul.navbar li a:hover {
            background-color: #dddddd;
        }

        h1 {
            color: #0039e6;
            text-align: center;
            font-family: 'Merriweather Sans', sans-serif;
        }

        .login {
            margin-top: 35px;
            margin-right: 10px;
        }

        .logoImg {
            width: 50px;
            height: 50px;
            background-color: #f1f1f1;
            padding: 5px;
            border-radius: 25px;
        }

        .custom-select {
            background-color: #f8f9fa;
            color: #333;
            border: 2px solid #ddd;
            border-radius: 4px;
            padding: 8px;
            width: 50px;
        }
    </style>

</head>

<body>

    <!-- <ul class="navbar">
        <li> <a href=""><img src="img/LOGO.png" alt="DICT logo"></a></li>
        <li><a href="#" class="login">Log In</a></li>
    </ul>
    <h1>Control Number Generator</h1> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark"
        style="width: 100%; display: flex; justify-content: space-between;">
        <div>

            <img src="logo_only.png" href="home.php" alt="asdsada" class="logoImg">
            <a class="navbar-brand" href="home.php" style="color:#f1f1f1">Control Number Generator</a>
        </div>

        <button class="btn btn-warning my-2 my-sm-0" type="submit" data-toggle="modal" data-target="#loginModal">Log In</button>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Login form -->
                    <form method="post" action="">
                        <div class="form-group d-flex align-items-center">
                            <label for="email" class="col-3">Type: </label>
                            <select name="typeInput" class="custom-select" id="">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="email" class="col-3">Username: </label>
                            <input name="usernameInput" type="text" class="form-control" id="username"
                                aria-describedby="Username" placeholder="Enter Username">
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="password" class="col-3">Password: </label>
                            <input name="passwordInput" type="password" class="form-control" id="password"
                                placeholder="Password">
                        </div>

                        <button type="submit" style="margin: 0px auto;"
                            class="btn btn-primary d-flex justify-content-center" type="submit"
                            name="login_request">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>



</html>