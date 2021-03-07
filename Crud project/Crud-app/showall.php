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

include "connexion.php";
$stmt=$conn->prepare("SELECT id,title,author FROM books WHERE active=1");
$stmt->execute();
$count=$stmt->rowcount();
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

<?php

if($count>0)
{

?>	
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
<?php
  while ($row=$stmt->fetch()) 
  {
  	echo"
    <tr>
      <td>".$row["id"]."</td>
      <td>".$row["title"]."</td>
      <td>".$row["author"]."</td>
    </tr>";
  }

	
    
}
else
{
	echo "<div class='alert alert-danger' role='alert'>No active books available</div>";
}
?>




  </tbody>
</table>



<script type="text/javascript" src="bootstrap/jquery.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
</body>
</html>