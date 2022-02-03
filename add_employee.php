<?php
include('top.php');
$name = "";
$email = "";
$mobile = "";
$department_id = "";
$address = "";
$birthday = "";
$id = "";
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    if ($_SESSION['ROLE'] == 2 && $_SESSION['USER_ID'] != $id) {
        die('Access Denied');
    }
    $res = mysqli_query($con, "select * from employee where id='$id'");
    $row = mysqli_fetch_assoc($res);
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $department_id = $row['department_id'];
    $address = $row['address'];
    $birthday = $row['birthday'];
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $department_id = mysqli_real_escape_string($con, $_POST['department_id']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
    if ($id > 0) {
        $sql = "update employee set name='$name',email='$email',mobile='$mobile',password='$password',department_id='$department_id',address='$address',birthday='$birthday' where id='$id'";
    } else {
        $sql = "insert into employee (name,email,mobile,password,department_id,address,birthday,role) values('$name','$email','$mobile','$password','$department_id','$address','$birthday','2')";
    }
    mysqli_query($con, $sql);
    header('location:employee.php');
    die();
}
?>
<div class="row my-5">
<?php
if ($_SESSION['ROLE'] == 1) {
?>
    <h3 class="fs-4 mb-4">Add Employee</h3>
    <?php } else {?>
        <h3 class="fs-4 mb-4">Profile</h3>
        <?php } ?>
    <div class="col">
        <form class="row g-3" method="POST">
            <div class="col-md-12">
                <label class="form-label fs-5">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
            </div>
            <div class="col-md-12">
                <label class="form-label fs-5">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>" required>
            </div>
            <div class="col-md-12">
                <label class="form-label fs-5">Mobile</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo $mobile ?>" required>
            </div>
            <?php
            if ($_SESSION['ROLE'] == 1) {
            ?>
            <div class="col-md-12">
                <label class="form-label fs-5">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <?php } ?>
            <div class="col-md-12">
                <label class="form-label fs-5">Department</label>
                <select name="department_id" class="form-control" required>
                    <option value="">Select Department</option>
                    <?php
                    $res = mysqli_query($con, "select * from department order by department asc");
                    while ($row = mysqli_fetch_assoc($res)) {
                        if ($department_id == $row['id']) {
                            echo "<option value=" . $row['id'] . " selected='selected'>" . $row['department'] . "</option>";
                        } else {
                            echo "<option value=" . $row['id'] . ">" . $row['department'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label fs-5">Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address ?>" required>
            </div>
            <div class="col-md-12">
                <label class="form-label fs-5">Birthday</label>
                <input type="date" class="form-control" name="birthday" value="<?php echo $birthday ?>" required>
            </div>
            <?php if( $_SESSION['ROLE']==1) {?>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
            <?php } ?>
        </form>
    </div>
</div>
<?php
include('footer.php');
?>