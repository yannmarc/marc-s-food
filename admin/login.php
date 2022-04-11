<?php include('../config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Marc's Food</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <?php 
        if(isset($_SESSION['Failed']))
        {
            echo $_SESSION['Failed'];
            unset($_SESSION['Failed']);
        }
    ?>
    <div class="main-content full-height">
        <div class="wrapper flex">
            <div class="login">
                <h1>LOGIN</h1>
                <form action="" method="POST">
                    <table class="login-details">
                        <tr>
                            <td>User Name </td>
                            <td><input type="text" name="user_name"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="login" name="submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <?php  
    
    if(isset($_POST['submit']))
    {
        // Get the data from the form
        $user_name = $_POST['user_name'];
        $password = md5( $_POST['password']);
        
        // Checking if the data exist in the database
        $sql = "SELECT * FROM tbl_admin WHERE user_name= '$user_name' AND password= '$password'";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $count = mysqli_num_rows($res);
            
            if($count == 1)
            {
                $_SESSION['login'] = "<div class='success'>Loged in successfully mr: <strong>$user_name</strong></div>";
                header("location:".SITEURL."admin/");
            }
            else
            {
                $_SESSION['Failed'] = "<div class='error'> Error Username or Password Not correct</div>";
                header("location:".SITEURL."admin/login.php");
            }
        }
    }
    
    ?>
</body>
</html>