<?php include('partials/menu.php')?>

<!-- Manage Category section over here -->

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])) {

                echo $_SESSION['delete'];
                unset($_SESSION['delete']);

            }

            if(isset($_SESSION['remove'])) {

                echo $_SESSION['remove'];
                unset($_SESSION['remove']);

            }

        ?>

        <br><br><br>

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br><br><br>
        
      

        <table class="tbl_full">
                 <tr>
                     <th>#</th>
                     <th>Title</th>
                     <th>Image</th>
                     <th>Feature</th>
                     <th>Active</th>
                     <th>Actions</th>
                 </tr>
                
                <?php 
        
                    // Quering the DB
                    $sql = "SELECT * FROM tbl_category";

                    // Execute the category
                    $res = mysqli_query($conn, $sql);

                    // checking if query is executed with success
                    if($res == true) {

                        // Counting the number of rows in the table
                        $count = mysqli_num_rows($res);
                        
                        $sn = 1;

                        // Verifying if there's data in the DB
                        if($count > 0) {

                            // Fetch data from the database
                            while($row = mysqli_fetch_assoc($res)) {

                                // Assigning variables
                                $id = $row['id'];
                                $title = $row['title'];
                                $featured = $row['feature'];
                                $active = $row['active'];
                                $image_name = $row['image_name'];

                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            // check if image name is available
                                            if($image_name != "") {

                                                // Display Imaage
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="" width="100px" height="100px">

                                                <?php


                                            } else { echo "<div class = 'error'> Image not found</div>"; }
                                        ?>
                                        
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>/admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update category</a>
                                        <a href="<?php echo SITEURL;?>/admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete category</a>
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

<?php include('partials/footer.php')?>