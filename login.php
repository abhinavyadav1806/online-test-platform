<?php
    session_start();
    include("config.php");
    $error = array();

    if(isset($_POST['login']))
    {
        $role = isset($_POST['role']) ? ($_POST['role']) : '';
        $username = isset($_POST['username']) ? ($_POST['username']) : '';
        $password = isset($_POST['password']) ? ($_POST['password']) : '';
        
        if(sizeof($error) == 0)
        {
            $sql = "SELECT * FROM user WHERE `role` = '".$role."' AND `username` = '".$username."' AND `password` = '".$password."' ";
            $result = mysqli_query($connect,$sql);

            if ($result ->num_rows > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    // CREATED SESSION
                    $_SESSION['userdata'] = array('user id'=>$row['id'], 'role'=>$row['role'], 'username'=>$row['username'], 'password'=>$row['password'], 'email'=>$row['email']);

                    if($_SESSION['userdata']['role'] == 'admin')
                    {
                        header("Location: Admin/admin.php");
                    }  
                    else
                    {
                        header('Location: showtest.php'); 
                    } 
                }
            } 
            else 
            {
                $error[] = array('input' => 'form' , 'msg' => 'INVALID LOGIN DETAILS');
            }
            $connect->close();
        }
    }
?>

<html>
    <head>
        <title>Login</title>
        <h1 style="text-align: center">Welcome to Online Quiz,</h1>
        <h3 style="text-align: center">Select your role as a customer and login to your ID</h3>
    </head>

    <body>
        <div id="error">
            <ul>
                <?php
                    if (sizeof($error) > 0)
                    {
                       foreach($error as $errors)
                       {
                           echo "<li>";
                               echo $errors['msg'];
                           echo "</li>";
                       }
                    }  
               ?>
            </ul>
        </div>
    </body>

    <form action="" method="POST">
        <p>
            <label for="role">Role</label> <select name="role" required><option value="customer">Customer</option> <option value="admin">Admin</option></select>
        </p>
        <p>
            <label for="username">Username: <input type="text" name="username" required></label>
        </p>
        <p>
            <label for="password">Password: <input type="password" name="password" required></label>
        </p>
        <p>
            <a style="color: red" type="submit" href="register.php">New User? SignUp Free</a>
        </p>
        <p>
            <input type="submit" name="login" value="Login">
        </p>
    </form>
</html>