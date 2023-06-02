<?php
session_start();
if (!$_SESSION['username']){
    header('Location: ./librarylogin.php');
}
echo "Welcome Back, ".$_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>

    <style>

    *{
  font-family: monospace !important;
  font-size : large;
  font-weight: bold;
  transition:3s linear;
    }

    header {
			background-color: #1AB188;
			color: #fff;
			padding: 10px;
			text-align: center;
		}

		nav {
			background-color: #f2f2f2;
			padding: 10px;
		}

		nav ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
		}

		nav li {
			margin: 0 10px;
		}

		nav a {
			color: #333;
			text-decoration: none;
		}

		nav a:hover {
			text-decoration: underline;
		}
        form, .datatable {
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius:1rem;
 padding :1rem;
 width :80rem;
box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
 margin:auto;
 margin-top:2rem;
  }

 


  label {
    margin-top: 10px;
  }
  
  input {
    padding: 5px;
    border: 1px solid gray;
    border-radius: 5px;
    width:17rem;
    height:2rem;
    
  }
  
  .buttons {
    color: white;

    border: none;
    cursor: pointer;
    font-weight:bolder;
    width: 10rem;
    height:2rem;
    background-color: #1AB188;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }

  .datatable td, {
    border: 1px solid black;
    padding: 0.2rem;
    border-collapse:collapse;
width:8rem;
  }

  .searchtable{
    width:100%;
    margin-top: 2rem;
  }
  table {
  
  border-collapse: collapse;
  width: 100%;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #1AB188;
  color: white;
}


    </style>
</head>
<body>

<header>
		<h1>Library Database</h1>
	</header>

	<nav>
		<ul>
			<li><a href="#insert">Insert Book</a></li>
			<li><a href="#update">Update Book</a></li>
			<li><a href="#search">Search Books</a></li>
			<li><a href="#delete">Delete Book</a></li>
		</ul>
	</nav>

    
<a href="logout.php" >Log Out</a>
</form>

<div class = "datatable">
    <h2>Book List</h2>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>Year</th>
		</tr>
	</thead>
	<tbody>
		<?php
		 $conn = mysqli_connect("localhost", "root", "12345678", "library");
        $query = "SELECT * FROM book";
        $result = $conn->query($query);
		if ($result) {
		  while ($row = mysqli_fetch_assoc($result)) {
		    echo "<tr>";
		    echo "<td>{$row['book_id']}</td>";
		    echo "<td>{$row['title']}</td>";
		    echo "<td>{$row['author']}</td>";
		    echo "<td>{$row['publisher']}</td>";
		    echo "<td>{$row['year']}</td>";
		    echo "</tr>";
		  }
		}
		?>
	</tbody>
</table>
    </div>
	<form id = "insert" method="post">

	<h2>Insert Book</h2>

		<label>Title:</label>
		<input type="text" name="title" required>
		<br>
		<label>Author:</label>
		<input type="text" name="author" required>
		<br>

		<label>Publisher:</label>
		<input type="text" name="publisher" required>
		<br>
		<label>Year:</label>
		<input type="number" name="year" required>
		<br>
    
		<input class = "buttons" type="submit" name="insert" value="Insert Book">
	</form>


	<form id="delete" method="post">
    <h2>Delete Book</h2>
		<label>ID:</label>
		<input type="number" name="id" required>
		<br>
		<input class = "buttons" type="submit" name="delete" value="Delete Book">
	</form>

<form id = "search" method="post">
    
<h2>Search Books</h2>
	<label>Title:</label>
	<input type="text" name="title" required>
    <label>Year:</label>
	<input type="text" name="year" required>
	<br>
	<input type="submit" class ="buttons" name="search" value="Search">
        
    <div class = "searchtable">

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>Year</th>
		</tr>
	</thead>
	<tbody>
<?php
 $conn = mysqli_connect("localhost", "root", "12345678", "library");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {


  $title = $_POST['title'];
  $year = $_POST['year'];
  $sql = "SELECT * FROM book WHERE title ='$title' and year = $year";
  $result = $conn->query($sql);
      if ($result) {

        echo "Found books";
          while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>";
            echo "<td>{$row['book_id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>{$row['publisher']}</td>";
            echo "<td>{$row['year']}</td>";
            echo "</tr>";
          }
      
 }

else{
 echo "<div class = 'result'>Book Not Found</div>";
}


}


?>
	</tbody>
</table>
    </div>
</form>
<form id = "update" method="post">

<h2>Update Book</h2>
     <label>Book id:</label>
    <input type="text" name="id" required>
    <br>
    <h2>Insert the updated data below</h2>
    <label>Title:</label>
    <input type="text" name="title" required>
    <br>
    <label>Author:</label>
    <input type="text" name="author" required>
    <br>
    <label>Publisher:</label>
    <input type="text" name="publisher" required>
    <br>
    <label>Year:</label>
    <input type="number" name="year" required>
    <br>
    <input class = "buttons" type="submit" name="update" value="Update Book">
</form>
 
</body>
</html>
<?php
 $conn = mysqli_connect("localhost", "root", "12345678", "library");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {

    $title =$_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $query = "SELECT * FROM book WHERE title = '$title'";
    $result = $conn->query($query);
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO book (title, author, publisher, year) VALUES ('$title', '$author', '$publisher', '$year')";
        if (mysqli_query($conn, $sql)){
             echo "<div class = 'result'>Successfully Inserted</div>";
            
        }
    }
    else{
        echo "<div class = 'result'>Book Already exists</div>";
       }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
      $id = $_POST['id'];
      $sql = "DELETE FROM book WHERE book_id ='$id'";
      if (mysqli_query($conn, $sql)){
          echo "<div class = 'result'>Successfully Deleted</div>";
        
     }
    else{
     echo "<div class = 'result'>Book Not deleted</div>";
    }}


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $year = $_POST['year'];
        $sql = "UPDATE book SET title='$title', author='$author', publisher='$publisher', year='$year' WHERE book_id='$id'";
        if (mysqli_query($conn, $sql)){
            echo "<div class = 'result'>Successfully Updated</div>";
          
       }
      else{
       echo "<div class = 'result'>Book Not Updated</div>";
      }}
      
?>