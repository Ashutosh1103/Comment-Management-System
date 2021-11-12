<?php
include('database.php');

error_reporting(0);

// input fields 
$name = input_field($_POST["name"]);
$email = input_field($_POST["email"]);
$password = input_field($_POST["password"]);
$age = input_field($_POST["age"]);
$city = input_field($_POST["city"]);



// error variables 
$nameErr = $emailErr =  $passwordErr =  $ageErr = $cityErr =  "";

// validation
if (isset($_POST["sub"])) {

    // name validation 
    if (empty($name)) {
        $nameErr = "<br> Name is required.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $nameErr = "<br> Only Characters and white spaces are allowed.";
    } 

    // email validation 
    if (empty($email)) {
        $emailErr = "<br>Email Address is required.";
    } else if (!preg_match("/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/", $email)) {
        $emailErr = "<br>Invalid Email Address.";
    }

   
    // password validation 
    if (empty($password)) {
        $passwordErr = "<br>Password is required.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $password)) {
        $passwordErr = "<br>Length of password should be between 4, 16 characters.";
    }

    // age validation 
    if (empty($age)) {
        $ageErr = "<br>Please Enter your Age.";
    }

    // city validation 
    if (empty($city)) {
        $cityErr = "<br>Please Enter your City.";
    }

    

    if ($nameErr === "" && $emailErr === ""  && $passwordErr  === "" && $ageErr ==  "" && $cityErr === "") 
    {
     if(mysqli_query($conn,"insert into registration(name,email,password,age,city) values ('$name','$email','$password',$age,'$city')")){
         echo "<script> alert('User Registered');  </script>";
         header("location:index.php");
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

    <title>Reistration</title>
  </head>
  <body>
   

  <section class="h-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="name" name="name" class="form-control" />
                      <label class="form-label" for="name"> Name</label>
                      <small id="err" class="form-text text-danger"><?php echo $nameErr; ?></small>
                    </div>
                  </div>

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

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="age" name="age" class="form-control" />
                      <label class="form-label" for="age">Age</label>
                      <small id="err" class="form-text text-danger"><?php echo $ageErr; ?></small>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="city" name="city" class="form-control" />
                      <label class="form-label" for="city">City</label>
                      <small id="err" class="form-text text-danger"><?php echo $cityErr; ?></small>
                    </div>
                  </div>

                  

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" name="sub" class="btn btn-primary btn-lg" value="Register"></input>
                  </div>

                  <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="index.php" class="fw-bold text-body"><u>Login here</u></a></p>

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