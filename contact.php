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
  include"partials/_dbconnect.php";
  require "partials/_header.php"; ?>

  <?php
  if($_SERVER['REQUEST_METHOD'] === 'POST')
{
       $name=$_POST['name'];
       $add=$_POST['address'];
       $no=$_POST['no'];
       $email=$_POST['email'];
       $user=$_POST['username'];
       $pass=$_POST['password'];
          
         $sql="INSERT INTO `contact_us` (`cno`, `cname`, `caddress`, `c_phone_no`, `email`, `username`, `password`, `datetime`) VALUES (NULL, '$name', ' $add', '$no', ' $email', '$user', ' $pass', CURRENT_TIMESTAMP)";
       $result=mysqli_query($conn,$sql);
       if($result)
       {
       echo ' <div class="alert alert-success alert-dismissible fade show my-0" role="alert ">
        <strong>success</strong> your data has been submitted successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
       }
      

}
  
  ?>
<form action="contact.php" method="post">
  
  <div class="container my-3" style="padding-left:100px;padding-right:100px;padding-bottom:100px;padding-top:20px;">
  <h1 class="text-center">Contact us</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Your Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
  </div>

  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Your Address</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address"></textarea>
</div>

<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Your mobile no.</label>
    <input type="tel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="no">
  </div>
  

<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Your Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">username</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="username">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  

  <button type="submit" class="btn btn-success">Submit</button>
  <button type="reset" class="btn btn-success">Reset</button>
  
  </div>
</form>

<?php include "partials/_footer.php";
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>