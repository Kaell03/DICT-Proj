<?php
include 'resource/php/header_in.php';
include 'resource/php/connections.php';

echo $_SESSION['sessionUsername'];

// Check if print btn is pressed
if (isset($_POST['print_result'])) {
    $id = $_POST['idd'];

    // echo $id;
    $_SESSION['result_id'] = $id;
    header("Location: print.php");
    // Close the statement
}

// Check if delete btn is pressed
if (isset($_POST['delete_result'])) {
    // $id = $_POST['idd'];
    $id = $_SESSION['row_id'];
    $confirmPassword = $_POST['confirmPassword'];

    // echo $id;
    // Prepare and execute the SQL query
    $query = "SELECT * FROM admin WHERE password = '$confirmPassword'";
    $result = mysqli_query($conn, $query);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {

        // echo '<script>alert("Bef");</script>';

        // Password matches, do something
        // Prepare and execute the delete statement
        $stmt = $conn->prepare("DELETE FROM exam_results WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        // Check if the delete operation was successful
        if ($stmt->affected_rows > 0) {
            echo '<script>alert("Result was Deleted Successfully");</script>';
        } else {
            echo '<script>alert("Something Went Wrong");</script>';
        }
        // Close the statement
        $stmt->close();
    } else {
        // Password does not match, do something else
        echo '<script>alert("Password does not match");</script>';
    }

    // echo $confirmPassword;
}



if (isset($_POST['submit_timer'])) {
    $duration = $_POST['input_number'];

    // Prepare and execute the SQL update statement
    $sql = "UPDATE timer SET duration = $duration WHERE id = 1";

    if ($conn->query($sql) === TRUE) {
        // Redirect to YouTube or any other page
        //  header("Location: bResults.php");
        echo '<script>alert("Timer updated successfully!");</script>';

    } else {
        echo '<script>alert("Something went wrong");</script>';
    }
}
if (isset($_POST['submit_username'])) {
    $duration = $_POST['input_username'];
    //    header("Location: aSplash.php");
    // Prepare and execute the SQL update statement
    $sql = "UPDATE admin SET username = '$duration' WHERE id = 1";
    // echo $duration;
    if ($conn->query($sql) === TRUE) {
        //  header("Location: bResults.php");
        echo '<script>alert("Username updated successfully!");</script>';

    } else {
        echo '<script>alert("Something went wrong");</script>';
    }
}
if (isset($_POST['submit_password'])) {
    $duration = $_POST['input_password'];

    // Prepare and execute the SQL update statement
    $sql = "UPDATE admin SET password = '$duration' WHERE id = 1";

    if ($conn->query($sql) === TRUE) {
        // Redirect to YouTube or any other page
        //  header("Location: bResults.php");
        echo '<script>alert("Password updated successfully!");</script>';

    } else {
        echo '<script>alert("Something went wrong");</script>';
    }
}


//Data insertion
if (isset($_POST['insert_result'])) {
    $con = mysqli_connect("localhost", "root", "", "test");

    // Get form data
    $lrn = $_POST['lrn'];
    $dateTaken = $_POST['dateTaken'];
    $testTaker = $_POST['testTaker'];
    $examTypes = $_POST['examTypes'];
    $scores = $_POST['scores'];
    $total = $_POST['total'];
    $percentage = $_POST['percentage'];
    $remark = $_POST['remark'];

    // Check if any required field is empty
    if (empty($dateTaken) || empty($testTaker) || empty($examTypes) || empty($scores) || empty($total) || empty($percentage) || empty($remark) || empty($lrn)) {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    } else {
        // Insert data into exam_results table
        $query = "INSERT INTO exam_results (username, date_taken, exam_type, score, items, total_score, total_items, percentage, remark, lrn, manual) 
                VALUES ('$testTaker', '$dateTaken', '$examTypes', '$scores', '', '$total', '', '$percentage', '$remark', '$lrn', 'yes')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>alert('Data inserted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    }

    // Close database connection
    mysqli_close($con);
}

?>

<html>

<head>
    <title>RECORDS</title>
    <link rel="stylesheet" href="resource/css/style.css">
</head>

<body>


    <br>
    <!-- BODY -->
    <div class="row" style="padding-left: 24px;">
        <div class="col-9">
            <h2 class="title" class="hide" style="font-size: 50px;">RECORDS</h2>
            <p id="hide">
                The records page serves as a central repository for travel orders, purchase requests, purchase orders,
                and abstracts of canvass, providing easy access to important documentation. It ensures efficient
                management and transparent record-keeping for these processes. </p>
        </div>


        <div class="col-3" class="hide">
            <form action="" method="GET">
                <div class="input-group mb-3" style="width: 95%;">
                    <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                        echo $_GET['search'];
                    } ?>" class="form-control" placeholder="Search" id="hide">
                    <button type="submit" class="btn btn-primary" id="hide">Search</button>
                </div>
            </form>

            <div style="display: flex; justify-content:end; margin-top: 3px;">
                <button class="btn btn-danger" id="hide" style="margin-right:12px" class="hide">
                    <a href="aSplash.php" style="color: white">
                        Log Out
                    </a>
                </button>
            </div>
            <div style="display: flex; justify-content: end; margin-top: 3px;" class="hide">
                <button class="btn btn-success" id="printBtn" style="margin-right: 12px">Print</button>
            </div>

            <hr style="border: none; height: 1px; background-color: black;">

            <script>
                // document.getElementById('printBtn').addEventListener('click', function () {
                //     window.print();
                // });
            </script>


        </div>
    </div>



    <div class="row justify-content-center align-items-center g-2">
        <!-- <div class="col"> -->
            <div class="col" style="margin-left: 24px; max-width: 20%;">
                <h5>Filter by Type:</h5>
            </div>
            <div class="col" style="margin-left: 24px; max-width: 20%;">
                <form action="" method="get">
                    <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="typeDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $selectedType = isset($_GET['type']) ? $_GET['type'] : 'All';
                            echo $selectedType;
                            ?>
                        </button>
                        <select name="" id="">
                            <option value="">Travel Order</option>
                            <option value="">Travel Order</option>
                            <option value="">Travel Order</option>
                            <option value="">Travel Order</option>
                        </select>
                        <div class="dropdown-menu" aria-labelledby="typeDropdown">
                            <a class="dropdown-item" href="?type=all">All</a>
                            <a class="dropdown-item" href="?type=all">All</a>
                            <a class="dropdown-item" href="?type=all">All</a>
                        </div>
                    </div>
                </form>
            </div>
        <!-- </div> -->
    </div>



    <table class="table table-striped" style="width: 95%; margin: 24px;" id="realtable">
        <thead>
            <tr>

                <th scope="col">Type</th>
                <th scope="col">Date</th>
                <th scope="col">Name of Personnel</th>
                <th scope="col">Designation</th>
                <th scope="col">Destination</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ids = 1;
            $con = mysqli_connect("localhost", "root", "", "control_number_generator");
            $filtervalues = "-";
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
            }
            $num = 1;
            $query = "SELECT * FROM records WHERE CONCAT(control_number, type, particulars, date_created) LIKE '%$filtervalues%'";
            // Check if "True" is selected in the dropdown
            $sortByHighest = isset($_GET['sort']) && $_GET['sort'] == 'true';

            // Prepare the SQL query with sorting based on 'total_score'
            if ($sortByHighest) {
                $query .= " ORDER BY date_created DESC";
            } else {
                $query = "SELECT * FROM records WHERE CONCAT(control_number, type, particulars, date_created) LIKE '%$filtervalues%'";
            }

            $query_run = mysqli_query($con, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    ?>
                    <td>
                        <?= $row['type']; ?>
                    </td>
                    <td>
                        <?= $row['control_number']; ?>
                    </td>
                    <td>
                        <?php
                        $scoreString = $row['name_of_personnel'];
                        $scoreFormatted = str_replace(',', '<br>', $scoreString);
                        echo $scoreFormatted;
                        ?>
                    </td>
                    <td style="text-align: end;">
                        <?php
                        $scoreString = $row['designation'];
                        $scoreFormatted = str_replace(',', '         /' . "   " . '<br>     ', $scoreString);
                        echo $scoreFormatted;
                        ?>
                    </td>
                    <td style="text-align: start; display: flex; justify-content:center">
                        <?php
                        $scoreString = $row['destination'];
                        $scoreFormatted = str_replace(',', '<br>', $scoreString);
                        echo $scoreFormatted;
                        ?>


                        <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#resultModal" id="hide"
                            background="resource/img/hint_icon.png">
                            <img src="resource/img/hint_icon.png" style="max-width: 255px; max-height: 25px;" alt=""
                                onclick="showResultModal('<?php // echo $row['username']; ?>')">
                        </button> -->

                    </td>


                    <td>
                        <form action="" method="post">
                            <div class="row justify-content-center align-items-center g-2" style="margin-right: 12px;">
                                <input type="text" name="idd" value=" <?php echo $row['id'] ?>" id="id"
                                    style="height: 0px; width:0px" required>
                            </div>
                            <div class="row justify-content-center align-items-center g-2" style="margin-right: 12px;">
                                <!-- <input type="submit" value="Delete" name="delete_result" class="btn btn-secondary"
                                    style='width:100px; margin-bottom: 5px;'> -->


                                <div class="row justify-content-center align-items-center g-2" style="margin-right: 12px;">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="deleteRow(<?php echo $row['id']; ?>)">
                                        Delete
                                    </button>
                                </div>

                                <script>
                                    function deleteRow(id) {
                                        // Display a confirm alert
                                        var confirmDelete = confirm("Are you sure you want to delete this row?");

                                        // If the user confirms deletion, send an AJAX request to delete the row
                                        if (confirmDelete) {
                                            $.ajax({
                                                url: 'delete_row.php', // Replace with the actual path to your PHP script
                                                method: 'POST',
                                                data: { id: id },
                                                success: function (response) {
                                                    // Handle the response if needed
                                                    console.log(response);
                                                },
                                                error: function (xhr, status, error) {
                                                    console.error(xhr.responseText);
                                                }
                                            });
                                        }
                                    }

                                </script>
                            </div>


                            </div>



                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this item?</p>\
                                            <input type="text" id="idInput" class="form-control">
                                            <input type="text" id="deleteInput" class="form-control"
                                                placeholder="Enter confirmation">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="row justify-content-center align-items-center g-2" style="margin-right: 12px;">
                                <input type="submit" value="Print" name="print_result" class="btn btn-primary"
                                    style='width:100px; margin-bottom: 5px;'>
                            </div> -->
                            <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#updateModal"
                            style='width:100px; margin-bottom: 5px;' onclick='update()'>
                            Update
                        </button> -->
                        </form>
                    </td>

                    </tr>
                    <?php
                }
            } else {
                echo "No Search Found.";
            }
            ?>
        </tbody>
    </table>

    <!-- 


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->


    <!-- The update modal -->


    <br>
    <!-- Information Update -->
    </div>
