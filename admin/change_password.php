<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Your Password</h1>
            <br><br>
            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];

                }
                
            ?>
            <form action="" method="POST">
                <table class="table-30">
                    <tr>
                        <td>Old Password:</td>
                        <td><input type="password" name="old_password" id=""></td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="new_password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>"> 
                            <input type="submit" value="Change password" class="btn-secondary btn-add" name="submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<!-- Changing the password implementation overhere -->
<?php 

   if(isset($_POST['submit']))
   {

    // Get the data from the form
    $id = $_POST['id'];
    $old_password = md5($_POST['old_password']);
    $new_password = md5($_POST['new_password']);
    $current_password = md5($_POST['current_password']);
    //  check if there is data in the database
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password='$old_password'";

    $res = mysqli_query($conn, $sql);
    
    if($res == true)
    {
        $count = mysqli_num_rows($res);
        
        if($count == 1)
        {
            $sql_2 = "UPDATE tbl_admin SET
            password = '$current_password'
            WHERE id = $id
            ";

            $res_2 = mysqli_query($conn, $sql_2);

            if($res_2 == true)
            {
                $_SESSION['Update_success'] = "<div class='success'>Password changed successfully</div>";
                header("location:".SITEURL."admin/manage_admin.php");
            }
            else
            {
                $_SESSION['Update_failed'] = "<div class='error'>Failure to change the Password";
            }
        }
        else{
            $_SESSION['pass_not_found'] = "<div class='error'> User don't exist in the database</div>";
            header("location:".SITEURL."admin/manage_admin.php");
        }
    }
    // 527bd5b5d689e2c32ae974c6229ff785
    
   }

?>
<?php include('partials/footer.php')?>