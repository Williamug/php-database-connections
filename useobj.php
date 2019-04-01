
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MySqli Using Mysqli object</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<div class="container">
    <div align="center">
      <h3>Welcome to MySqliSampleApp!</h3>
      <h5>This project is designed to show you how to connect to a mysql database using MySqli object</h5>
    </div>
    <br>
<?php

define('HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mysqliobj');

$conn = new mysqli(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

// class Mysqli
// {
//     public $hostname;
//     public $username;
//     public $password;
//     public $dbname;

//     public function __construct($hostname, $username, $password, $dbname)
//     {
//         $this->hostname = $hostname;
//         $this->username = $username;
//         $this->password = $password;
//         $this->dbname = $dbname;
//     }

//     public static function connection($hostname, $username, $password, $databasename)
//     {
//         $sql = mysql_connect($hostname, $username, $password, $databasename);
//         return $sql;
//     }

// }

// $mydb = new Mysqli;
// $mydb->connection('localhost', 'root', '', 'mydb');

// Mysqli::connection('localhost', 'root', '', 'mydb');

if ($conn->connect_error) {
    die($conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['location'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $location = $_POST['location'];

        $query = "INSERT INTO list(name, email, location) VALUES('$name', '$email', '$location')";

        $result1 = $conn->query($query);

    } else {

        ?>

<body>
<br>
<div class="container">
    <br>
    <?php

        echo '<p></p><i align="" class="alert alert-danger">Please file in missing details.</i></p>';
    }
}
?>
      <form action="useobj.php" method="post">
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
$query = "SELECT * FROM list";
$results = $conn->query($query);

while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
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
$results->close();
$conn->close();
?>
</body>
</html>

