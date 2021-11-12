<?php
include('database.php');

error_reporting(0);

// input fields 

$email = input_field($_POST["email"]);
$password = input_field($_POST["password"]);

session_start();
$_SESSION['id']=$email;


// error variables 
$nameErr = $emailErr = "";

// validation
if (isset($_POST["sub"])) {

    

    // email validation 
    if (empty($email)) {
        $emailErr = "<br>Email Address is required.";
    } else if (!preg_match("/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/", $email)) {
        $emailErr = "<br>Invalid Email Address.";
    }

   
    // password validation 
    if (empty($password)) {
        $passwordErr = "<br>Password is required.";
    } 

   

    

    if ($emailErr == "" && $passwordErr  == "" ) {
        $sel=mysqli_query($conn,"select * from registration where (email='$email' or password='$password');");
        if(mysqli_num_rows($sel)>0){
            // $sn=1;
            $arr=mysqli_fetch_assoc($sel);
  
            if($email===$arr['email'])
            {
                if($password===$arr['password']){
                    session_start();
                    $_SESSION['id']=$arr['id'];
                    $_SESSION['email']=$email;
                    
                    echo "<script> alert('User Registered');  </script>";
                    header('location:dashboard.php');
                }
                else{
                  $passwordErr = "<br>Incorrect Password.";
                }
            } 
            else{
              $emailErr = "<br>Incorrect Email.";
            }
       
  
          }
          else{
            echo "<script> alert('User not Registered');  </script>";
          }
        }

}



// trim function 
function input_field($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Log In</title>
  </head>
  <body>
   

  <section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>

                <form class="mx-1 mx-md-4" method="POST">

                 

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="email" name="email" class="form-control" />
                      <label class="form-label" for="email">Email</label>
                      <small id="err" class="form-text text-danger"><?php echo $emailErr; ?></small>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="password" name="password" class="form-control" />
                      <label class="form-label" for="password">Password</label>
                      <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
                    </div>
                  </div>

                  

                  

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" name="sub" class="btn btn-primary btn-lg" value="Log In"></input>
                  </div>

                  <p class="text-center text-muted mt-5 mb-0">Dont Have an account? <a href="regis.php" class="fw-bold text-body"><u>Register here</u></a></p>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   
  </body>
</html>