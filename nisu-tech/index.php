<?php
// INCLUDE DATABASE CONNECTOR
include '../dataBaseConn.php';
if(isset($_POST['submit'])){
    //Get all the values of input and store in variables
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $usertype = $_POST['usertype'];
    $department = $_POST['department'];

    if(empty($name)){
        header("Location: index.php?errorName=Name is required !");
        exit();
    }
    else if(empty($username)){
      
        header("Location: index.php?errorUsername=Username is required !");
        exit();
    }
    else if(empty($password)){
        header("Location: index.php?errorPassword=Password is required !");
        exit();
    }
    else if(strlen($password) < 8){
        header("Location: index.php?errorPasswordLength=Password must be 8-63 characters !");
        exit();
    }
    else if($usertype == 'none'){
        header("Location: index.php?errorUsertype=Usertype type is required !");
        exit();
    }else if($department == 'none'){
        header("Location: index.php?errordepartment=Department type is required !");
        exit();
    }else{
        $sql = "SELECT * FROM admins WHERE name = '$name' AND username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >= 1) {
            echo "<script>alert('Name or username already exists !')</script>";
        }else{
            // Insert data to database
            $INSERT = "INSERT INTO admins (name, username, password, usertype, department, login) VALUES ('$name', '$username', '$password', '$usertype', '$department', 'no')";
            // INSERTION
            $query = mysqli_query($conn, $INSERT);
            // Condition if success and error happens
            if($query){
                echo "<script>alert('DATA ADDED')</script>";
            }else{
                echo "<script>alert('Please try again')</script>";
            }
        }        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NISU-TECH</title>
    <link rel="shortcut icon" href="../images/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body style = "background-color: #DCDCDC">
<div class="container-fluid">
        <!-- HEADER -->
         <div class="row">
            <div class="col-12">
                <?php include '../header.php'; ?>
            </div> 
         </div>
 <!-- Note: Please add required and data checking of inputs -->
    <div class="container d-flex" style="height: 100vh;">
        <div class="row  m-auto">
        <h3 class="mx-auto">Add admin</h3>
            <div class="col-12">
                <form action="index.php" method="POST">
                    
                    <label for="name" class="m-0 mt-2">Name</label>
                    <input class="form-control p-1" type="text" name="name" style="text-transform: capitalize;"  required>
                    <?php if(isset($_GET['errorName'])){?> <p class="error p-0 m-0 text-danger"> <?php echo $_GET['errorName']; ?> </p> <?php }?>
                    <label for="username" class="m-0 mt-1">Username</label>
                    <input class="form-control p-1" type="text" name="username" required>
                    <?php if(isset($_GET['errorUsername'])){?> <p class="error p-0 m-0 text-danger"><?php echo $_GET['errorUsername'];?></p><?php }?>
                    <label for="username" class="m-0 mt-2">Password</label>
                    <input class="form-control p-1" type="text" name="password" required>
                    <?php if(isset($_GET['errorPassword'])){?> <p class="error p-0 m-0 text-danger"><?php echo $_GET['errorPassword'];?></p><?php }?>
                    <?php if(isset($_GET['errorPasswordLength'])){?> <p class="error p-0 m-0 text-danger"><?php echo $_GET['errorPasswordLength'];?></p><?php }?>
                    <select name="usertype" class="form-control mt-4 p-0">
                        <option value="none">Select Admin Type</option>
                        <option value="Superadmin">Superadmin</option>
                        <option value="Admin">Admin</option>
                    </select>
                    <?php if(isset($_GET['errorUsertype'])){?> <p class="error p-0 m-0 text-danger"><?php echo $_GET['errorUsertype'];?></p><?php }?>
                    <select name="department" class="form-control mt-4 p-0">
                        <option value="none">Select Client Type</option>
                        <option value="OSAS(OFFICE OF STUDENT AND ACADEMIC AFFAIRS)">OSAS(OFFICE OF STUDENT AND ACADEMIC AFFAIRS)</option>
                                <option value="CASHIER OFFICE">CASHIER OFFICE</option>
                                <option value="REGISTRAR OFFICE">REGISTRAR OFFICE</option>
                                <option value="RECORDS OFFICE">RECORDS OFFICE</option>
                                <option value="PROCUREMENT OFFICE">PROCUREMENT OFFICE</option>
                                <option value="LIBRARY">LIBRARY</option>
                                <option value="CLINIC OR HEALTH SERVICES">CLINIC OR HEALTH SERVICES</option>
                                <option value="RESEARCH AND DEVELOPMENT OFFICE">RESEARCH AND DEVELOPMENT OFFICE</option>
                                <option value="RESEARCH EXTENSION AND SCIENTIFIC PUBLICATION">RESEARCH EXTENSION AND SCIENTIFIC PUBLICATION</option>
                                <option value="VPAF(VICE PRESIDENT FOR ADMINISTRATION AND FINANCE)">VPAF(VICE PRESIDENT FOR ADMINISTRATION AND FINANCE)</option>
                                <option value="VPRE(VICE PRESIDENT FOR RESEARCH AND EXTENSION)">VPRE(VICE PRESIDENT FOR RESEARCH AND EXTENSION)</option>
                                <option value="KMITT">KMITT</option>
                                <option value="Superadmin">Superadmin</option>
                    </select>
                    <?php if(isset($_GET['errordepartment'])){?> <p class="error p-0 m-0 text-danger"><?php echo $_GET['errordepartment'];?></p><?php }?>
                    <input class="form-control mt-4 p-1 bg-primary text-white" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- HEADER -->
         <div class="row">
            <div class="col-12">
                <?php include '../footer.php'; ?>
            </div> 
         </div>
</body>
</html>