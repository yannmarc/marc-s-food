<?php include('partials/menu.php')?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br><br>
            <!-- creating the table section for updates -->
            <?php 
                // 1. Get the id of selected data
                $id = $_GET['id'];
                // Create a SQL query for accessing this data 
                $sql = "SELECT * FROM tbl_admin WHERE id = $id";
                // Execute the query
                $res = mysqli_query($conn, $sql);
                // checking if the query has been executed
                if($res == true)
                {
                    echo "Success awaits my friend 😁";

                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        $row = mysqli_fetch_assoc($res);
                        
                        echo $full_name = $row['full_name'];
                        echo $user_name = $row['user_name'];
                    }
                }
                else
                {
                    echo "Error Please review your code";
                    header("location:". SITEURL. "admin/manage_admin.php");
                }
            ?>
            <form action="" method="POST">
                <table class=table-30>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="full_name" placehoder="Update Name" value="<?php echo $full_name; ?>"></td>
                    </tr>
                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="user_name" placehoder="Update Name" value="<?php echo $user_name; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name ="submit" value="Update Admin" class="btn-secondary btn-add">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>


    <?php 
    
        if(isset($_POST['submit']))
        {
            // echo "Button Clicked";
            // Get all the values from form to update them 
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];

            // Create a sql query to update admin
            $sql2 = "UPDATE tbl_admin SET
            full_name = '$full_name',
            user_name = '$user_name'
            WHERE id = '$id'
            ";
            echo $sql;

            $res = mysqli_query($conn, $sql2);

            if($res == true)
            {
                header("location:". SITEURL. "admin/manage_admin.php");
            }
        }

    ?>
<?php include('partials/footer.php')?>



