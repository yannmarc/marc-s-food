<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add New Category</h1>

        <br><br>

        <?php 

            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table-30">
                <tr>
                    <td><label for="full_name">Title</label></td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <!-- <tr>
                    <td><label for="user_name">Image:</label></td>
                    <td><input type="text" name="user_name" placeholder="username"></td>
                </tr> -->

                <tr>
                    <td><label for="password">Feature :</label></td>
                    <td>
                        <input type="Radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" id="" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td><label for="password">Active :</label></td>
                    <td>
                        <input type="Radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" id="" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td><label for="password">Select Image :</label></td>
                    <td>
                        <input type="file" name="category-image">
                    </td>
                </tr>
                <br><br>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add category ends -->

        <?php
        
        // Check if the button has been clicke or not
        if(isset($_POST['submit'])) {

            // Processing the Form

            // 1. Get values from the form
            $title = $_POST['title'];

            // For radio input type we need to check the button is selected or not
            if(isset($_POST['featured'])) {
                // Get the value from the form 
                $featured = $_POST['featured'];
            } else {
                // Set a default value
                $featured = "No";
            }

            if(isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // // Check if image selected or not and set the value for image then
            // print_r($_FILES['category-image']);
            
            // die(); // Breaking the code to see the value of the file selected.

            if(isset($_FILES['category-image']['name'])) {
                
                // insert image if not image_name is not empty

                if ($image_name != "")
                {
                    
                
                    // Upload the image
                    // To upload image we need image_name, source_path & destination_path 
                    $image_name = $_FILES['category-image']['name'];

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
                }

            } else { $image_name = ""; }

            // 2. Insert the values into the database
            $sql = "INSERT INTO tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                feature = '$featured',
                active = '$active'
            ";

            // 3. Execute the Query
            $res = mysqli_query($conn, $sql);
            
            // 4. Check if data was inserted Succesfully or not
            if($res == true) {

                // Insert data
                $_SESSION['add'] = "<div class='success'> Category Added </div>";
                header('location:'.SITEURL. 'admin/manage_category.php');
            } else {
                $_SESSION['add'] = "<div class='succes'> Category Added </div>";
                header('location:'.SITEURL. 'admin/add-category.php');
            }
        } 
        
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>

