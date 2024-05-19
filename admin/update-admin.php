<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br /><br />
        <?php
         //1.Get ID of selected admin
         $id = $_GET['id'];

         //2.Create SQL query to get details
         $sql = "SELECT * FROM tbl_admin WHERE id=$id";

         //3.Execute Query
         $res = mysqli_query($conn,$sql);

         //Check whether query is executed or not
         if($res==True)
         {
            //Check whether data is available or not
             $count = mysqli_num_rows($res);
             //check whether we have admin data or not
             if($count == 1)
             {
                //get the details
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
             }
             else
             {
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
             }
         }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>UserName: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

</div>
</div>
<?php 
//Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "Button Clicked";
    //Get all values from Form to update
     $id = $_POST['id'];
     $full_name = $_POST['full_name'];
     $username  = $_POST['username'];

     //Create a SQL query to update Admin
     $sql = "UPDATE tbl_admin SET
     full_name = '$full_name',
     username = '$username'
     WHERE id='$id';
     ";

     //Execute the Query
     $res = mysqli_query($conn,$sql);

     //Check if query is executed successfully or not
     if($res==True)
     {
        //Query executed and Admin Updated
        $_SESSION['update']="<div class='success'>Admin Updated Successfully,</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
     }
     else
     {
        //Failed to Update Admin
        $_SESSION['update']="<div class='error'>Failed to Update Admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
     }
}
?>
<?php include('partials/footer.php'); ?>