<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />

        <?php

            if(isset($_SESSION['add']))
            {
               echo $_SESSION['add'];//Displaying Session Message
               unset($_SESSION['add']);//Removing Session Message
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>
                <tr>
                    <td>UserName: </td>
                    <td><input type="text" name="username" placeholder="Enter your User Name"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
//Process the value from form and save it in database
//Check whether submit button is clicked or not
 if(isset($_POST['submit']))
 {
    //Button Clicked
    //echo "Button Clicked";

    //Getting data from form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']); //Encrypting password

     //SQl Query to Save data into database
     $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        username = '$username',
        password = '$password'     
     ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //Check whether data is inserted or not and display appropriate message
    if($res==True)
    {
        //Data inserted
        //echo "Data Inserted";
        //Create a session variable to display message
        $_SESSION['add'] ="<div class='success'>Admin  Added Successfully.</div>";
        //Redirect Page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //Data not inserted
        //echo "Data Not Inserted";
        $_SESSION['add'] ="Failed To Add Admin.";
        //Redirect Page to add-admin
        header('location:'.SITEURL.'admin/add-admin.php');
    }
 }
 
?>