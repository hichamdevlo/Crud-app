
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
include "connexion.php";

if(isset($_POST["edit"]))
{
	$id=intval($_GET["id"]);
	$title=$_POST["title"];
	$author=$_POST["author"];
    
    $stmt=$conn->prepare("UPDATE books SET title=?,author=? WHERE id=?");
    $stmt->execute(array($title,$author,$id));
    header("location:dashboard.php");

}

if(isset($_GET["box"])){
	if($_GET["box"]=="active")
	{
		$id=intval($_GET["id"]);
		$stmt=$conn->prepare("UPDATE books SET active=1 WHERE id=?");
		$stmt->execute(array($id));
		header("location:dashboard.php");
	}
	elseif ($_GET["box"]=="unactive") 
	{
		$id=intval($_GET["id"]);
		$stmt=$conn->prepare("UPDATE books SET active=0 WHERE id=?");
		$stmt->execute(array($id));
		header("location:dashboard.php");
	}
	elseif ($_GET["box"]=="delete") 
	{
		$id=intval($_GET["id"]);
		$stmt=$conn->prepare("DELETE FROM books WHERE id=?");
		$stmt->execute(array($id));
		header("location:dashboard.php");
	}
	elseif ($_GET["box"]=="edit") 
	{
		$id=intval($_GET["id"]);
		$stmt=$conn->prepare("SELECT* FROM books WHERE id=?");
		$stmt->execute(array($id));
		$row=$stmt->fetch();

		?>

		<form class="myform" action="" method="POST">
		<div class="form-group">
        <label for="example">Book title*</label>
        <input type="text" name="title" value="<?php echo($row['title'])?>" class="form-control" id="example" placeholder="Enter book title">
        </div>
        <div class="form-group">
        <label for="exampleInput">Author name*</label>
        <input type="text" name="author" value="<?php echo($row['author'])?>" class="form-control" id="exampleInput" placeholder="Enter Author name">
        </div>
        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
        </form>

        <?php
		
	}
}
else
{
$stmt=$conn->prepare("SELECT * FROM books ORDER BY id");
$stmt->execute();
$count=$stmt->rowcount();
if($count>0){
?>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Id</th>
	      <th scope="col">Title</th>
	      <th scope="col">Author</th>
	      <th scope="col">Change Status</th>
	      <th scope="col">Edit || Delete</th>
	    </tr>
	  </thead>
	  <tbody>
	 <?php
	 while ($row=$stmt->fetch()) 
	 	{
	 		if($row["active"]==0)
	 		{
	 			echo"
		    <tr>
		      <td>".$row["id"]."</td>
		      <td>".$row["title"]."</td>
		      <td>".$row["author"]."</td>
		      <td><a href='dashboard.php?box=active&id={$row["id"]}'>Active</a></td>
		      <td><a href='dashboard.php?box=edit&id={$row["id"]}'>Edit</a> ||
		       <a href='dashboard.php?box=delete&id={$row["id"]}'>Delete</a></td>
		    </tr>";
	 		}
	 		elseif ($row["active"]==1) 
	 		{
	 			echo"
		    <tr>
		      <td>".$row["id"]."</td>
		      <td>".$row["title"]."</td>
		      <td>".$row["author"]."</td>
		      <td><a href='dashboard.php?box=unactive&id={$row["id"]}'>Unactive</a></td>
		      <td><a href='dashboard.php?box=edit&id={$row["id"]}'>Edit</a> ||
		       <a href='dashboard.php?box=delete&id={$row["id"]}'>Delete</a></td>
		    </tr>";
	 		}
	 	
		  	
	  	}
		
	?>    

	  </tbody>
	</table>


	<?php
	}
	else
		{
			echo "<div class='alert alert-danger' role='alert'>No data available</div>";
		}
}
	?>	

<script type="text/javascript" src="bootstrap/jquery.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
</body>
</html>
