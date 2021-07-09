<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Sheduler</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">

    <style>
        body {
            padding: 30px;
        }

        .background-grey {
            background-color: #f6f6f6;
        }
    </style>
</head>

<body>
    <div class="card">
       <div class="card-body"> 
            <div class="row">
                <div class="col">
                    <h1 class="mx-auto text-center">Schedule Management</h1>
                    <h5 style="text-align:center">Manage Your Daily Schedules</h5>
                    <a href="view.php" class="btn btn-primary mt-3" style="margin-left: 15px;">View Schedule</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-4">
                        <div class="card-body" style="background:#e5e5e5">
                            <form class="cb1" action="" method="post" width="408.5px">
                                <div class="col-md-4">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" name="date"><br>
                                </div>
                                <div class="col-md-4">
                                    <label for="start_time" class="form-label">From (Time)</label>
                                    <input type="time" class="form-control" name="start_time"><br>
                                </div>
                                <div class="col-md-4">
                                    <label for="end_time" class="form-label">To (Time)</label>
                                    <input type="time" class="form-control" name="end_time"><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="comment" class="form-label">Comment/s</label>
                                    <textarea name="comment" class="form-control" id="comment" rows="3" placeholder="Enter comment..."></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mt-3" style=" background:#0F8BFF;margin-bottom: 10px;margin-left: 10px;">Create Schedule</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4" style="height:95%">
                        <div class="card-body" style="background:#e5e5e5">
                        
                            <!-- PHP SCRIPT FOR INSERTING -->
                            <?php
                            $server = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "task_scheduler";

                            $conn = mysqli_connect($server, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection to database failed due to " . $conn->connect_error);
                            }

                            if (isset($_POST['submit'])) {
                                $date = $_POST['date'];
                                $start_time = $_POST['start_time'];
                                $end_time = $_POST['end_time'];
                                $comment = $_POST['comment'];
                                $start_time2 = strtotime($start_time);
                                $end_time2 = strtotime($end_time);


                                if ($start_time2 >= $end_time2) {
                            ?>
                                    <div class="alert alert-danger" role="alert">
                                        Please Enter Correct Details Properly.
                                    </div>
                                    <?php
                                    die();
                                }

                                // Retrive Code
                                $flag = 0;
                                $sql1 = "select * from task_scheduler where date = '$date'";
                                if ($result = $conn->query($sql1)) {
                                    while ($row = $result->fetch_assoc()) {



                                        $start_time1 = strtotime($row['start_time']);
                                        $end_time1 = strtotime($row['end_time']);

                                        if (($start_time2 > $start_time1) && ($end_time2 < $end_time1)) {
                                            // Check time is in between start and end time
                                            // echo "1 Time is in between start and end time <br><br>";
                                            $flag = 1;
                                            break;
                                        } elseif (($start_time2 > $start_time1 && $start_time2 < $end_time1) || ($end_time2 > $start_time1 && $end_time2 < $end_time1)) {
                                            // Check start or end time is in between start and end time
                                            //echo "2 ChK start or end Time is in between start and end time <br><br>";
                                            $flag = 1;
                                            break;
                                        } elseif ($start_time2 == $start_time1 || $end_time2 == $end_time1) {
                                            // Check start or end time is at the border of start and end time
                                            //echo "3 ChK start or end Time is at the border of start and end time <br><br>";
                                            $flag = 1;
                                            break;
                                        } elseif ($start_time1 > $start_time2 && $end_time1 < $end_time2) {
                                            // start and end time is in between  the check start and end time.
                                            //echo "4 start and end Time is overlapping  chk start and end time <br><br>";
                                            $flag = 1;
                                            break;
                                        } else {
                                            $flag = 0;
                                        }
                                    }
                                }

                                if ($flag == 0) {
                                    // Insertion Code
                                    $sql = "INSERT INTO `task_scheduler` (`date`,`start_time`, `end_time`, `comment`) VALUES ('$date','$start_time', '$end_time', '$comment')";
                                    if ($conn->query($sql) === TRUE) {
                                    ?>
                                        <div class="alert alert-success" role="alert"  style="backgroung-color:#49FEBD">
                                            Schedule Booked Successfully
                                        </div>
                                    <?php
                                    } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                } elseif ($flag == 1) {
                                    ?>
                                    <div class="alert alert-warning" role="alert">
                                        This time slot is already being booked. Please enter some other schedule.
                                    </div>
                                    <?php
                                    
                                    echo "<br><br> Your Schedule/s on {$date} are as follows:-";

                                    ?>
                                    <div class="row">
                                        <?php
                                        if ($result = $conn->query($sql1)) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <div class="col-md-4">
                                                    <div class="card mt-3">
                                                        <div class="card-body">
                                                            <?php
                                                            echo "<strong>{$row['start_time']} " . " to ";
                                                            echo $row['end_time'] . "</strong><br>";
                                                            echo $row['comment'] . "<br>";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>


                            <?php
                            $conn->close();

                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