</body>

</html>


<style>
    @media print {

        .hide,
        #hide {
            visibility: hidden;
            display: gone;
        }

        .title {
            text-align: center;
        }
    }
</style>

<script>
    function onto(name) {
        // confirm(num);
        // document.getElementById("idInventory").innerHTML = num;

        document.cookie = "onto=" + name;

        window.location.href = "admin_test_taken.php";
        // window.alert(num);
        // console.log(name);
        // document.cookie = "type=" + type;

        // window.scrollTo(0, document.body.scrollHeight);
    }

    function update(num) {
        // confirm(num);
        document.getElementById("idInventory").innerHTML = num;
        document.cookie = "idNumber=" + num;
        // document.cookie = "type=" + type;

        window.scrollTo(0, document.body.scrollHeight);
    }


    function printMe() {
        print();
    }
</script>


<script>
    function confirmLogout() {
        var result = confirm("Are you sure you want to log out?");
        if (result) {
            // window.location.href = "\home.php";
            // window.location.href = "home.php";
            // similar behavior as an HTTP redirect
            window.location.href("home.php");

            // similar behavior as clicking on a link
            // window.location.href = "http://stackoverflow.com";
            alert("Logout successful!");
        }
    }
</script>

<style>
    .modal-header {
        background-color: #116536;
        color: white;
        text-align: center;
    }

    .modal-body1 {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .admin-section {
        text-align: center;
        margin: 10px;
    }

    .admin-image {
        width: 140px;
        height: 140px;
    }

    .admin-name {
        margin-top: 15px;
        font-weight: bold;
        text-align: center;
    }
</style>



<!-- Delete ModalS -->
<form action="" method="post">
    <div class="modal fade" id="adminDeleteModal" tabindex="-1" role="dialog" aria-labelledby="adminSettingsModalLabel"
        aria-hidden="true" style="height:30vh">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="height:30vh">
                <div class="modal-header">
                    <h3 class="modal-title" id="adminSettingsModalLabel" style="text-align: left;">
                        Are you
                        sure you want to delete?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <hr style="border-top: 1px solid black; margin: 30px 10px;"> -->
                <div class="modal-body1" style="display: flex; margin-left:-10px; height: 50vh">
                    <input type="text" name="confirmPassword" placeholder="Enter Admin Password">
                    <input type="submit" value="Confirm Delete" name="delete_result" class="btn btn-danger"
                        style='width:auto; margin-bottom: 5px;'>
                </div>
            </div>
        </div>
    </div>
</form>