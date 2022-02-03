<?php
include('top.php');
if ($_SESSION['ROLE'] != 1) {
  header('location:add_employee.php?id=' . $_SESSION['USER_ID']);
  die();
}
$department = "";
$id = "";
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $res = mysqli_query($con, "select * from department where id='$id'");
  $row = mysqli_fetch_assoc($res);
  $department = $row['department'];
}

if (isset($_POST['submit'])) {
  $department = mysqli_real_escape_string($con, $_POST['department']);
  if ($id > 0) {
    $sql = "update department set department='$department' where id='$id'";
  } else {
    $sql = "insert into department (department) values('$department')";
  }
  mysqli_query($con, $sql);
  header('location:index.php');
  die();
}
?>
<div class="row my-5">
  <h3 class="fs-4 mb-4">Add Department</h3>
  <div class="col">
    <form class="row g-3" method="POST">
      <div class="col-md-12">
        <label class="form-label fs-5">Department Name</label>
        <input type="text" class="form-control" name="department" value="<?php echo $department ?>" required>
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