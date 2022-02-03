<?php
include('top.php');
if ($_SESSION['ROLE'] != 1) {
    header('location:add_employee.php?id=' . $_SESSION['USER_ID']);
    die();
}
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    mysqli_query($con, "delete from department where id='$id'");
}
$res = mysqli_query($con, "select * from department order by id desc");
?>

<div class="row my-5">
    <h3 class="fs-4 mb-3">Department Master</h3>
    <h3 class="fs-5 mb-3"><a href="add_department.php" class="text-decoration-none">Add Department</a></h3>
    <div class="col table-responsive-sm">
        <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
                <tr>
                    <th scope="col" width="50">#</th>
                    <th scope="col">Department Name</th>
                    <th scope="col" width="120px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $count=mysqli_num_rows($res);
                 if($count>0)
                 {
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $row['department'] ?></td>
                        <td>
                            <a href="add_department.php?id=<?php echo $row['id'] ?>" class="link-success text-decoration-none">Edit</a>&nbsp;
                            <a href="index.php?id=<?php echo $row['id'] ?>&type=delete" class="link-danger text-decoration-none">Delete</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                } } else {?>
                <td colspan="3" class="text-center">No Data Found</td>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('footer.php');
?>