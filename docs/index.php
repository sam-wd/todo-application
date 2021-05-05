<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "todo");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}	
	if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: index.php');
}
?>


<html>
<head>
	<title>
		
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
	 .lefti {
             position: absolute;
  left: 0px;
  width: 150px;
  
  padding: 10px;
  height:100%;
  background-color: orange;
        }
        .righty {
           
  position: absolute;
  right: 0px;
  width: 150px;
 
  padding: 10px;
    height:100%;
     background-color: orange;

        }
        .marq
        {
        	text-align: center;
        	font-family: papyrus;
        	font-weight: bold;
        	font-size: 40px;
        	border: 6px solid lightblue;
  border-radius: 8px;

        }
             .center {
           
  position: absolute;
  right: 0px;
  left:0px;
  width: 150px;
 
  padding: 10px;
    height:100%;
    
 }
 .center {
  margin: auto;
  width: 50%;
  padding: 10px;
  background-color: orange;
  border: 6px solid lightblue;
  border-radius: 8px;

}
table
{
	font-family: "Comic Sans MS", "Comic Sans", cursive;
	
	font-weight:bolder;
	text-align: center;

}
table th,tr:hover
{
	text-align: center;
	background-color: lightpink ;


}
input[type=text] {
  border: 6px solid lightblue;
  border-radius: 8px;
  padding: 20px 28px;
  font-family: "Comic Sans MS", "Comic Sans", cursive;
}
button[type=submit] {
background-color: orange;
  border: 6px solid lightblue;
  border-radius: 8px;
  font-weight:bolder;
  
  font-family: "Comic Sans MS", "Comic Sans", cursive;
}
button[type=submit]:hover {
	background-color: yellowgreen;}
body
{
	background-image: url("flower.jpg");
	background-position: top;
	background-repeat: no-repeat;
	background-color: lightblue;
	background-size: 100%; 
}
form
{
	border: 6px solid lightblue;
  border-radius: 8px;
}
.glow {
  font-size: 80px;
  color: #fff;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
}


       

</style>




</head>
<body>
	<div class="container">
  <div class="lefti"  >

<marquee direction="up" class="marq" height="100%" scrollamount="20" loop="infinite" > M<br>O<br>N<br>D<br>A<br>Y<br><br><br>T<br>U<br>E<br>S<br>D<br>A<br>Y<br><br><br> W<br>E<br>D<br>N<br>E<br>S<br>D<br>A<br>Y<br><br><br>T<br>H<br>U<br>R<br>S<br>D<br>A<br>Y </marquee>

  </div>

  <div class="righty" >
 

<marquee direction="up" class="marq" height="100%" scrollamount="20" loop="infinite" > T<br>H<br>U<br>R<br>S<br>D<br>A<br>Y<br><br><br> F<br>R<br>I<br>D<br>A<br>Y<br><br><br> S<br>A<br>T<br>U<br>R<br>D<br>A<br>Y<br><br><br> S<br>U<br>N<br>D<br>A<br>Y<br><br><br> </marquee>
  
  </div>
  <br><br><br><br>
<br><br><br><br><br><br><br>
<div class="center" style="overflow-x:auto;">
<h2 class="glow" style="font-family: Brush Script MT;" >Enter your task</h1>
	<form method="post" action="index.php" class="input_form">
		<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>


		<input type="text" name="task" class="task_input"><br><br>
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

	<table style="width: 100%;">
	<thead>
		<h3 class="glow" style="font-family: Brush Script MT;" >To do list</h1>
		<tr>
			<th style="color:darkblue;text-align: center;">Task number</th>
			<th style="color:darkblue;text-align: center;">Tasks</th>
			<th style="color:darkblue;text-align: center;">Delete task</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>



</div>
  <!-- <div class="row"> 
  <div class="col-6 col-md-4" style="background-color: pink;">.col-6 .col-md-4</div>
  <div class="col-6 col-md-4">.col-6 .col-md-4</div>
  <div class="col-6 col-md-4">.col-6 .col-md-4</div>
 </div> -->
</div>






	</body>
	</html>
