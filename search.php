<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum for coders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <?php
  require "partials/_header.php"; 
  require "partials/_dbconnect.php";?>
 
   <div class="container my-3 py-3">
 <h1> search result for <?php echo $_GET['search'];?></h1>
 <?php
$query=$_GET["search"];
  $sql="SELECT * FROM threads WHERE MATCH (thread_title,thread_desc) against ('$query')";


 $result=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_assoc($result))
 {
      $title=$row['thread_title'];
      $desc=$row['thread_desc'];
      $thread_id=$row['thread_id'];
      $url="thread.php?threadid=". $thread_id;
      echo' <div class="result">
      <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
  <p>'.$desc.'</p>
   </div>';
   exit();
 }
echo '
 <div class="jumbotron jumbotron-fluid my-2" >
<div class="container">
  <p class="display-4"><u>No results Found</u></p>
  <p class="lead">We did not find results for:'.$query.'</p><br>
  <h4><i>Check spelling or type a new query...</i>
  </h4>
</div>
</div>
';
 
?>

   </div>     
   
  
  <?php include "partials/_footer.php";?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>