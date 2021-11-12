<?php
include('database.php');

error_reporting(0);

session_start();
$id= $_SESSION['id'];
$email= $_SESSION['email'];

// input fields 
$title = input_field($_POST["title"]);
$desc = input_field($_POST["desc"]);
$image = input_field($_POST["image"]);

$tmp = $_FILES["image"]["tmp_name"];
$fname = $_FILES["image"]["name"];


// error variables 
$titleErr = $descErr =  $imageErr = "";

// validation
if (isset($_POST["sub"])) {

    // title validation 
    if (empty($title)) {
        $titleErr = "<br> Title is required.";
    } 

    // description validation 
    if (empty($desc)) {
        $descErr = "<br>Description  is required.";
    } 

   
    $ext = pathinfo($fname, PATHINFO_EXTENSION);
    $fn =  "$email-".time()."-" . "." .$ext;


    

    if ($titleErr === "" && $descErr === "" ) 
    {
        if ($ext == "jpg" || $ext == "png" || $ext == "jpeg"){
            if(mysqli_query($conn,"insert into posts(title,description,image,user_id) values ('$title','$desc','$fn','$id')")){
                move_uploaded_file($tmp, "uploads/$fn");
                echo "<script> alert('Post Added Successfully');  </script>";
            }
            else{
                echo "<script> alert('Post not Added');  </script>";
            }
    }
    else{
        $imageErr = "Please Select image file png, jpg or jpeg";
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

    <title>Add Post</title>
  </head>
  <body style="background-color: #eee;">
   

  <section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/img3.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">ADD POST</h3>

            <form class="px-md-2" method="POST" enctype="multipart/form-data">

              <div class="form-outline mb-4">
                <input type="text" id="title" name="title" class="form-control" />
                <label class="form-label" for="title">Title</label>
                <small id="err" class="form-text text-danger"><?php echo $titleErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="text" id="desc" name="desc" class="form-control" />
                <label class="form-label" for="desc">Description</label>
                <small id="err" class="form-text text-danger"><?php echo $descErr; ?></small>
              </div>

              <div class="form-outline mb-4">
                <input type="file" id="image" name="image" class="form-control" />
                <label class="form-label" for="image">Image</label>
                <small id="err" class="form-text text-danger"><?php echo $imageErr; ?></small>
              </div>

              
              
              <input type="submit" name="sub"  class="btn btn-success btn-lg mb-1"></input>

              <p class="text-center text-muted mt-5 mb-0"> <a href="index.php" class="fw-bold text-body"><u>Log Out</u></a></p>
              <p class="text-center text-muted mt-5 mb-0"> <a href="view.php" class="fw-bold text-body"><u>View Post</u></a></p>


            </form>

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