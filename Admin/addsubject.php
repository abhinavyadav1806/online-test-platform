<?php
    include("../config.php");
    $error = array();

    if(isset($_POST['addsubject']))
    {
        $subname = isset($_POST['subname']) ? ($_POST['subname']) : "";

        $sql = "SELECT * FROM add_subject";
        $result = mysqli_query($connect,$sql);
        
        if($result->num_rows > 0 )
        {
            while($row=$result->fetch_assoc())
			{
                // CREATED SESSION
                $_SESSION['subject'] = array('subjectname'=>$row['subjectname']);
                
				if($_SESSION['subject']['subjectname'] == $subname)
				{
					$error[]=array('msg'=>"Subject Already Exists..!");
				}
			}
        }

        if(sizeof($error) == 0)
        {
            $sql = "INSERT INTO add_subject(`subjectname`) VALUES('$subname')";

            if($connect ->query($sql) === TRUE)
            {
                $error[] = array("msg"=>"New Subject Added Successfully");
            }
            else
            {
                $error[] = array('input' => 'form' , 'msg' => $connect->error);
            }  
            $connect->close();
        }
    }
?>

<html>
    <head>
        <title>Add Subject</title>
        <h2 style="text-align: center;"> Add Subject </h2>
    </head>

    <body>
        <form action="#" method="POST">
            <p>
                <label> <b>Enter Subject Name:</label>
                <input type="text" name="subname" placeholder="Enter Subject Name">
            </p>
            <p>
                <input type="submit" name="addsubject" value="Add Subject">
            </p>
            <p>
                <a href="addquestion.php?subject=<?php echo $subname; ?>">Add Question</a>
            </p>
        </form>

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
</html>