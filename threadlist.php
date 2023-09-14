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
require "partials/_dbconnect.php" ;
if($_SERVER['REQUEST_METHOD'] === 'POST')
{     $id = $_GET['catid'];
$title=$_POST['title'];
$desc=$_POST['desc'];
$ins=false;
$t=false;
$p=false;
$tp=false;
$sno=$_SESSION["sno"];

$title=str_replace("<","&lt",$title);
$title=str_replace(">","&gt",$title);
$desc=str_replace(">","&gt",$desc);
$desc=str_replace("<","&lt",$desc);

if($title!=null && $desc!=null)
{
$sql="INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES (NULL, '$title', '$desc', '$id','$sno' , CURRENT_TIMESTAMP)";
$result=mysqli_query($conn,$sql);
if($result)
{
  $ins=true;
}
}
elseif($desc==null && $title==null){
  $tp=true;
  }
elseif($title==null)
{
 $t=true;
}elseif($desc==null)
{
$p=true;
}





  if($ins)
  {
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>success!</strong> your post is submitted thank you.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
elseif($tp)
{
  
  echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>failed!</strong> title and description is empty, please fill it out.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
elseif($t)
{
  echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>failed!</strong> title is empty, please fill it out.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
elseif($p)
{
  echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>failed!</strong> description is empty, please fill it out.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
}
  ?>
  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `forcoders` WHERE category_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $catname = $row['category_name'];
    $catdesc = $row['category_description'];
  }
  ?>
  
  <div class="container my-3">
    <div class="jumbotron jumbotron-fluid container-fluid">
      <h1 class="display-4"> Welcome to <?php echo $catname; ?> forum </h1>
      <p class="lead"><?php echo $catdesc ?></p>
      <hr class="my-4">
      <p>this is peer to peer forum for sharing knowledge with each other.Please follow these guidelines to help keep this a friendly place: Be polite: Don’t post or private message anything which could be considered offensive, abusive, or hate speech.</p>
      <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
    </div>
  </div>
<?php

if(isset($_SESSION['login']) && $_SESSION['login']==true)
{
  echo '
<div class="container">
<h1 class="py-3">Start discussion</h1>

<form action="'.$_SERVER["REQUEST_URI"].'" method="post">
      <div class="mb-3">
        <label for="title" class="form-label" >problem title</label>
        <input type="text" class="form-control" id="title1" aria-describedby="title" name="title" minlength="8">
        <div id="title" class="form-text">keep your title as short and crisp as possible</div>
      </div>
      <div class="form-floating my-2">
  <textarea class="form-control" placeholder="Leave a comment here" id="desc1" style="height: 100px" name="desc" minlength="15"></textarea>
  <label for="desc">Elaborate your concern!</label>
</div>
      <button type="submit" name="submit" class="btn btn-success">Post</button>
    </form>
    <h1>Browse question</h1>

</div>';
}
else{
echo '  <div class="container">
<h3 class="py-3">Start discussion</h3>
<p class="lead"> you are not logged in.please log in to start a discussion..</p>
<h1>Browse question</h1>

</div>
';
}

?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
echo'<table id="myTable">
<thead>
  <tr>
    <th>person</th>
    <th>Questions</th>
    <th>Description</th>
    <th>Questions asked by</th>
    <th>Date and Time</th>
</tr>
</thead>
<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
      $noresult = false;
      $id = $row['thread_id'];
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
     $time=$row['timestamp'];
     $uid=$row['thread_user_id'];
   $sql2="SELECT user_email FROM `users` WHERE sno='$uid'";
   $result2=mysqli_query($conn,$sql2);
   $row2=mysqli_fetch_assoc($result2);
   echo '<tr>
<td><img src="https://tse1.mm.bing.net/th?id=OIP.ne2gc0vnnK8CH4r4AJNjFgAAAA&pid=Api&rs=1&c=1&qlt=95&w=111&h=111" width="40px" class="mr-3" alt="unsplash image"></td>
<td><a href="thread.php?threadid=' . $id . '">' . $title . '</a></td>
<td>'. $desc . '</td>
<td>'.$row2['user_email'] .'at </td>
<td>'.$time.'</td>
</tr>
';}
echo'</tbody>
</table>
';


    if ($noresult) {
      echo '<div class="jumbotron jumbotron-fluid my-2">
  <div class="container">
    <p class="display-4">No Threads Found</p>
    <p class="lead">Be the first person to ask question.</p>
  </div>
</div>';
    }

    ?>

   

  </div>


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