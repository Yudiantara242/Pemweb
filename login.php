<?php
session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
}
require 'functions.php';
if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    
   if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Halaman Login</title>
</head>
<body>
<h1>Halaman Login</h1>

<?php if(isset($error)) : ?>
<p style="color: red; font-stle: italic;">username dan password tidak cocok</p>
<?php endif; ?>
<form actions="" method="post">
<ul>
<li>
<label for="username">Username : </label>
    <input type="text" name="username" id="username" required>
</li>
<li>
<label for="password">Password : </label>
    <input type="password" name="password" id="password" required>
</li>
<li>
<button type="submit" name="login">Login</button>
</li>
</ul>

</form>

