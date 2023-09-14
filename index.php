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
  <!--slider-->
  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://media.istockphoto.com/id/1452604857/photo/businessman-touching-the-brain-working-of-artificial-intelligence-automation-predictive.webp?b=1&s=170667a&w=0&k=20&c=iJp6e2C-l2lRmyG3ColHMpXe0QYrPnrfQQc2O6PsYC4=" class="d-block w-100" alt="coders" style="height:60vh;">
      </div>
      <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1562813733-b31f71025d54?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGNvZGluZ3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=700&q=60" class="d-block w-100" alt="code" style="height:60vh;">
      </div>
      <div class="carousel-item">
        <img src="https://media.istockphoto.com/id/1442946345/photo/software-source-code-programming-code-programming-code-on-computer-screen-developer-working.webp?b=1&s=170667a&w=0&k=20&c=Dgxt0LsK0hkrf1pk4ZdmUPWeFHgjl50JLnipRtrFrR8=" class="d-block w-100" alt="coders" style="height:60vh;">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <div class="container my-3">
    <h3 class="text-center">welcome in forum for coders - Browse categories</h3>
    <!--card row-->
    <div class="row my-3">
      <!--fetch all category-->
     <?php 
     
     $sql="SELECT * FROM `forcoders`";
     $result = mysqli_query($conn,$sql);
     while($row=mysqli_fetch_assoc($result))
     {     //echo $row['category_id']
           //echo $row['category_name'];
           $id=$row['category_id'];
           
           echo ' <div class="col-md-4">
           <div class="card my-2" style="width: 18rem;">
             <img src="https://images.unsplash.com/photo-1587620931276-d97f425f62b9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fHByb2dyYW1taW5nJTIwbGFuZ3VhZ2V8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=400&q=60">
             <div class="card-body">
               <h5 class="card-title"> <a href="threadlist.php?catid='.$id.'">'.$row['category_name'].'</a></h5>
               <p class="card-text">'.substr($row['category_description'],0,90).'...'.'</p>
               <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">view threads</a>
             </div>
           </div>
         </div>
   
   
   
       ';
     }
     ?>

    </div>
  </div>


  <?php include "partials/_footer.php";
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>