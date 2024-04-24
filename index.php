<?php
// ----------------------------------login-----------------------------------
session_start();
require_once 'connect.php';
// if(isset($_SESSION['error'])){
//     echo "hello";
// unset($_SESSION['error']);
// }
if (isset($_POST['login']) ) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $sql = "SELECT Email,Password FROM register WHERE Email='$email' AND Password='$password' ";

        $result = $conn->query($sql);
        $a = $result->fetch_all();
        $emailC = array_column($a, 0);
        $passwordC = array_column($a, 1);

        // ------------sqlinjection==========
        // $stmt = mysqli_prepare($conn, $sql);
        // mysqli_stmt_bind_param($stmt, 'Email', $email);
        // mysqli_stmt_execute($stmt);
        // ================================
        foreach ($a as $value) {
            if (in_array($email, $value) && in_array($password, $value)) {

                $ok = "ok";
                // echo $ok;
            } else {

                $error = "error";
                // echo $error;
            }
        }
        if (isset($ok)) {
            $sql3 = mysqli_query($conn, "SELECT * FROM register WHERE  Email= '$email' ");
            if (mysqli_num_rows($sql3) > 0) {
                $row = mysqli_fetch_assoc($sql3);
                $_SESSION['id'] = $row['id'];
                echo "success";

                header("location: chat.php");
            }
        } else {
        
            $_SESSION['error'] =  "Email or Password is incorrect!" ;

        }
        // print_r($emailC);
        // print_r($passwordC);
    } else {
        $errors['all-input'] =   "All input field are required!";
    }
}
// ----------------------------------register-----------------------------------


if (isset($_POST['register']) &&  $_SERVER['REQUEST_METHOD']==='post') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $mainLanguage = $_POST['main-language'];
    $password = $_POST['password'];
    // $sql = "INSERT INTO register (Username,Email,Country,MainLanguage,Password) VALUE ('$username','$email','$country','$mainLanguage','$password')";
    // mysqli_query($conn, $sql);
    if (!empty($username) && !empty($email) && !empty($country) && !empty($mainLanguage) && !empty($password) && $_FILES['image']['size'] > 0) {
        $password = htmlspecialchars($_POST["password"]);
        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#
        ?&])[A-Za-z\d@$!%*?#&]{8,}$/';
        if (preg_match($password_pattern, $password)) {
        
        

        if (filter_input(INPUT_POST, 'username', FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^[a-zA-Z]+$/']]) != false) {


            if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) != false) {
                $sql1 = mysqli_query($conn, "SELECT Email FROM register WHERE Email= '$email'");
                if (mysqli_num_rows($sql1) === 0) {
                    $img_name = $_FILES['image']['name'];
                    // $img_type =$_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ['png', 'jpeg', 'jpg'];
                    if (in_array($img_ext, $extensions) == true) {
                        $time = time();
                        $new_img_name = $time . $img_name;

                        if (move_uploaded_file($tmp_name, "image/" . $img_name)) {
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $sql2 = mysqli_query($conn, "INSERT INTO register (Username,Email,Country,MainLanguage,Password,Img,Status) 
                        VALUE ('$username','$email','$country','$mainLanguage','$password','$img_name','$status')");

                            if ($sql2) {
                                $sql3 = mysqli_query($conn, "SELECT * FROM register WHERE  Email= '$email' ");
                                if (mysqli_num_rows($sql3) > 0) {
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['id'] = $row['id'];
                                    echo "success";
                                    $_SESSION['login'] = 'ok';
                                    header("location: chat.php");
                                }
                            } else {
                                $errors['error'] =  "something went wrong!";
                            }
                        } else {
                            $errors['upload']  = "upload failed!";
                        }
                    } else {
                        $errors['ex'] = "please select an image file - jpeg, jpg, png! ";
                    }
                } else {
                    $errors['exist'] = " This email already exist!";
                }
            } else {
                $errors['valid-email'] = "This is not a valid email!";
            }
        } else {
            $errors['username'] = "Username must be characters only!";
        }
    }else{
        $errors['password'] = "Password must have at least 8 character length with minimum 1 uppercase, 1 lowercase, 1 number and 1 special characters.\n";

    }
    } else {
        $errors['all-input'] =   "All input field are required!";
    }
}

