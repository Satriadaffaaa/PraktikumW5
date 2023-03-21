<?php
include 'server/connection.php';
$id = $_GET['id'];

$conn = mysqli_connect("localhost", "root", "", "ecommerce");
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
while ($row = mysqli_fetch_array($result)) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <title>Edit</title>
    </head>

    <body>
        <div class="box">
            <div class="container">
                <div class="top">
                    <span>Edit</span>
                </div>
                <form action="editAction.php" method="POST">
                    <div class="input">
                        <label for="fname">ID</label><br>
                        <input type="text" id="fname" name="id" class="form-control" placeholder="id" readonly value="<?php echo $row['id'] ?>">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="input">
                        <label for="fname">Username</label><br>
                        <input type="text" id="fname" name="name" class="form-control" placeholder="name" value="<?php echo $row['name'] ?>">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="input">
                        <label for="fname">Email</label><br>
                        <input type="text" id="fname" name="email" class="form-control" placeholder="email" value="<?php echo $row['email'] ?>">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input">
                        <label for="fname">Password</label><br>
                        <input type="password" id="fname" name="password" class="form-control" placeholder="password" value="<?php echo $row['password'] ?>">
                        <i class="bx bx-key"></i>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary"> Save Edit </button>
                </form>
    </body>

    </html>
<?php
}

// Close the database connection
mysqli_close($conn);
?>