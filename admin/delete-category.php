<?php 

    include('../config/constants.php');
    
    if(isset($_GET['id']) && isset($_GET['image_name'])) {

        // STEPS TO FOLLOW 
        //  1. Get the ID and image of the selected item to be deleted from the datahbase
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "") {

            // Get the path of the image to be removed from the category folder
            $path = "../images/category/".$image_name;

            // Removing the image path
            $remove = unlink($path);

            // If Failed to remove then show an error message
            if($remove == false) {

                $_SESSION['remove'] = "<div class='error'> Failed to remove category </div>";
                header('location:'.SITEURL."admin/manage_category.php");
                // Stop the process
                die();

            }

        }
        // 2. Execute an sql query tha delete this item
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Data is Deleted
            // echo "<h1>Data has benn deleted succesfully</h1>";
            $_SESSION['delete'] = "<div class='success'> Succesfull deletion </div>";
            header("location:".SITEURL."admin/manage_category.php");
        }
        else
        {
            //Data is not Deleted (error)
            echo "<h1>Data hasn't been deleted yet 😈👿</h1>";
        }

        // use sessions to shows the succesfull messages and error messages

    } else {
        
        header('location:'.SITEURL.'admin/manage_category.php');

    }

?>