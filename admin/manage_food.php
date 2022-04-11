<?php include('partials/menu.php')?>

<!-- Manage Category section over here -->

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br><br><br>

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br><br><br>

        <table class="tbl_full">
                 <tr>
                     <th>#</th>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Price</th>
                     <th>Image Name</th>
                     <th>Category Id</th>
                     <th>Feature</th>
                     <th>Active</th>
                     <th>Actions</th>
                 </tr>

                 <?php
                    // Get all the elements of the food table

                    // Create the sql statement to query the database
                    $sql =  "SELECT * FROM tbl_food";
                    // Execute the query
                    $res = mysqli_query($conn, $sql);
                    // Check if the query has been executed
                    if($res == true) 
                    {
                        // Get all the rows from the database
                        $rowCount = mysqli_num_rows($res);
                        $sn = 1;
                        $categoryId = 1;
                        // Check if there is data in the database
                        if($rowCount > 0)
                        {
                            // Fetch the data from the database
                            while($row = mysqli_fetch_assoc($res))
                            {

                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category_id = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                <tr>
                                    <td> <?php echo $sn++; ?> </td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <p><?php echo $description; ?></p>
                                    </td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php
                                            if($image_name != "")
                                            {
                                                // We display the image
                                                ?>
                                                <img src="../images/foods/<?php $image_name?>" width="100" height="100">

                                                <?php
                                            }
                                            else {
                                               echo "<div class='error'>
                                                Image not found
                                                </div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $category_id++; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id?>&image-name=<?php echo $image_name;?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id; ?>&image-name=<?php echo $image_name;?>" class="btn-danger">Delete Admin</a>
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