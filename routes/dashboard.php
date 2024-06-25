<?php
session_start();
if (!isset($_SESSION['userdata'])) {
  header("location: ../");
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
if ($_SESSION['userdata']['status'] == 0) {
  $status = '<b style="color:red">Not Voted</b>';
} else {
  $status = '<b style="color:green">Voted</b>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <title>Online Voting System</title>
</head>

<body>

  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Online Voting System</h5>
    <a class="btn btn-outline-primary" href="logout.php">Sign Out</a>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="card-body text-center">
        <img src="../uploads/<?php echo $userdata['photo'] ?>" alt="avatar" class="img-fluid" style="width: 150px;">
      </div>
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Name</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?php echo $userdata['name'] ?></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Mobile</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?php echo $userdata['mobile'] ?></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Address</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?php echo $userdata['address'] ?></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <p class="mb-0">Status</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0"><?php echo $status ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <?php
      if ($_SESSION['groupsdata']) {
        for ($i = 0; $i < count($groupsdata); $i++) {
      ?>
          <div class="card-body">
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><img src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" alt="avatar" class="img-fluid" height="100px" width="100px"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Group Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $groupsdata[$i]['name'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Votes</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $groupsdata[$i]['votes'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9">
                <form action="../api/vote.php" method="POST">
                  <input type="hidden" name="groupvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                  <input type="hidden" name="groupid" value="<?php echo $groupsdata[$i]['id'] ?>">
                  <?php
                  if ($_SESSION['userdata']['status'] == 0) {
                  ?>
                    <input type="submit" value="Vote" name="votebtn" id="votebtn" style="background-color:#3498db;">
                  <?php
                  } else { ?>
                    <button disabled type="button" value="Vote" name="votebtn" style="background-color:green;">Voted</button>
                  <?php
                  }
                  ?>
                </form>
              </div>
            </div>
            <hr>
          </div>
      <?php
        }
      } else {
      }
      ?>
    </div>
  </div>
</body>

</html>