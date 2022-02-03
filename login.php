<?php
include('db.php');
$msg = "";
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $res = mysqli_query($con, "select * from employee where email='$email' and password='$password'");
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['ROLE'] = $row['role'];
        $_SESSION['USER_ID'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];
        header('location:index.php');
        die();
    } else {
        $msg = "Please Enter Correct Login Details";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="styles.css" />
  <title>Login Page</title>
</head>

<body>
  <div class="d-flex" id="wrapper">


    <!-- Page Content -->
    <div id="page-content-wrapper">
      <section class="vh-100" style="background-color: #009d63;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5">

                  <h3 class="mb-5 text-center">Login</h3>
                  <form method="post">
                    <div class="form-outline mb-4">
                      <label class="form-label fs-5">Email</label>
                      <input type="email" class="form-control form-control-lg" name="email" required/>

                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label fs-5">Password</label>
                      <input type="password" class="form-control form-control-lg" name="password" required/>
                      <div class="mt-2 error_msg">
                      <?php echo $msg ?>
                      </div>
                    </div>



                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button>
                  </form>
                  <hr class="my-4">

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- /#page-content-wrapper -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
      el.classList.toggle("toggled");
    };
  </script>
</body>

</html>