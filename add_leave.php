<?php
include('top.php');

if (isset($_POST['submit'])) {
    $leave_id = mysqli_real_escape_string($con, $_POST['leave_id']);
    $leave_from = mysqli_real_escape_string($con, $_POST['leave_from']);
    $leave_to = mysqli_real_escape_string($con, $_POST['leave_to']);
    $employee_id =  $_SESSION['USER_ID'];
    $leave_description = mysqli_real_escape_string($con, $_POST['leave_description']);
    $sql = "insert into `leave` (leave_id,leave_from,leave_to,employee_id,leave_description,leave_status) values('$leave_id','$leave_from','$leave_to','$employee_id','$leave_description','1')";

    mysqli_query($con, $sql);
    header('location:leave.php');
    die();
}
?>
<div class="row my-5">
    <h3 class="fs-4 mb-4">Add Leave</h3>
    <div class="col">
        <form class="row g-3" method="POST">
            <div class="col-md-12">
                <label class="form-label fs-5">Leave Type</label>
                <select name="leave_id" class="form-control">
                    <option value="">Select Leave</option>
                    <?php
                    $res = mysqli_query($con, "select * from leave_type order by leave_type asc");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value=" . $row['id'] . ">" . $row['leave_type'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label fs-5">From Date</label>
                <input type="date" class="form-control" name="leave_from" required>
            </div>
            <div class="col-md-12">
                <label class="form-label fs-5">To Date</label>
                <input type="date" class="form-control" name="leave_to" required>
            </div>
            <div class="col-md-12">
                <label class="form-label fs-5">Leave Description</label>
                <input type="text" class="form-control" name="leave_description">
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