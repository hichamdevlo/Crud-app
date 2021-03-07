<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/mystyle2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>
<?php 




  if(isset($_POST["add-new"]))
  {
    include "connexion.php";
    $book= $_POST["book_name"];
    $author= $_POST["author"];
    $active= $_POST["active"];

    if(empty($book) or empty($author))
    {
      $error="All fields required";
    }
    else
    {
      $stmt=$conn->prepare("INSERT INTO books (title,author,active) VALUES (?,?,?)");
      $stmt->Execute(array($book,$author,$active));
      $succes="Added Succesfully";

    }
  }
  
?>

<div>
<h1 class="title">My Books Script</h1>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php"> <i class="bi bi-house-fill"></i> Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="addnew.php"> <i class="bi bi-plus"></i> Add new</a>
        <a class="nav-link" href="showall.php"> <i class="bi bi-eye"></i> Show all</a>
      </div>
    </div>
  </div>
</nav>
</div>

<form class="myform" action="" method="POST">
  <?php
  if (isset($error)) 
  {
    echo "<div class='alert alert-danger' role='alert'>$error</div>";
  }
  if (isset($succes)) 
  {
    echo "<div class='alert alert-primary' role='alert'>$succes</div>";
  }
  ?>
  <div class="form-group">
    <label for="example">Book title*</label>
    <input type="text" name="book_name" class="form-control" id="example" placeholder="Enter book title">
  </div>
  <div class="form-group">
    <label for="exampleInput">Author name*</label>
    <input type="text" name="author" class="form-control" id="exampleInput" placeholder="Enter Author name">
  </div>
  <div>
    <label for="forselect">Status*</label>
  <select class="myselect" name="active" id="forselect">
      <option value="1">Active</option>
      <option value="0">Unactive</option>
    </select>
 </div>
  <button type="submit" name="add-new" class="btn btn-primary">Submit</button>
</form>




<script type="text/javascript" src="bootstrap/jquery.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
</body>
</html>

