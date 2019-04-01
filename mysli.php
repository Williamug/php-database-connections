<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MySqli Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
<br>
  <div class="container">
    <div align="center">
      <h3>Welcome to MySqliSampleApp!</h3>
      <h5>This project is designed to show you how to connect to a mysql database</h5>
    </div>
      <form action="mysli.php" method="post">
      <!-- Name -->
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Please enter your name</small>
        </div>

        <!-- email -->
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Please enter your Email</small>
        </div>

        <!-- Location -->
        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" name="location" id="location" class="form-control" placeholder="" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Please enter your Location</small>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
<br>
<?php
// form processing
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'mysqlitest';

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn) {
    //echo "database connected";
} else {
    echo "error connection to database";
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    //echo "My name is " . $name . " and my email is " . $email . " and I live in " . $location;

    $query = "INSERT INTO list(name, email, location) VALUES('$name', '$email', '$location')";

    mysqli_query($conn, $query) or die("error quering database");

}?>


<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Location</th>
        <th>Action</th>
      </tr>
    </thead>
  </table>
</div>
<?php
$query2 = "SELECT * FROM list";
$result = mysqli_query($conn, $query2);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $location = $row['location'];
        ?>
<div class="container">
  <table class="table">
    <tbody>
      <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $location; ?></td>
        <td>
          <button type="button" name="" id="" class="btn btn-success" btn-lg btn-block">Edit</button>
          <a name="" id="" class="btn btn-danger" href="#" role="button">Delete</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<?php
}
}
?>

</body>
</html>
