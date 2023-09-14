<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum for coders</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>
</head>


<body>
  <?php
  require "partials/_header.php";
  require "partials/_dbconnect.php" ?>
  

  <?php
  $id=$_GET['threadid'];
  $sql="SELECT * FROM `threads` WHERE thread_id=$id";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_assoc($result))
  {
       $title=$row['thread_title'];
       $desc=$row['thread_desc'];
       $thread_user_id=$row['thread_user_id'];
   //query the users table to find out name.
       $sql1="SELECT user_email FROM `users` WHERE sno=$thread_user_id";
       $result1=mysqli_query($conn,$sql1);
       $row2=mysqli_fetch_assoc($result1);
       $posted_by=$row2['user_email'];

  }
  ?>


     <?php
   if($_SERVER['REQUEST_METHOD'] === 'POST')
{     
$con=$_POST['comment'];
$con=str_replace('<',"&lt",$con);
$con=str_replace('>',"&gt",$con);
$id=$_GET['threadid'];
$d=false;
$tp=false;
$sno=$_SESSION["sno"];

if($con!=null )
{
$sql="INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES (NULL, '$con', '$id', '$sno', CURRENT_TIMESTAMP)";
  $result=mysqli_query($conn,$sql);
  if($result)
  {
$d=true;
  }
}
if($d)
{
  //$ins=true;
 // echo "insert ";
 echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>success!</strong> your comment is published
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}elseif($con==null)
{ 
  $tp=true;
 
}

if($tp)
{
  echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>failed!</strong> your comment is empty,please do comment.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
}
?>



 <div class="container my-3">
    <div class="jumbotron jumbotron-fluid container-fluid">
      <h1 class="display-4"> <?php echo $title ;?></h1>
      <p class="lead"><?php echo $desc?></p>
      <hr class="my-4">
      <p>this is peer to peer forum for sharing knowledge with each other.Please follow these guidelines to help keep this a friendly place: Be polite: Don’t post or private message anything which could be considered offensive, abusive, or hate speech.</p>
<p>posted by:<?php echo $posted_by?> <b></b></p>
    </div>
   </div>
<?php 
#form for comment.
if(isset($_SESSION['login']) && $_SESSION['login']==true)
{
  echo '
<div class="container">
<h1 class="py-3">Post a comment</h1>

<form action="'.$_SERVER["REQUEST_URI"].'" method="post">
       
<div class="form-floating my-2">
  <textarea class="form-control" placeholder="Leave a comment here" id="comment1" style="height: 100px" name="comment" minlength="8"></textarea>
  <label for="desc">Type your comment!</label>
</div>
      <button type="submit" name="submit" class="btn btn-success">Post comment</button>
    </form>
</div>';
}
else{
echo'<div class="container">
<h1 class="py-3">Post comment</h1>
<p class="lead">you are not logged in.please login to post your comment</p>
</div>
';
}

?>
   <div class="container ">
    <h1 class="py-3">
    <h1 class="py-3">Discussion</h1>

    </h1>
   </div>


    <?php
    
   $id=$_GET['threadid'];
   $sql="SELECT * FROM `comments` WHERE thread_id=$id";
   $result=mysqli_query($conn,$sql);
   $noresult=true;
   echo'    <div class="media my-3">
   <table id="myTable">
<thead>
    <tr>
        <th>Person</th>
        <th>Name</th>
        <th>Comment</th>
        <th>Date and Time</th>
    </tr>
</thead>
<tbody>
';
   while($row=mysqli_fetch_assoc($result))
   {
$noresult=false;
    $id=$row['comment_id'];
       $content=$row['comment_content'];
       $comment_time=$row['comment_time'];
       $comment_by=$row['comment_by'];
       $sql1="SELECT user_email FROM `users` WHERE sno=$comment_by";
      $result1=mysqli_query($conn,$sql1);
  $row1=mysqli_fetch_assoc($result1);
  
echo '
    <tr>
        <td><img src="https://tse1.mm.bing.net/th?id=OIP.ne2gc0vnnK8CH4r4AJNjFgAAAA&pid=Api&rs=1&c=1&qlt=95&w=111&h=111" width="40px" class="mr-3" alt="unsplash image"></td>
        <td>'.$row1['user_email'].'</td>
        <td> '.$content.'</td>
        <td>'.$comment_time.'</td>
    </tr>
';

   }
   echo'</tbody></table>';
   echo'</div>
   </div>';
   if ($noresult) {
    echo '<div class="jumbotron jumbotron-fluid my-2">
<div class="container">
  <p class="display-4">No comments Found</p>
  <p class="lead">Be the first person to comment...</p>
</div>
</div>';
  }
 
   ?>



  <?php include "partials/_footer.php";
  ?>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    
    <script>
     let table = new DataTable('#myTable');
    </script>
</body>

</html>