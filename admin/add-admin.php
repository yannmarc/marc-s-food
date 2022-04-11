<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add New Admin</h1>
        
        <form action="" method="POST">
            <table class="table-30">
                <tr>
                    <td><label for="full_name">Full Name</label></td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td><label for="user_name">User Name:</label></td>
                    <td><input type="text" name="user_name" placeholder="username"></td>
                </tr>

                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" placeholder="password"></td>
                </tr>
                <br><br>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary btn-add">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php')?>

<?php 
    //Process the value from Form and Save it in Database
    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Processing our Form 
        
        // 1. get the Data from the form
       $full_name = $_POST['full_name'];
       $user_name = $_POST['user_name'];
       $password = md5($_POST['password']); // Encrypting the password over here

        //2. SQL Query to save the data to the database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            user_name = '$user_name',
            password = '$password'
            ";
        echo $sql;

        // 3. Executing the query and check if connection is done succesfully
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Display succesfull messages for adding new admins and errors messages for unseccusfull operations
        if($res == true){
            // Creating a session variable that holds the success message
            // Contain also a redirect page found in a header function
            $_SESSION['add'] = "New Admin added successfully";
            header("location:". SITEURL . "admin/manage_admin.php");
        }
        else
        {
            $_SESSION['add'] = "Error in submiting the form added successfully";
            header("location:". SITEURL . "admin/add-admin.php");  
        }
        
    
    }
?>