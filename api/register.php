<?php
include("connect.php");
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$address = $_POST['address'];
$photo = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];
move_uploaded_file($tmp_name, "../uploads/$photo");
$insert = mysqli_query($connect, "INSERT INTO USER(name,mobile,password,address,photo,role,status,votes) VALUES ('$name','$mobile','$password','$address','$photo','$role',0,0)");
if ($insert) {
    echo '
    <script>
        alert("Registration Successfull");
        window.location="../index.html";
    </script>
    ';
} else {
    echo '
    <script>
        alert("Error Occured!");
        window.location="../routes/register.html";
    </script>
    ';
}
