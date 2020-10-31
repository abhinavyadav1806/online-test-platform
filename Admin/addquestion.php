<?php
    session_start();
    include('../config.php');
    if(isset($_GET['subject'])) 
    {
        $subject=$_GET['subject'];
    }
    
        $addque = isset($_POST['addques']) ? ($_POST['addques']) : '';
        $ans1 = isset($_POST['ans1']) ? ($_POST['ans1']) : '';
        $ans2 = isset($_POST['ans2']) ? ($_POST['ans2']) : '';
        $ans3 = isset($_POST['ans3']) ? ($_POST['ans3']) : '';
        $ans4 = isset($_POST['ans4']) ? ($_POST['ans4']) : '';
        $anstrue = isset($_POST['trueans']) ? ($_POST['trueans']) : '';

        if(isset($_POST['submit']))
        {
            $sql = "INSERT INTO add_ques(que_desc, ans1, ans2, ans3, ans4, true_ans, subject_name) VALUES('$addque','$ans1','$ans2','$ans3','$ans4','$anstrue', '$subject')";

            if($connect ->query($sql) === TRUE)
            {
                echo "added";
            }

            $qid = $connect->insert_id;
            $sql="INSERT INTO `add_trueans`(`test_id`, `trueans`) VALUES ('$qid','$anstrue')";
            $res=$connect->query($sql);
        }
    ?>

<html>
<h1>Add Question</h1>
<div>
        <form action="" method="POST">
            <p>
                <strong> Enter Question: </strong>
                <textarea name="addques" cols="60" rows="2"></textarea>
            </p>

            <p>
                <strong>Enter Answer1</strong>
                <input name="ans1" type="text" size="85" maxlength="85">
            </p>

            <p>
                <strong>Enter Answer2</strong></td>
                <input name="ans2" type="text" size="85" maxlength="85">
            </p>

            <p>
                <strong>Enter Answer3</strong></td>
                <input name="ans3" type="text" size="85" maxlength="85">
            </p>

            <p>
                <strong>Enter Answer4</strong></td>
                <input name="ans4" type="text" size="85" maxlength="85">
            </p>

            <p>
                <strong>Enter True Answer</strong></td>
                <input name="trueans" type="text" size="50" maxlength="50">
            </p>

            <p>
                <input class="btn btn-primary" type="submit" name="submit" value="Add Question" >
            </p>
        </form>
    </div>
        
</html>