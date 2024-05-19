<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Login - Bakery System</title>
        
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class='login'>
            <br /><br />
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!------Login Form starts here------>
            <form action="" method="POST" class="text-center container">
                <h1>Login</h1><br>
                <label for="username"><b>User Name</b></label>
                <input type="text" name="username" placeholder="Enter username"><br><br />
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" placeholder="Enter password"><br><br />
                <input type="submit" name="submit" value="Login"  class="btn"><br /><br />
            </form>
            <!------Login Form ends here----->
        </div>

    </body>
</html>

<?php
    // check whether submit button is clicked or not
    if(isset($_POST["submit"]))
    {
        //process for login
        //1.Get data from login
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //2.SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3.Execute the query
        $res = mysqli_query($conn,$sql);

        //4.Count rows to check whether user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login success
            $_SESSION['login']="<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username;//to check whether user is logged in or not and logout will unset it
            //redirect to home page
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available and login fail
            $_SESSION['login']="<div class='error text-center'>Login Failed.</div>";
            //redirect to home page
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>