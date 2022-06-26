<?php
session_start();
include 'db/db.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM sh1.user_info WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $Already_user = mysqli_num_rows($result);

    if($Already_user){
        $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: index.php');
    }else {
        echo "	<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <b>error check your info</b>
    </div>";
    }

}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:th="https://www.thymeleaf.org" xmlns:sec="https://www.thymeleaf.org/thymeleaf-extras-springsecurity3">

<head>
    <?php include 'header.php'; ?>
</head>

<body class="text-center">
    <!-- <div class="alert alert-danger" role="alert" th:if="${param.error}">
        ユーザIDとパスワードが一致しません。
    </div>
    <div class="alert alert-primary" role="alert" th:if="${param.logout}">
        ログアウトしました。
    </div> -->
    <h1 class="h3 mt-2 mb-3 font-weight-normal">ログイン</h1>
    <form class="w-25 mx-auto" method="post">
        <input type="email" name="email" placeholder="email" rrequired>
        <input type="password" name="password" placeholder="password" required><br><br>
        <button type="submit" name="login" class="btn btn-primary">login</button>
    </form>

    <p class="mt-2 mb-3 text-muted">&copy; 2021</p>

    <?php include 'footer.php'; ?>
</body>

</html>