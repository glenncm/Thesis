<?php
//include database connector
session_start();

include '../dataBaseConn.php';

if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    header("Location: dashboard.php");
}

if(isset($_POST['username']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Get all the values of input and store in variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        header("Location: index.php?error=Username is required !");
        exit();
    }
    else if(empty($password)){
        header("Location: index.php?error=Password is required !");
        exit();
    }else{
        $check_username = mysqli_query($conn, "SELECT id, name, usertype, password, login, department FROM admins WHERE username='$username'");
        $row = mysqli_fetch_array($check_username);
        if ($row && password_verify($password, $row['password'])){
            if($row['login'] != 'yes'){
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['usertype'] = $row['usertype'];
                $_SESSION['department'] = $row['department'];
                $sql = mysqli_query($conn, "UPDATE admins SET login='yes' WHERE username='$username'");
                header("Location: dashboard.php");
                exit();
            }else{
                echo "<script>alert('Account already login by someone !')</script>";
            }
                
        } else {
            header("Location: index.php?error=Incorrect Username and password");
            exit();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../images/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body style ="background-color: #D3D3D3">
<div class="container-fluid">
        <!-- HEADER -->
         <div class="row">
            <div class="col-12">
                <?php include '../header.php'; ?>
            </div> 
         </div>
    <div class="container d-flex" style="height: 100vh;">
        <div class="row m-auto">
            <div class="text-center w-100">
                <img src="../images/nisu_logo.png" alt="logo" style="width: 80px;height:80px" class="m-0 p-0">
                <h3 class="p-0 m-0">Login</h3>
            </div>
            <div class="col-12">
                <form action="index.php" method="POST">
                <?php if(isset($_GET['error'])){?> <p class="error p-0 m-0 text-danger"> <?php echo $_GET['error']; ?> </p> <?php }?>
                    <label for="username" class="m-0 mt-2">Username</label>
                    <input class="form-control p-1" type="text" name="username" required>
                    <label for="username" class="m-0 mt-2">Password</label>
                    <input class="form-control p-1" type="text" name="password" required>
                    <input class="form-control mt-4 p-1 bg-primary text-white" type="submit" name="submit" value="Submit">
                    <p class="py-0 mt-2" style="font-size: 12px;">Forgot password? <a href="" onclick="forgotPassword()">Click here</a></p>
                </form>
            </div>
        </div>
    </div>

<script>
    function forgotPassword(){
        alert("Please contact NISU-TECH ADMIN ...")
    }
</script>
<div class="container-fluid">
        <!-- HEADER -->
         <div class="row">
            <div class="col-12">
                <?php include '../footer.php'; ?>
            </div> 
         </div>
</body>
</html>