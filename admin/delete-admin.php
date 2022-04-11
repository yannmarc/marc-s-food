<?php 

    include('../config/constants.php');
    // STEPS TO FOLLOW 
    //  1. Get the ID of the selected item to be deleted from the datahbase
        $id = $_GET['id'];
    // 2. Execute an sql query tha delete this item
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        //Data is Deleted
        // echo "<h1>Data has benn deleted succesfully</h1>";
        $_SESSION['delete'] = "Succesfull deletion";
        header("location:".SITEURL."admin/manage_admin.php");
    }
    else
    {
        //Data is not Deleted (error)
        echo "<h1>Data hasn't been deleted yet 😈👿</h1>";
    }

    // use sessions to shows the succesfull messages and error messages

?>