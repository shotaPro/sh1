<?php
include 'db/db.php';

if (isset($_POST['signIn'])) {

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    if (empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($mobile) || empty($address1) || empty($address2)) {

        echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Please fill all the fields!</div>";
    } else {

        $sql = "SELECT * FROM sh1.user_info WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $email_row = mysqli_num_rows($result);


        if ($email_row > 0) {

            echo "	<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>Email Address is already available Try Another email address</b>
        </div>";

        } else {

            $sql = "INSERT INTO sh1.user_info (first_name, last_name, email, password, mobile, address1, address2) VALUES('$f_name','$l_name','$email','$password','$mobile','$address1','$address2')";
            $result = mysqli_query($conn, $sql);

            header('Location: index.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
</head>

<body class="text-center">
    <h2>Login here</h2>
    <form method="post" class="text-center"><br>
        <h2>first_name</h2>
        <input type="text" name="f_name"><br>
        <h2>last_name</h2>
        <input type="text" name="l_name"><br>
        <h2>email</h2>
        <input type="email" name="email"><br>
        <h2>password</h2>
        <input type="password" name="password"><br>
        <h2>mobile</h2>
        <input type="text" name="mobile"><br>
        <h2>address1</h2>
        <input type="text" name="address1"><br>
        <h2>address2</h2>
        <input type="text" name="address2"><br>
        <button type="submit" name="signIn">登録する</button>
    </form>

    <?php include 'footer.php'; ?>
</body>

</html>