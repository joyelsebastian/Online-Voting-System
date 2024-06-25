<?php
session_start();
include("connect.php");
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];
$check = mysqli_query($connect, "SELECT * FROM USER WHERE MOBILE='$mobile' AND PASSWORD='$password' AND ROLE='$role'");
if (mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);
    $groups = mysqli_query($connect, "SELECT * FROM USER WHERE ROLE=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;
    echo '
    <script>
        window.location="../routes/dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
        alert("Invalid Credentials or User Not Found");
        window.location="../index.html";
    </script>
    ';
}
