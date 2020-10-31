<?php
    include("config.php");
    $error = array();

    if(isset($_POST['signup']))
    {
        $role = isset($_POST['role']) ? ($_POST['role']) : '';
        $username = isset($_POST['username']) ? ($_POST['username']) : ''; 
        $password = isset($_POST['password']) ? ($_POST['password']) : ''; 
        $repassword = isset($_POST['password2']) ? ($_POST['password2']) : ''; 
        $email = isset($_POST['email']) ? ($_POST['email']) : ''; 
       
        if($password != $repassword)
        {
            $error[] = array('input' => 'password', 'msg' => 'PASSWORD DONT MATCH');
        }

        $sql = "SELECT * FROM user "; 
        $result= mysqli_query($connect,$sql);
        if($result->num_rows > 0)
		{
			while($row=$result->fetch_assoc())
			{
                $_SESSION['user']=array('username'=>$row['username'],'email'=>$row['email']);
                
				if($_SESSION['user']['username'] == $username)
				{
					$error[]=array('input'=>'username','msg'=>"Enter Unique USERNAME");
				}
				if($_SESSION['user']['email'] == $email)
				{
					$error[]=array('input'=>'email','msg'=>"Enter Unique EMAIL");
				}
			}
		}

        if(sizeof($error) == 0)
        {
            $insert = "INSERT INTO user(`role`, `username`, `password` , `email`) VALUES('$role', '$username', '$password', '$email')";

            if($connect ->query($insert) === TRUE)
            {
                //echo "New Record Added Successfully";
                header("Location: login.php");
            }
            else
            {
                $error[] = array('input' => 'form' , 'msg' => $connect->error);
                //echo "Error: " .$insert. "<br>" . $connect->error;
            }  
            $connect->close();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
</head>
<body>
   <div id="wrapper">
        <div id="signup-form">
            <div id="error">
                <ul>
                    <?php if (sizeof($error) > 0)
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
            
            <h2>Sign Up</h2>
            <form action="" method="POST">
                <p>
                    <label for="role">Role</label> <select name="role" required><option value="customer">Customer</option> <option value="admin">Admin</option></select>
                </p>
                <p>
                    <label for="username">Username:<input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password:<input type="password" name="password" required></label>
                </p>
                <p>
                    <label for="password2">Re-Password:<input type="password" name="password2" required></label>
                </p>
                <p>
                    <label for="email">Email:<input type="email" name="email" required></label>
                </p>
                <p>
                    <input type="submit" name="signup" value="SignUp">
                </p>
            </form>   
        </div>
    </div>
</body>
</html>