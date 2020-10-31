<?php
    session_start();

    //To display the session username
    echo "<h1 style='text-align: center; color: red'> Hello ".$_SESSION['userdata']['username']."</h1>";
?>

<?php
    function display_subject()
    {
        include('config.php');
        $query = mysqli_query($connect, "SELECT * FROM add_subject");

        echo "<table border=0 id='display_question'>";
            foreach($query as $row)
            {  
                echo "<tr style='font-size: 20px;'>
                    <td> <span>".$row['subjectname']."</span> </td><br>
                    <td> <a href='test.php?action=".$row['subjectname']."'>Take Test</a> </td>
                <tr>";
            }
        echo"</table>";
    }
?>

<html>
    <head>
        <title>Login</title>
        <h2 style="text-align: center">Welcome to Online Quiz,</h2>
        <h3 style="text-align: center">Please Select Subject to start the quiz</h3>
    </head>


    <strong><a href="logout.php" id="logout">Logout Now<a></strong>
    
    <body>
        <?php  display_subject(); ?>
    </body>
</html>