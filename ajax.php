<?php 
include("database.php");
//for add comment 
if(!empty($_POST['comment']) && !empty($_POST['id']))
{
   $comment=$_POST['comment'];
   $id=$_POST['id'];
  
   if(mysqli_query($conn,"insert into comments(comment,post_id) values ('$comment',$id)")){
       echo "<div >".$comment."</option>";
   }
   else {
       echo "User Not Added";
   }
}
// if(isset($_POST['show'])){
//     $id=$_POST['show'];
//     $sel=mysqli_query($conn,"select * from comments where post_id='$id'");
   
//     while($arr=mysqli_fetch_assoc($sel)){
      
//         echo " $arr[comment] ";
//     }
//   }
?>