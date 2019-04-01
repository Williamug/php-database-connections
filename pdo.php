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
<div class="container">
    <div align="center">
      <h3>Welcome to MySqliSampleApp!</h3>
      <h5>This project is designed to show you how to connect to a database using PDO</h5>
    </div>
<form action="pdo.php" method="post">
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
<?php
// database variables
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pdo';

try {
// set DSN - data source name
    //$dns = 'mysql:host=localhost;dbname=pdo';
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    //create a pdo instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $sql = "INSERT INTO list(name, email, location)VALUES(?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $location]);

// echo "posted";
}
$sqlselect = "SELECT * FROM list";
$stmt = $pdo->prepare($sqlselect);
$stmt->execute();
$lists = $stmt->fetchAll();

//var_dump($lists);
?>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php
foreach ($lists as $list) {
    ?>
<div class="container">
  <table class="table">
    <tbody>
      <tr>
        <td><?php echo $list->name; ?></td>
        <td><?php echo $list->email; ?></td>
        <td><?php echo $list->location; ?></td>
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
?>

</body>
</html>
