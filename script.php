<?php
date_default_timezone_set("Africa/Lagos");
require("conn.php");


// CODE FOR TASK INSERT
if(isset($_POST['createtask'])){
	$task = $_POST['task'];
	$taskduedate = $_POST['task_date'];
    
    $insert = $conn->prepare('INSERT INTO task (task_name, task_due_date, task_status) VALUES (:task, :taskduedate, 0)');
    $insert->execute(array('task'=> $task,'taskduedate'=> $taskduedate));

    if($insert){
        $error = '<p>Task posted successfully</p>';
        header('Location: index.php');
    } else {
        $error = "<p style='color: red;'>Task Not Posted</p>";
    }
}


// PULL TASK FROM DATABASE
$pulldata = $conn->prepare("SELECT * FROM task");
$pulldata->execute();


//---------------------------------------------------------------------
// DELETE TASK
if (isset($_GET['delete_id'])) {
    $delid = $_GET['delete_id'];
    $delete = $conn->prepare('DELETE FROM task WHERE task_id=:id');
    $delete->execute(array('id'=> $delid));

    if($delete){
        $error = '<p>Task Deleted Successfully</p>';
        header('Location: index.php');
    } else {
        $error = "<p style='color: red;'>Task Not Deleted, Try Again</p>";
    }
}

//---------------------------------------------------------------------
// UPDATE TASK
if (isset($_POST['update_task'])) {
    $taskid = $_POST['task_id'];
    $taskname = $_POST['task_name'];
    $taskduedate = $_POST['task_due_date'];

    $updatetask = $conn->prepare('UPDATE task SET task_name = :taskname, task_due_date = :taskduedate WHERE task_id = :taskid');
    $updatetask->execute(array('taskid'=> $taskid,'taskduedate'=> $taskduedate, 'taskname'=> $taskname));

    if($updatetask){
        $error = '<p>Task Updated Successfully</p>';
        header('Location: index.php');
    } else {
        $error = "<p style='color: red;'>Task Not Updated, Try Again</p>";
    }
}


//---------------------------------------------------------------------
// TASK COMPLETED
if (isset($_GET['comp_id'])) {
    $compid = $_GET['comp_id'];
    $taskstatus = 1;
    $taskcomp = $conn->prepare('UPDATE task SET task_status = 1 WHERE task_id = :taskid');
    $taskcomp->execute(array('taskid'=> $compid));

    if($taskcomp){
        $error = '<p>Task Completed Successfully</p>';
        header('Location: index.php');
    } else {
        $error = "<p style='color: red;'>Task Not Completed, Try Again</p>";
    }
}
?>