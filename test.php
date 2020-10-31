<?php
    session_start();

    //To display the session username
    echo "<h1 style='text-align: center; color: red'> Hello ".$_SESSION['userdata']['username']."</h1>";
?>

<?php
    function display_question()
    {
        if(isset($_GET['action']))
        {
            $subject = $_GET['action'];
        }
        
        include('config.php');
        $query = mysqli_query($connect, "SELECT * FROM add_ques WHERE subject_name = '$subject'");

        echo '<h3 style="color: blue";> Each Question is of 1 Mark </h3>';

        echo "<table border=0 id='display_question'>";
            foreach($query as $row)
            {  
                echo "<tr style='font-size: 30px;'>
                    <td> <span>".$row['que_desc'].":</span> </td><br>

                    <td> <input type='radio' name='option' value='1'> </td>
                    <td> <label for='option'>".$row['ans1']."</label><br></td>

                    <td> <input type='radio' name='option' value='2'> </td>
                    <td> <label for='option'>".$row['ans2']."</label><br></td>

                    <td> <input type='radio' name='option' value='3'> </td>
                    <td> <label for='option'>".$row['ans3']."</label><br></td>

                    <td> <input type='radio' name='option' value='4'> </td>
                    <td> <label for='option'>".$row['ans4']."</label><br></td>
                <tr>";
            }
        echo"</table>";
    }
?>

<html>
    <head>
        <title>Login</title>
        <h2 style="text-align: center">Welcome to Online Quiz,</h2>
        <h3 style="text-align: center">Please Select Topic to start the quiz</h3>
    </head>

    <!-- <form action="" method="POST">
        <p>
            <input type="submit" name="login" value="Logout">
        </p>
    </form> -->

    <strong><a href="logout.php" id="logout">Logout Now<a></strong>
    
    <body>
        <?php display_question(); ?>
    </body>
</html>