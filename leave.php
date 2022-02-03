<?php
include('top.php');
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "delete from `leave` where id='$id'");
}
if (isset($_GET['type']) && $_GET['type'] == 'update' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $status = mysqli_real_escape_string($con, $_GET['status']);
    mysqli_query($con, "update `leave` set leave_status='$status' where id='$id'");
}
if ($_SESSION['ROLE'] == 1) {
    $sql = "select `leave`.*,employee.name from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
} else {
    $eid = $_SESSION['USER_ID'];
    $sql = "select `leave`.*,employee.name from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$res = mysqli_query($con, $sql);
?>

<div class="row my-5">
    <h3 class="fs-4 mb-3">Leave Master</h3>
    <?php
    if ($_SESSION['ROLE'] == 2) {
    ?>
        <h3 class="fs-5 mb-3"><a href="add_leave.php" class="text-decoration-none">Add Leave</a></h3>
    <?php } ?>
    <div class="col table-responsive-sm">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Description</th>
                    <th scope="col">Leave Status</th>
                    <?php
                    if ($_SESSION['ROLE'] == 1) {
                    ?>
                        <th scope="col">Update Status</th>
                    <?php } else { ?>
                        <th scope="col"></th>
                    <?php } ?>
                    <?php
                    if ($_SESSION['ROLE'] == 2) {
                    ?>
                        <th scope="col" width="120px"></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['leave_from'] ?></td>
                            <td><?php echo $row['leave_to'] ?></td>
                            <td><?php echo $row['leave_description'] ?></td>
                            <td><?php
                                if ($row['leave_status'] == 1) {
                                    echo "Applied";
                                }
                                if ($row['leave_status'] == 2) {
                                    echo "Approved";
                                }
                                if ($row['leave_status'] == 3) {
                                    echo "Rejected";
                                }
                                ?></td>
                            <td><?php
                                if ($_SESSION['ROLE'] == 1) {
                                ?>
                                    <select class="form-control form-control-sm" onchange="update_leave_status(<?php echo $row['id'] ?>,this.options[this.selectedIndex].value)">
                                        <option value="">Update Status</option>
                                        <option value="2">Approved</option>
                                        <option value="3">Rejected</option>
                                    </select>
                                <?php } ?>
                            </td>
                            <td>
                                <?php
                                if ($_SESSION['ROLE'] == 2) {
                                    if ($row['leave_status'] == 1) { ?>
                                        <a href="leave.php?id=<?php echo $row['id'] ?>&type=delete" class="link-danger text-decoration-none">Delete</a>
                                <?php }
                                } ?>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                } else { ?>
                    <td colspan="8" class="text-center">No Data Found</td>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function update_leave_status(id, select_value) {
        window.location.href = 'leave.php?id=' + id + '&type=update&status=' + select_value;
    }
</script>
<?php
include('footer.php');
?>