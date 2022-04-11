<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

        ?>

        <?php
            $id = $_GET['id'];

            // Create an sql statement to fetch the data
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            // excuting the sql statement
            $res = mysqli_query($conn, $sql);

            if($res == true) 
            {
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $id = $row['id'];
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['feature'];
                    $active = $row['active'];
                }
            }
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-30">
                <tr>
                    <td><label for="full_name">Title</label></td>
                    <td><input type="text" name="title" placeholder="Category Title" value="<?php echo $title ?>"></td>
                </tr>

                <!-- <tr>
                    <td><label for="user_name">Image:</label></td>
                    <td><input type="text" name="user_name" placeholder="username"></td>
                </tr> -->

                <tr>
                    <td><label>Feature :</label></td>
                    <td>
                        <input <?php if($featured == "Yes") { echo "checked"; }; ?> type="Radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") { echo "checked"; };?> type="radio" name="featured" id="" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td><label for="password">Active :</label></td>
                    <td>
                        <input <?php if($active == "Yes") { echo "checked"; };?> type="Radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No") { echo "checked"; };?> type="radio" name="active" id="" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td><label for="password">Current Image :</label></td>
                    <td>
                        
                        <?php
                            if($current_image != "") 
                            {
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>">
                                <?php
                                
                            } else { echo "<div class='error'> Image not fount </div>"; }
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td><label for="New-image">New Image:</label></td>
                    <td>
                        <input type="file" name="category-image">
                    </td>
                </tr>
                <tr></tr>
                <br><br>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add category ends -->

        <?php 
            // Processing the form (submit btn)
            if(isset($_POST['submit']))
            {
                // Get the updated values
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Update the new image if selected 

                if(isset($_FILES['category-image']['name']))
                {
                    // Get the image details
                    $image_name = $_FILES['category-image']['name'];
                    // Check if the image is available
                    if($image_name != "")
                    {
                        // Image available
                        // Upload the new image

                        // Auto rename our image
                        // 1. Get the extension of our image
                        $ext = end(explode('.', $image_name));

                        // 2. Renaming the file
                        $image_name = "Food_category_".rand(000, 999). '.'.$ext;

                        $source_path = $_FILES['category-image']['tmp_name'];
                        $destination_path = "../images/category/". $image_name;

                        // Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check if image is uploaded
                        if($upload == false) {

                            $_SESSION['upload'] = "<div class='error'> Failed to upload Image </div>";
                            // Redirecting
                            header('location:'. SITEURL. 'admin/add-category.php');
                            // Stop the process
                            die();

                        }

                        // Remove the current image
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);

                        // check wether if image is removed or not
                        if($remove == false)
                        {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the Image </div>";
                            header("Location:" .SITEURL. "admin/add-category.php");
                        }
                    }
                    else 
                    {
                        $image_name = $current_image;
                    }
                }
                else 
                {
                    $image_name = $current_image;
                }

                // Update the database
                // create an sql statement for the update
                $sql2 = "UPDATE tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                feature = '$featured',
                active = '$active'
                WHERE id = '$id'
                ";

                // execute the query
                $res = mysqli_query($conn, $sql2);

                // check if the query execution went well
                if($res == true) {
                    // Load a session
                    $_SESSION['add'] = "<div class='success'>Category Updated Successfully</div>";
                    header("location:" .SITEURL. "admin/manage_category.php");
                } 
                else { echo "error"; }
            }
        ?>
        
    </div>
</div>

<?php include('partials/footer.php')?>

