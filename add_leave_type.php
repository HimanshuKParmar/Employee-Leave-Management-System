<?php
include('top.php');
if ($_SESSION['ROLE'] != 1) {
    header('location:add_employee.php?id=' . $_SESSION['USER_ID']);
    die();
}
$leave_type = "";
$id = "";
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $res = mysqli_query($con, "select * from leave_type where id='$id'");
    $row = mysqli_fetch_assoc($res);
    $leave_type = $row['leave_type'];
}

if (isset($_POST['submit'])) {
    $leave_type = mysqli_real_escape_string($con, $_POST['leave_type']);
    if ($id > 0) {
        $sql = "update leave_type set leave_type='$leave_type' where id='$id'";
    } else {
        $sql = "insert into leave_type (leave_type) values('$leave_type')";
    }
    mysqli_query($con, $sql);
    header('location:leave_type.php');
    die();
}
?>
<div class="row my-5">
  <h3 class="fs-4 mb-4">Add Leave Type</h3>
  <div class="col">
    <form class="row g-3" method="POST">
      <div class="col-md-12">
        <label class="form-label fs-5">Leave Type</label>
        <input type="text" class="form-control" name="leave_type" value="<?php echo $leave_type ?>" required>
      </div>
     
      <div class="col-12">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </form>
  </div>
</div>
<?php
include('footer.php');
?>