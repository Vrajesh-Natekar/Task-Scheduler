<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <div class="row">
        <div class="col-md-4">
            <a href="index.php" class="btn btn-primary" style="background:#0F8BFF">Back To Create Schedule </a>
            <p class="mt-2" style="font-weight:bold">View your Schedule/s here by entering date</p>
            <form action="" method="post">
                <div class="input-group mt-2">
                    <input type="date" name="search" class="form-control" placeholder="Enter Date.." aria-describedby="search" style="border-radius:5px">
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary" style="font-weight:bold; margin-left: 15px;border-radius:5px;">Search</button>
                </div>
            </form>
        </div>
    </div>
    <!-- PHP SCRIPT FOR SEARCH -->
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
        $search = $_POST['search'];

        # here searching of the schedule is done based on date entered.
        $sqlsearch = "select * from task_scheduler where date = '$search'";

    ?>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <?php
                    echo "<p>Your Schedule on {$search} is</p>";
                    if ($result = $conn->query($sqlsearch)) 
                    {
                        while ($row = $result->fetch_assoc())
                         {
                    ?>
                            <div class="col-md-3">
                                <div class="card mt-2">
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
            ?>
            </div>
        </div>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
