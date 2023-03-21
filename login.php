<?php
    session_start();
    include('server/connection.php');

    if (isset($_SESSION['logged_in'])) {
        header('location: welcome.php');
        exit;
    }

    if (isset($_POST['login_btn'])) {
        $email = $_POST['email'];
        $password = ($_POST['password']);

        $query = "SELECT id, name, email, password, phone,
        address, city, photo FROM users
        WHERE email = ? AND password = ? LIMIT 1";

        $stmt_login = $conn->prepare($query);
        $stmt_login->bind_param('ss', $email, $password);
        
        if ($stmt_login->execute()) {
            $stmt_login->bind_result($id, $name, $email, $password, 
            $phone, $address, $city, $photo);
            $stmt_login->store_result();

            if ($stmt_login->num_rows() == 1) {
                $stmt_login->fetch();

                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                $_SESSION['address'] = $address;
                $_SESSION['city'] = $city;
                $_SESSION['photo'] = $photo;
                $_SESSION['logged_in'] = true;

                header('location:welcome.php?message=Logged in successfully');
            } else {
                header('location:login.php?error=Could not verify your account');
            }
        } else {
            // Error
            header('location: login.php?error=Something went wrong!');
        }
    }
?>
    <!-- Login Section Begin -->
    <section>
        <div>
            <div>
                <form id="login-form" method="POST" action="login.php">
                    <?php if (isset($_GET['error'])) ?>
                    <div role="alert">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        } ?>
                    </div>
                    <div>
                        <div>
                            <center>
                            <h2>LOGIN</h2>
                            <div>
                                <h4>Email</h4>
                                <input type="email" class="styled-input" name="email" placeholder="Enter Your Email" >
                            </div>
                            <div>
                                <h4>Password</h4>
                                <input type="password" class="styled-input" name="password" placeholder="Enter Your Password">
                            </div>

                            <div>
                                    <input type="submit" class="site-btn" id="login-btn" 
                                name="login_btn" value="LOGIN" class="styled-submit"/>
                                <p>Don't have an account?<a class="styled-submit" role="button" href="register.html">Register</a></p>
                            </div>
                            <div>
                            </div>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="css/login.css" type="text/css">