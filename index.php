<?php
date_default_timezone_set("Africa/Lagos");
require("script.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    
</head>

<body>

    <main>
        <div class="container-lg pt-5">
            <div class="row min-vh-100">
                <div class="col align-self-center">
                    <div class="row">
						<h1 class="mb-5 text-center">To Do List</h1>
                        <?php if (isset($error)) echo $error; else echo ""; ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mb-5">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="task" id="formId1" placeholder="" required />
                                        <label for="formId1">Task</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control" name="task_date" id="formId1" placeholder="" required />
                                        <label for="formId1">Task</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 align-self-center">
                                    <button type="submit" class="btn btn-primary" name="createtask"> Create Task </button>
                                </div>
                            </div>
                        </form>
                        <div class="d-grid gap-2 col-lg-4 mx-auto">
                            <button class="btn btn-success mb-5" id="reloadButton">Reload Page</button>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col">
                            <table id="reloadableContent">
                                <tr>
                                    <th><h4>#</h4></th>
                                    <th><h4>Task</h4></th>
                                    <th><h4>Status</h4></th>
                                    <th><h4>Due Date</h4></th>
                                    <th><h4>Action</h4></th>
                                </tr>
                                </tr>
                                <?php
                                while ($row = $pulldata->fetch(PDO::FETCH_OBJ)): {
                                ?>
                                <tr>
                                    <td><?php echo $row->task_id; ?></td>
                                    <td><?php echo $row->task_name; ?></td>
                                    <td>
                                        <?php
                                        if ($row->task_status == 0) {
											$date1 = $row->task_due_date;
											$date2 = date("Y-m-d h:i:s a", time());
											
                                            if ($date1 > $date2) {
                                                echo "Pending";
                                            } else {
                                                echo "Overdue";
                                            }
                                        } else {
                                            echo "Completed";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $dateString = $row->task_due_date;
                                        // Create a DateTime object from the string
                                        $dateTime = new DateTime($dateString);
                                        // Format the DateTime object
                                        $formattedDate = $dateTime->format('F d, Y h:i a');
                                        echo $formattedDate; // Output: January 30, 2024 06:59 pm
                                        ?>
                                    </td>
                                    <td>                                     
                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row->task_id; ?>">Delete</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $row->task_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Task</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Are you sure you want to delete the task?</h5>
                                                        <p><?php echo $row->task_name; ?></p>
                                                        <p>
                                                            <?php
                                                            $dateString = $row->task_due_date;
                                                            // Create a DateTime object from the string
                                                            $dateTime = new DateTime($dateString);
                                                            // Format the DateTime object
                                                            $formattedDate = $dateTime->format('F d, Y h:i a');
                                                            echo $formattedDate; // Output: January 30, 2024 06:59 pm
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-secondary" data-bs-dismiss="modal">No</a>
                                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?delete_id=<?php echo $row->task_id; ?>" class="btn btn-primary">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $row->task_id; ?>" <?php if($row->task_status == 1){ echo 'disabled'; } else { echo ''; } ?>>Edit</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="EditModal<?php echo $row->task_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Task</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3 needs-validation" validate action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                                                            <input type="hidden" value="<?php echo $row->task_id; ?>" name="task_id">
                                                          <div class="col-lg-12">
                                                            <label for="validationCustom01" class="form-label">Task</label>
                                                            <input type="text" class="form-control" id="validationCustom01" value="<?php echo $row->task_name; ?>" name="task_name" required>
                                                            <div class="valid-feedback">
                                                              Looks good!
                                                            </div>
                                                          </div>
                                                          <div class="col-lg-12 mb-5">
                                                            <label for="validationCustom05" class="form-label">Due Date</label>
                                                            <input type="datetime-local" class="form-control" id="validationCustom05" value="<?php echo $row->task_due_date; ?>" name="task_due_date" required>
                                                            <div class="invalid-feedback">
                                                              Please provide a valid zip.
                                                            </div>
                                                          </div>
                                                          <button type="submit" class="btn btn-primary" name="update_task">Update Task</button>
                                                          
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#CompleteModal<?php echo $row->task_id; ?>" <?php if($row->task_status == 1){ echo 'disabled'; } else { echo ''; } ?>>Completed</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="CompleteModal<?php echo $row->task_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="exampleModalLabel">Task Completed</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Are you sure the task is Completed?</h5>
                                                        <p><?php echo $row->task_name; ?></p>
                                                        <p>
                                                            <?php
                                                            $dateString = $row->task_due_date;
                                                            // Create a DateTime object from the string
                                                            $dateTime = new DateTime($dateString);
                                                            // Format the DateTime object
                                                            $formattedDate = $dateTime->format('F d, Y h:i a');
                                                            echo $formattedDate; // Output: January 30, 2024 06:59 pm
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-secondary" data-bs-dismiss="modal">No</a>
                                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?comp_id=<?php echo $row->task_id; ?>" class="btn btn-primary">Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } endwhile ?>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer></footer>
    <script src="main.js"></script>
    <script>
        // Function to reload the page
        function reloadPage() {
            location.reload();
        }
        // Attach the reloadPage function to the button click event
        document.getElementById('reloadButton').addEventListener('click', reloadPage);
    </script>
</body>

</html>