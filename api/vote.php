<?php
session_start();
include("connect.php");
$votes = $_POST['groupvotes'];
$total_votes = floatval($votes) + 1;
$groupid = $_POST['groupid'];
$userid = $_SESSION['userdata']['id'];
$update_votes = mysqli_query($connect, "UPDATE USER SET VOTES='$total_votes' WHERE id='$groupid'");
$update_user_status = mysqli_query($connect, "UPDATE USER SET STATUS=1 WHERE ID='$userid'");
if ($update_votes and $update_user_status) {
    $groups = mysqli_query($connect, "SELECT * FROM USER WHERE ROLE=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    echo '
    <script>
        alert("Voting Successfull");
        window.location="../routes/dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
        alert("Some Error Occured");
        window.location="../routes/dashboard.php";
    </script>
    ';
}
