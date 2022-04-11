<?php include('partials/menu.php')?>

    <!-- TODO Admin Module 
        1Design add and display admin pages
        2Connect Database
        3Add Admin to database
        4Display all admins from database
    -->
    
     <!-- Main content section goes here -->
     <div class="main-content">
         <div class="wrapper">
             <h1>Manage Admin</h1>
             <br> <br>

             <!-- Adding the session over here -->
             <?php 
                if(isset($_SESSION['add'])){

                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
             
                if(isset($_SESSION['delete'])){

                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['error']))
                {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['Update_success']))
                {
                    echo $_SESSION['Update_success'];
                    unset($_SESSION['Update_success']);
                }
                
                if(isset($_SESSION['Update_failed']))
                {
                    echo $_SESSION['Update_failed'];
                    unset($_SESSION['Update_failed']);
                }

                if(isset($_SESSION['pass_not_found']))
                {
                    echo $_SESSION['pass_not_found'];
                    unset($_SESSION['pass_not_found']);
                }
             ?>

             <br><br><br>
            <!-- Add Admin button -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br> <br> <br>
             <table class="tbl_full">
                 <tr>
                     <th>#</th>
                     <th>Full Name</th>
                     <th>username</th>
                     <th>Actions</th>
                 </tr>
                <!-- Open the PHP code that displays the data -->
                <?php
                    // Creating a query variable that connect to database
                    $sql = "SELECT * FROM tbl_admin";

                    // Executing the query
                    $res = mysqli_query($conn, $sql);

                    $sn = 1; //custom incrementation of the id mode;
                    // code that's responsible for checking the if the query is executed
                    if($res == TRUE)
                    {
                        // counting the number of rows in the database
                        $count = mysqli_num_rows($res);
                        // check the number of rows
                        if($count > 0){

                            // We have data in the database
                            while($rows = mysqli_fetch_assoc($res)){

                                // Using the while loop because it runs as long as there is data in the database
                                
                                // Get the data individually
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $user_name = $rows['user_name'];

                                ?>

                                 
                                <tr>
                                    <td> <?php echo $sn++; ?> </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $user_name; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/change_password.php?id=<?php echo $id;?>" class="btn-primary">Change password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                        }
                       
                    }
                   
                ?>
             </table>

             


         </div>
     </div>
    <!-- Main content section ends here -->

     <?php include('partials/footer.php')?>