if (empty($_SESSION['id'])) {





?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Easy Communication</title>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
        <link rel="stylesheet" href="login.css">
    </head>

    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form class="sign-in-form" method="post">
                        <h2 class="title">Sign In</h2>
                        <div class="input-field">
                            <i class='bx bxs-envelope'></i>
                            <input type="email" name="email" class="form-control p_input" placeholder="Email">
                        </div>
                        <div class="input-field">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" class="form-control p_input" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <small><?= (isset($_SESSION['error'])) ? $_SESSION['error'] : null; ?></small>

                            <small><?= (isset($errors['all-input'])) ? $errors['all-input'] : null; ?></small>
                            </br>
                            <button type="submit" name="login" class="btn btn-primary btn-block enter-btn">Login</button>
                        </div>
                        <!-- <input type="submit" value="Login" class="btn solid"> -->
                        <p class="social-text">Or sign up with social platforms</p>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class='bx bxl-facebook'></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class='bx bxl-twitter'></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class='bx bxl-google'></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class='bx bxl-linkedin'></i>
                            </a>
                        </div>
                    </form>
                    <form class="sign-up-form" method="post" enctype="multipart/form-data">
                        <!-- <div class="error-txt">This is an error message!</div> -->
                        <h2 class="title">Sign Up</h2>
                        <div class="input-field">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="username" placeholder="Username" class="form-control p_input">
                            <small><?= (isset($errors['username'])) ? $errors['username'] : null; ?></small>
                        </div>
                        <div class="input-field">
                            <i class='bx bxs-envelope'></i>

                            <input type="email" name="email" placeholder="Email" class="form-control  p_input">
                            <small><?= (isset($errors['exist'])) ? $errors['exist'] : null; ?></small>
                            <small><?= (isset($errors['valid-email'])) ? $errors['valid-email'] : null; ?></small>


                        </div>
                        <div class="input-field">
                            <i class="ri-earth-line"></i>
                            <input type="text" name="country" placeholder="Country" class="form-control  p_input">
                        </div>
                        <div class="input-field">
                            <i class="ri-global-line"></i>
                            <input type="text" name="main-language" placeholder="Main Language" class="form-control  p_input">
                        </div>
                        <div class="input-field">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="Password" class="form-control  p_input">
                            <small><?= (isset($errors['password'])) ? $errors['password'] : null; ?></small>

                        </div>
                        <div class="input-field">
                            <i class='bx bxs-alt '></i>
                            <input type="file" name="image" placeholder="Image" class="form-control  p_input">
                            <small><?= (isset($errors['upload'])) ? $errors['upload'] : null; ?></small>
                            <small><?= (isset($errors['ex'])) ? $errors['ex'] : null; ?></small>

                        </div>

                        <div class="button input">
                            <small><?= (isset($errors['all-input'])) ? $errors['all-input'] : null; ?></small>
                            <small><?= (isset($errors['error'])) ? $errors['error'] : null; ?></small>
                            </br>
                            <button type="submit" name="register" class="btn btn-primary btn-block enter-btn">Signup</button>
                        </div>
                        <!-- <input type="submit" name="button" class="btn btn-primary btn-block enter-btn" value="Sign Up" class="btn solid"> -->
                        <p class="social-text">Or sign in with social platforms</p>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class='bx bxl-facebook'></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class='bx bxl-twitter'></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class='bx bxl-google'></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class='bx bxl-linkedin'></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>WELCOME BACK!</h3>
                        <p>
                        </p>
                        <button class="btn transparent" id="sign-up-btn">Sign up</button>
                    </div>
                    <img src="Profiling_Monochromatic.png" class="image" alt="">
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>WELCOME!</h3>
                        <p>
                        </p>
                        <button class="btn transparent" id="sign-in-btn">Sign in</button>
                    </div>
                    <img src="Authentication_Outline.png" class="image" alt="">
                </div>
            </div>
        </div>
        <script src="login.js"></script>
    </body>

    </html>
<?php
if(empty($_SESSION['error'])){
    echo "hello";
unset($_SESSION['error']);
}
} else {
    header("location: chat.php");
}
?>