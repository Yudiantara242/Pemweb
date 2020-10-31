<?php
require 'functions.php';
if(isset($_POST["register"])){


    if(registrasi($_POST) > 0 ){
        echo "
        <script>
            alert('User baru berrhasil ditambah');
        </script>
        ";

        
    }else{
        echo mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html>
<head>
<title>Halaman Registrasi</title>
<style>
    label {
        display: block;
    }
    </style>
</head>
<body>
<h1>Halaman Registrasi</h1>


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
<label for="password2">Ulangi : </label>
    <input type="password" name="password2" id="password2" required>
</li>
<li>
<button type="submit" name="register">Register</button>
</li>
</ul>

</form>

