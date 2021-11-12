<?php
include('database.php');

session_start();
$sid= $_SESSION['id'];
$semail= $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body style="background-color: #eee;">
    
    
           
<div class="container-fluid">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">POST</th>
      <th scope="col">TITLE</th>
      <th scope="col">DESCRIPTION</th>
      <th scope="col">USER ID</th>
      <th scope="col"></th>
      <th scope="col">COMMENTS</th>
      
  
    </tr>
  </thead>
  <tbody>
            <?php
            $sel=mysqli_query($conn,"select * from posts");
            if(mysqli_num_rows($sel)>0){
               
                while($arr=mysqli_fetch_assoc($sel)){
                    ?>
                    <tr>
                    <td><?php $image=$arr['image']; echo "<img style='height:500px;width:500px' src='uploads/$image' >"; ?></td>
                        <td><?php echo $arr['title']; ?></td>
                        <td><?php echo $arr['description']; ?></td>
                        <td><?php 
                        $id=$arr['user_id'];
                        $sel1=mysqli_query($conn,"select * from registration where id=$id");
                        $arr1=mysqli_fetch_assoc($sel1);
                        echo $arr1['email']; ?></td>
                        <td><input type="text" id="comment" name="comment" data-id="<?= $arr['id'];?>" placeholder="Comment..."></input>
                        <input type="submit" name="sub"  id="sub"  value="SUBMIT"></input>
                        </td>
                        <td><?php 
                        $id1=$arr['id'];
                        $sel2=mysqli_query($conn,"select * from comments where post_id=$id1");
                        while($arr2=mysqli_fetch_assoc($sel2)){
                            echo $arr2['comment']."<br>";
                        }
                         ?></td>
                        
                        

                    </tr>
                    <?php
                   
                }
            }
            
            else{
                ?>
                <tr>
                    <td colspan="6" align="center">No Records Found</td>
                </tr>
                <?php
            }
            ?>
            <tr>
                    <td colspan="6" align="center">Click Here to <a  href="add.php">Add Post</a></td>
                </tr>
                <tr>
                    <td colspan="6" align="center">Click Here to <a  href="index.php">Logout</a></td>
                </tr>
           
        </tbody>
</table>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   
    $(document).ready(function(){
        $(document).on('blur',"#comment",function(){
        
           var comment=$(this).val();
        //    alert(comment);

        
            var id=$(this).data('id');
         //   alert(id);
           
           
            
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:{'comment':comment,'id':id},
                success:function(result){
                    
                    alert("Comment Added Successfully.");
                   
                },
                error:function(){
                    alert("Comment Not Added.");
                }
           
            })
        })

       
    })
    </script>
</body>
</html>