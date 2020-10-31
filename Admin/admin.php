<?php
    session_start();

    // To display the logged in username 
    echo "<h1 style='text-align: center; color: red'> Hello ".$_SESSION['userdata']['username']."</h1>";
    echo "<h2 style='text-align: center'>Welcome to the Admin Panel </h2>";

    echo "<a href='../logout.php' style='font-size: 20px; color: red;'> Click to Logout <a>";
?>

<!-- function to display the subjects name -->
<?php
    function display_subject()
    {
        include("../config.php");
        $query = mysqli_query($connect, "SELECT * FROM add_subject");

        echo '<h3> List of all the Subject in Database </h3>
        <table id="table" border="1">
        <tr>
            <th>ID</th>
            <th>NAME</th>
        </tr>';

        foreach($query as $row)
        {
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['subjectname'] . "</td>";
            echo "</tr>";
        }
        echo '</table>';
    }
?>

<!-- function to display the users -->
<?php
    function display_user()
    {
        include("../config.php");
        $query = mysqli_query($connect, "SELECT * FROM user");

        echo '<h3> List of all the Subject in Database </h3>
        <table id="table" border="2">
        <tr>
            <th>ID</th>
            <th>ROLE</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>EMAIL</th>
        </tr>';

        foreach($query as $row)
        {
            echo "<tr>";
                echo "<td>" . $row['user id'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        echo '</table>';
    }
?>

<html>
    <div id="menu">
        <nav>
            <ul id="menu-links">
                <li><a href="addsubject.php">Add Subject</a></li>
                <li><a href="addquestion.php">Add Question</a></li>
            </ul>
        </nav>
    </div>

    <div> 
        <?php display_subject();  display_user(); ?>
    </div>
</html>