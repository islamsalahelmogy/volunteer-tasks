<?php

    session_start();
    include('config.php');
    if (isset($_POST['updatetask'])) {
        $name = $_POST['name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $status=$_POST['status'];
        $description=$_POST['description'];
        $task_id=$_SERVER['QUERY_STRING'];
        
          if($end_date>$start_date){
            $query = $connection->prepare("UPDATE task SET name=:name,start_date=:start_date, end_date=:end_date, status=:status
               ,description=:description WHERE id=:task_id");
              $query->bindParam(":name", $name, PDO::PARAM_STR);
              $query->bindParam(":start_date", $start_date, PDO::PARAM_STR);
              $query->bindParam(":end_date", $end_date, PDO::PARAM_STR);
              $query->bindParam(":status", $status, PDO::PARAM_STR);
              $query->bindParam(":description", $description, PDO::PARAM_STR);
              $query->bindParam(":task_id", $task_id, PDO::PARAM_INT);
              $result = $query->execute();
              if ($result) {
                $_SESSION['message']=' <p class="success">Task Updated successfully!</p>';
                header('location: task.php ');
              } else {
                $message='<p class="error">Something went wrong!</p>';
              }

          }
          else{
            $messag_date='<p class="error">Start Date must before End Date wrong!</p>';
          }
              

          }
        

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <link href="assets/images/logo.png" rel="short icon">

    <title> Managing Volunteer Tasks </title>



    

    <!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/fontawesome.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/chat.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" >
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Dashboard</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
</header>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2">
    <?php
           include('sidebar.php');
      ?>
    </div>
    
    <div class="col-sm-4 offset-sm-3">
      <h3 class=" text-center my-4">Update Task</h3>

     
      <form name="createtask" action="" method="post" class="">
                    <div class="form-group">
                      <input type="name" name="name" class="form-control searchText" id="name" aria-describedby="" placeholder="Task name" require>
                      
                    </div>
                    
                    <div class="form-group">
                      <lable for="start_date"> Start Date</lable>
                      <input type="date" name="start_date" class="form-control searchText" id="start_date" aria-describedby="" placeholder="Start Date" require>
                      
                    </div>

                    <div class="form-group">
                      <lable for="end_date"> End Date</lable>
                      <input type="date" name="end_date" class="form-control searchText" id="end_date" aria-describedby="" placeholder="End Date" require>
                      
                    </div>

                    <?php 
                    if(isset($messag_date))
                    {
                      echo($messag_date);
                    }
                    ?>
                    <div class="form-group">
                      <input type="text" name="description" class="form-control searchText" id="description" aria-describedby="" placeholder="Description">
                      
                    </div>

                    <div class="form-group row ">
                        <div class="col-sm-4 offset-sm-4" >
                             <input id="still" type="radio" name="status" value="still" > <lable  for="still" style="padding-right:15px;">Still</lable>
                             <input id="done" type="radio" name="status" value="done" checked> <lable for="done">Done</lable>
                        </div>
                    
                    </div>
                    
                    
                    <div class="form-group row">

                    <div class="col-sm-4 offset-sm-4" >
                      <button type="submit" name="updatetask" class="btn btn-success form-control"><a class="text-light">Update</a></button>
                      <?php

                            if(isset($message))
                            {
                            echo($message);
                            }  
                      
                      ?>
                    </div>


                    
                  </form>


      

    </div>
    </div>

  </div>
  

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="assets/js/dashboard.js"></script>
  </body>
</html>
