<?php
// session_start();
include 'resource/php/header_in_user.php';
include 'resource/php/connections.php';

// echo "<script>alert('Welcome " . $_SESSION['sessionUsername'] . "');</script>";
// echo $_SESSION['sessionUsername'];
$sessionUsername = $_SESSION['sessionUsername'];

$conn = new mysqli('localhost', 'root', '', 'control_number_generator');


//FOR CHANGING/UPDATING THE QUESTIONS
if (isset($_POST['reserv'])) {
    // $id = $_POST['id'] ?? null;
    $id = $_COOKIE["idNumber"];
    $type = $_POST["type"] ?? null;
    $status = $_POST['status'] ?? null; //Saves the update-to-this value

    $sql = "UPDATE exam_questions SET $type = '$status' where id = '$id';";
    if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">';
        echo ' alert("Question Updated Successfully")'; //showing an alert box.
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo ' alert("Something went wrong")'; //showing an alert box.
        echo '</script>';
    }

}
if (isset($_POST['delete'])) {
    $id = $_COOKIE["idNumber"];
    // $id = $_POST["idd"] ?? null;
    $sql = "DELETE FROM exam_questions WHERE id = '$id'";

    if ($id == null) {
        //    echo "Something Went Wrong";
        echo '<script type="text/javascript">';
        echo ' alert("Something went wrong")'; //showing an alert box.
        echo '</script>';
        // redirect("admin_customer.php");
    } else if (mysqli_query($conn, $sql)) {
        echo '<script type="text/javascript">';
        echo ' alert("Quesion Successfully Deleted")'; //showing an alert box.
        echo '</script>';
    }

}

if (isset($_POST['submit_travel_order'])) {
    //Getting user input
    $city = $_POST['destination_city'];
    $brgy = $_POST['destination_brgy'];
    $personnel_name = $_POST['personnel_name'];
    $designation = $_POST['designation'];
    $destination = $city . ", " . $brgy;
    $type = "travel_order";

    // Query to retrieve the row with the highest 'number' for the given 'type'
    $query = "SELECT * FROM records WHERE type = '$type' ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $number = $row['number'];
        } else {
            // echo "No rows found for type '$type'";
        }
    } else {
        // echo "Query failed: " . mysqli_error($conn);
    }

    $currentDate = date('Y-m'); //getting the year and month numerics 
    //Preparing the data to be pushed to the database for the record type="Travel Order"
    $type = "travel_order";
    $number = $number + 1;
    $username = $_SESSION['sessionUsername'];
    $control_number = "TrOv-" . $currentDate . "-00" . $number;
    echo $city . " " . $brgy . " " . $control_number;

    $query = "INSERT INTO records (username, control_number, type, name_of_personnel, designation, destination, number)
    VALUES ('$username','$control_number','$type','$personnel_name','$designation','$destination','$number')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Travel order record successfully inserted!');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
    
}

if (isset($_POST['submit_purchase_request'])) {
    //Getting user input
    $particulars = $_POST['particulars_pr'];
    $currentDate = date('Y-m'); //getting the year and month numerics 
    $type = "purchase_request";

    // Query to retrieve the row with the highest 'number' for the given 'type'
    $query = "SELECT * FROM records WHERE type = '$type' ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $number = $row['number'];
        } else {
            // echo "No rows found for type '$type'";
        }
        mysqli_free_result($result);
    } else {
        // echo "Query failed: " . mysqli_error($conn);
    }

    $number = $number + 1;
    $control_number = "PRV-" . $currentDate . "-00" . $number;
    $username = $_SESSION['sessionUsername'];

    $query = "INSERT INTO records (username, control_number, type, particulars, number)
    VALUES ('$username','$control_number','$type','$particulars','$number')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Purchase request successfully inserted!');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}

if (isset($_POST['submit_purchase_order'])) {
    //Getting user input
    $particulars = $_POST['particulars_po'];
    $currentDate = date('Y-m'); //getting the year and month numerics 
    $type = "purchase_order";

    // Query to retrieve the row with the highest 'number' for the given 'type'
    $query = "SELECT * FROM records WHERE type = '$type' ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $number = $row['number'];
        } else {
            // echo "No rows found for type '$type'";
        }
    } else {
        // echo "Query failed: " . mysqli_error($conn);
    }

    $number = $number + 1;
    $control_number = "POV-" . $currentDate . "-00" . $number;
    $username = $_SESSION['sessionUsername'];

    $query = "INSERT INTO records (username, control_number, type, particulars, number)
    VALUES ('$username','$control_number','$type','$particulars','$number')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Purchase order record successfully inserted!');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}
if (isset($_POST['submit_abstract_of_canvas'])) {
    //Getting user input
    $particulars = $_POST['particulars_aoc'];
    $currentDate = date('Y-m'); //getting the year and month numerics 
    $type = "abstract_of_canvas";

    // Query to retrieve the row with the highest 'number' for the given 'type'
    $query = "SELECT * FROM records WHERE type = '$type' ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $number = $row['number'];
        } else {
            // echo "No rows found for type '$type'";
        }
    } else {
        // echo "Query failed: " . mysqli_error($conn);
    }

    $number = $number + 1;
    $control_number = "ARV-" . $currentDate . "-00" . $number;
    $username = $_SESSION['sessionUsername'];

    $query = "INSERT INTO records (username, control_number, type, particulars, number)
    VALUES ('$username','$control_number','$type','$particulars','$number')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Abstract of Cancas Record successfully inserted!');</script>";
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}

?>

<html>

<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="resource/css/style.css">
</head>

<body>

    <br>
    <!-- BODY -->
    <div class="row" style="padding-left: 24px;">
        <div class="col-9">
            <h2 class="title" style="font-size: 50px;">RECORDS</h2>
            <p>
            Welcome <b><?php echo $_SESSION['sessionUsername']; ?></b>
        , this is your centralized hub for viewing travel orders, purchase requests, purchase orders, and abstracts of canvas. Easily view these important documents to track travel arrangements, monitor procurement processes, and gather information about canvassing activities. 
        Stay organized and informed with convenient access to essential administrative records. </p>
        </div>
        <div class="col-3">
            <form action="" method="GET">
                <div class="input-group mb-3" style="width: 95%;">
                    <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                        echo $_GET['search'];
                    } ?>" class="form-control" placeholder="Search" id="hide">
                    <button type="submit" class="btn btn-primary" id="hide">Search</button>
                </div>
            </form>
            <!-- <div style="display: flex; justify-content:end; margin-top: 3px; margin-right:12px">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adminSettingsModal">
                    Open Admin Settings
                </button>
            </div> -->

            <hr style="border: none; height: 1px; background-color: black;">



            <!-- <div style="display: flex; justify-content:end; margin-top: 3px;">
                <button class="btn btn-success" onclick="printMe()" id="hide">
                    <u>Print</u>
                </button>
            </div> -->

            <!-- <p style="text-align: right;" data-toggle="modal" data-target="#modalRegisterForm" id="hide"><u>Create New Customer Account</u></p> -->
            <!-- <p style="color: blue; text-align: right; height:min-content; padding:0px; margin: 0px" onclick="printMe()" id="hide"><u>Print</u></p> -->
        </div>
    </div>


    <div class="row" style="margin-bottom: 24px; margin-top: 12px;">
        <div class="col" style="margin-left: 24px; max-width: 20%;">
            <h5>Filter by Type:</h5>
        </div>
        <div class="col" style="margin-left: 24px; max-width: auto;">
            <select name="dropdown" id="dropdownButton" class="btn btn-danger dropdown-toggle">
                <option value="travel_order">Travel Order</option>
                <option value="purchase_order">Purchase Order</option>
                <option value="purchase_request">Purchase Request</option>
                <option value="abstract_of_canvas">Abstract of Canvas</option>
            </select>
        </div>

        <script>
            document.getElementById("dropdownButton").addEventListener("change", function () {
                var selectedOption = this.options[this.selectedIndex].value;
                // alert(selectedOption);

                if (selectedOption === "travel_order") {
                    document.getElementById("table_TO").style.display = "initial";
                    document.getElementById("table_PR").style.display = "none";
                    document.getElementById("table_PO").style.display = "none";
                    document.getElementById("table_AOC").style.display = "none";
                } else if (selectedOption === "purchase_order") {
                    document.getElementById("table_TO").style.display = "none";
                    document.getElementById("table_PR").style.display = "none";
                    document.getElementById("table_PO").style.display = "initial";
                    document.getElementById("table_AOC").style.display = "none";
                } else if (selectedOption === "purchase_request") {
                    document.getElementById("table_TO").style.display = "none";
                    document.getElementById("table_PR").style.display = "initial";
                    document.getElementById("table_PO").style.display = "none";
                    document.getElementById("table_AOC").style.display = "none";
                } else if (selectedOption === "abstract_of_canvas") {
                    document.getElementById("table_TO").style.display = "none";
                    document.getElementById("table_PR").style.display = "none";
                    document.getElementById("table_PO").style.display = "none";
                    document.getElementById("table_AOC").style.display = "initial";
                }
            });
        </script>


        <!-- Button to trigger the modal -->
        <div class="col text-right" style="margin-left: 24px; margin-right:12px; max-width: auto;">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addNewRecord">
                Generate New Record
            </button>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNewRecord" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Add New Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-secondary" id="to">Travel Order</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-secondary" id="po">Purchase Order</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-secondary" id="pr">Purchase Request</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-secondary" id="aoc">Abstract of Canvas</button>
                        </div>
                    </div>


                    <div id="purchase_request" class="modal_form_class">
                        <form action="" method="post">
                            <h3 style="text-align:center;">PURCHASE REQUEST</h3>
                            <div class="form-group">
                                <label for="particulars_pr">Particulars:</label>
                                <textarea rows="" cols="" class="form-control" name="particulars_pr"
                                    required></textarea>
                            </div>
                            <div class="row d-flex justify-content-center" style="margin-top: 12px;">
                                <button type="submit" class="btn btn-primary"
                                    name="submit_purchase_request">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div id="purchase_order" class="modal_form_class">
                        <form action="" method="post">
                            <h3 style="text-align:center;">PURCHASE ORDER</h3>
                            <div class="form-group">
                                <label for="particulars_pr">Particulars:</label>
                                <textarea rows="" cols="" class="form-control" name="particulars_po"
                                    required></textarea>
                            </div>
                            <div class="row d-flex justify-content-center" style="margin-top: 12px;">
                                <button type="submit" class="btn btn-primary"
                                    name="submit_purchase_order">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div id="abstract_of_canvas" class="modal_form_class">
                        <form action="" method="post">
                            <h3 style="text-align:center;">ABSTRACT OF CANVAS</h3>
                            <div class="form-group">
                                <label for="particulars_pr">Particulars:</label>
                                <textarea rows="" cols="" class="form-control" name="particulars_aoc"
                                    required></textarea>
                            </div>
                            <div class="row d-flex justify-content-center" style="margin-top: 12px;">
                                <button type="submit" class="btn btn-primary"
                                    name="submit_abstract_of_canvas">Submit</button>
                            </div>
                        </form>
                    </div>


                    <div id="travel_order" class="modal_form_class">
                        <form action="" method="post">
                            <h3 style="text-align:center;">TRAVEL ORDER</h3>
                            <div class="form-group">
                                <label for="personnelName">Name of Personnel:</label>
                                <input type="text" class="form-control" id="personnelName"
                                    placeholder="Place comma ',' to emphasize multiple entries" name="personnel_name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation:</label>
                                <select class="form-control" id="designation" name="designation" required>
                                    <option value="Mayor">Mayor</option>
                                    <option value="Vice Mayor">Vice Mayor</option>
                                    <option value="Sangguniang Bayan Members (Councilors)">Sangguniang Bayan Members
                                        (Councilors)</option>
                                    <option value="Treasurer">Treasurer</option>
                                    <option value="Assessor">Assessor</option>
                                    <option value="Planning and Development Coordinator">Planning and Development
                                        Coordinator</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Health Officer">Health Officer</option>
                                    <option value="Social Welfare and Development Officer">Social Welfare and
                                        Development Officer</option>
                                    <option value="Agriculturist">Agriculturist</option>
                                    <option value="Environment and Natural Resources Officer">Environment and Natural
                                        Resources Officer</option>
                                    <option value="Civil Registrar">Civil Registrar</option>
                                    <option value="Budget Officer">Budget Officer</option>
                                    <option value="Accountant">Accountant</option>
                                    <option value="Legal Officer">Legal Officer</option>
                                    <option value="Information Officer">Information Officer</option>
                                    <option value="General Services Officer">General Services Officer</option>
                                    <option value="Human Resource Management Officer">Human Resource Management Officer
                                    </option>
                                    <option value="Disaster Risk Reduction and Management Officer">Disaster Risk
                                        Reduction and Management Officer</option>
                                    <option value="Tourism Officer">Tourism Officer</option>
                                    <option value="Public Order and Safety Officer">Public Order and Safety Officer
                                    </option>
                                    <option value="Economic Enterprise Development Officer">Economic Enterprise
                                        Development Officer</option>
                                    <option value="Population Officer">Population Officer</option>
                                    <option value="Gender and Development Officer">Gender and Development Officer
                                    </option>
                                    <option value="Cooperative Development Officer">Cooperative Development Officer
                                    </option>
                                    <option value="Nutrition Officer">Nutrition Officer</option>
                                    <option value="Barangay Affairs Officer">Barangay Affairs Officer</option>
                                    <option value="Records Officer">Records Officer</option>
                                    <option value="Internal Auditor">Internal Auditor</option>
                                    <option value="Local Government Operations Officer">Local Government Operations
                                        Officer</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="destination_city">Destination:</label>
                                        <select class="form-control" id="destination_city" name="destination_city"
                                            required>
                                            <option value="">Select Province/City</option>
                                            <option value="Abra">Abra</option>
                                            <option value="Agusan del Norte">Agusan del Norte</option>
                                            <option value="Agusan del Sur">Agusan del Sur</option>
                                            <option value="Aklan">Aklan</option>
                                            <option value="Albay">Albay</option>
                                            <option value="Angeles City">Angeles City</option>
                                            <option value="Antique">Antique</option>
                                            <option value="Apayao">Apayao</option>
                                            <option value="Aurora">Aurora</option>
                                            <option value="Basilan">Basilan</option>
                                            <option value="Bataan">Bataan</option>
                                            <option value="Batanes">Batanes</option>
                                            <option value="Batangas">Batangas</option>
                                            <option value="Benguet">Benguet</option>
                                            <option value="Biliran">Biliran</option>
                                            <option value="Bohol">Bohol</option>
                                            <option value="Bukidnon">Bukidnon</option>
                                            <option value="Bulacan">Bulacan</option>
                                            <option value="Butuan City">Butuan City</option>
                                            <option value="Cagayan">Cagayan</option>
                                            <option value="Cagayan de Oro City">Cagayan de Oro City</option>
                                            <option value="Calamba City">Calamba City</option>
                                            <option value="Caloocan">Caloocan</option>
                                            <option value="Camiguin">Camiguin</option>
                                            <option value="Camarines Norte">Camarines Norte</option>
                                            <option value="Camarines Sur">Camarines Sur</option>
                                            <option value="Camiguin">Camiguin</option>
                                            <option value="Capiz">Capiz</option>
                                            <option value="Catanduanes">Catanduanes</option>
                                            <option value="Cavite">Cavite</option>
                                            <option value="Cebu">Cebu</option>
                                            <option value="Cebu City">Cebu City</option>
                                            <option value="Compostela Valley">Compostela Valley</option>
                                            <option value="Cotabato">Cotabato</option>
                                            <option value="Cotabato City">Cotabato City</option>
                                            <option value="Davao del Norte">Davao del Norte</option>
                                            <option value="Davao del Sur">Davao del Sur</option>
                                            <option value="Davao Occidental">Davao Occidental</option>
                                            <option value="Davao Oriental">Davao Oriental</option>
                                            <option value="Davao City">Davao City</option>
                                            <option value="Dinagat Islands">Dinagat Islands</option>
                                            <option value="Eastern Samar">Eastern Samar</option>
                                            <option value="General Santos City">General Santos City</option>
                                            <option value="Guimaras">Guimaras</option>
                                            <option value="Ifugao">Ifugao</option>
                                            <option value="Ilocos Norte">Ilocos Norte</option>
                                            <option value="Ilocos Sur">Ilocos Sur</option>
                                            <option value="Iloilo">Iloilo</option>
                                            <option value="Iloilo City">Iloilo City</option>
                                            <option value="Isabela">Isabela</option>
                                            <option value="Kalinga">Kalinga</option>
                                            <option value="La Union">La Union</option>
                                            <option value="Laguna">Laguna</option>
                                            <option value="Lanao del Norte">Lanao del Norte</option>
                                            <option value="Lanao del Sur">Lanao del Sur</option>
                                            <option value="Lapu-Lapu City">Lapu-Lapu City</option>
                                            <option value="Las Piñas">Las Piñas</option>
                                            <option value="Legazpi City">Legazpi City</option>
                                            <option value="Leyte">Leyte</option>
                                            <option value="Ligao City">Ligao City</option>
                                            <option value="Makati">Makati</option>
                                            <option value="Malabon">Malabon</option>
                                            <option value="Mandaluyong">Mandaluyong</option>
                                            <option value="Mandaue City">Mandaue City</option>
                                            <option value="Manila">Manila</option>
                                            <option value="Marikina">Marikina</option>
                                            <option value="Marinduque">Marinduque</option>
                                            <option value="Masbate">Masbate</option>
                                            <option value="Muntinlupa">Muntinlupa</option>
                                            <option value="Naga City">Naga City</option>
                                            <option value="Navotas">Navotas</option>
                                            <option value="Negros Occidental">Negros Occidental</option>
                                            <option value="Negros Oriental">Negros Oriental</option>
                                            <option value="Northern Samar">Northern Samar</option>
                                            <option value="Nueva Ecija">Nueva Ecija</option>
                                            <option value="Nueva Vizcaya">Nueva Vizcaya</option>
                                            <option value="Occidental Mindoro">Occidental Mindoro</option>
                                            <option value="Oriental Mindoro">Oriental Mindoro</option>
                                            <option value="Ormoc City">Ormoc City</option>
                                            <option value="Palawan">Palawan</option>
                                            <option value="Pampanga">Pampanga</option>
                                            <option value="Pangasinan">Pangasinan</option>
                                            <option value="Parañaque">Parañaque</option>
                                            <option value="Pasay">Pasay</option>
                                            <option value="Pasig">Pasig</option>
                                            <option value="Pateros">Pateros</option>
                                            <option value="Plaridel">Plaridel</option>
                                            <option value="Puerto Princesa City">Puerto Princesa City</option>
                                            <option value="Quezon">Quezon</option>
                                            <option value="Quezon City">Quezon City</option>
                                            <option value="Quirino">Quirino</option>
                                            <option value="Rizal">Rizal</option>
                                            <option value="Romblon">Romblon</option>
                                            <option value="Samar">Samar</option>
                                            <option value="San Juan">San Juan</option>
                                            <option value="Sarangani">Sarangani</option>
                                            <option value="Siquijor">Siquijor</option>
                                            <option value="Sorsogon">Sorsogon</option>
                                            <option value="South Cotabato">South Cotabato</option>
                                            <option value="Southern Leyte">Southern Leyte</option>
                                            <option value="Sultan Kudarat">Sultan Kudarat</option>
                                            <option value="Sulu">Sulu</option>
                                            <option value="Surigao del Norte">Surigao del Norte</option>
                                            <option value="Surigao del Sur">Surigao del Sur</option>
                                            <option value="Tacloban City">Tacloban City</option>
                                            <option value="Taguig">Taguig</option>
                                            <option value="Tarlac">Tarlac</option>
                                            <option value="Tawi-Tawi">Tawi-Tawi</option>
                                            <option value="Valenzuela">Valenzuela</option>
                                            <option value="Zambales">Zambales</option>
                                            <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                                            <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                                            <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                                            <option value="Zamboanga City">Zamboanga City</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="destination_brgy">Barangay:</label>
                                        <select class="form-control" id="destination_brgy" name="destination_brgy"
                                            required>
                                            <option value="">Select Barangay</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center" style="margin-top: 12px;">
                                    <button type="submit" class="btn btn-primary" name="submit_travel_order">Submit
                                    </button>
                                </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>


    <style>
        .modal_form_class {
            margin-top: 24px;
        }
    </style>

    <!-- //TABLE OF EXAM QUESTION -->
    <table class="table table-hover table-bordered table-striped table-info" style="width: 95%; margin: 24px; "
        id="table_TO">
        <thead style="text-align: center;" class="bg-dark text-light">
            <tr></tr>
            <th scope="col"></th>
            <th scope="col">Type</th>
            <th scope="col">Generated By</th>
            <th scope="col">Control Number</th>
            <th scope="col">Name of Personnel</th>
            <th scope="col">Designation</th>
            <th scope="col">Destination</th>
            <th scope="col">Date Created</th>
        </thead>
        <tbody>
            <?php
            $filtervalues = "-";
            $query = "SELECT * FROM records WHERE type = 'travel_order'";
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
            }
            // echo $filtervalues;
            $number_count = 1;
            $query = "SELECT * FROM records WHERE 
            type = 'travel_order' 
            AND CONCAT(id, type, control_number, name_of_personnel, designation, destination, username) LIKE '%$filtervalues%' ";


            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    $idd = $row['id']
                        ?>
                    <td style="font-weight: 700;">
                        <?= $number_count; ?>
                    </td>
                    <td>
                        <?= $row['type']; ?>
                    </td>
                    <td>
                        <?= $row['username']; ?>
                    </td>
                    <td>
                        <?= $row['control_number']; ?>
                    </td>
                    <td>
                        <?= $row['name_of_personnel']; ?>
                    </td>
                    <td>
                        <?= $row['designation']; ?>
                    </td>
                    <td>
                        <?= $row['destination']; ?>
                    </td>
                    <td>
                        <?= $row['date_created']; ?>
                    </td>
                    <?php
                    $number_count++
                        ?>
                    </tr>
                    <?php
                }
            } else {
                // echo "No Search Found.";
            }
            ?>

        </tbody>
    </table>


    <table class="table table-hover table-bordered table-striped table-info" style="width: 95%; margin: 24px;"
        id="table_PR">
        <thead style="text-align: center;" class="bg-dark text-light">
            <tr></tr>
            <th scope="col"></th>
            <th scope="col">Type</th>
            <th scope="col">Generated By</th>
            <th scope="col">Control Number</th>
            <th scope="col">Particulars</th>
            <th scope="col">Date Created</th>
        </thead>
        <tbody>
            <?php
            $filtervalues = "_";
            $query = "SELECT * FROM records WHERE type = 'purchase_request'";
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
            }
            $number_count = 1;
            $query = "SELECT * FROM records WHERE type = 'purchase_request'
            AND CONCAT (control_number, particulars, username) LIKE '%$filtervalues%'";
            // $query = "SELECT * FROM exam_questions WHERE CONCAT(id, type, question) LIKE '%$filtervalues%' ";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    $idd = $row['id']
                        ?>
                    <td style="font-weight: 700;">
                        <?= $number_count; ?>
                    </td>
                    <td>
                        <?= $row['type']; ?>
                    </td>
                    <td>
                        <?= $row['username']; ?>
                    </td>
                    <td>
                        <?= $row['control_number']; ?>
                    </td>
                    <td>
                        <?= $row['particulars']; ?>
                    </td>
                    <td>
                        <?= $row['date_created']; ?>
                    </td>
                    <?php
                    $number_count++
                        ?>
                    </tr>
                    <?php
                }
            } else {
                // echo "No Search Found.";
            }
            ?>

        </tbody>
    </table>

    <table class="table table-hover table-bordered table-striped table-info" style="width: 95%; margin: 24px;"
        id="table_PO">
        <thead style="text-align: center;" class="bg-dark text-light">
            <tr></tr>
            <th scope="col"></th>
            <th scope="col">Type</th>
            <th scope="col">Generated By</th>
            <th scope="col">Control Number</th>
            <th scope="col">Particulars</th>
            <th scope="col">Date Created</th>
        </thead>
        <tbody>
            <?php
            $filtervalues = "_";
            $query = "SELECT * FROM records WHERE type = 'purchase_order' AND username = '$sessionUsername'";
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
            }
            $number_count = 1;
            // $query = "SELECT * FROM exam_questions WHERE CONCAT(id, type, question) LIKE '%$filtervalues%' ";
            $query = "SELECT * FROM records WHERE type = 'purchase_order'
            AND CONCAT (control_number, particulars, username) LIKE '%$filtervalues%'";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    $idd = $row['id']
                        ?>
                    <td style="font-weight: 700;">
                        <?= $number_count; ?>
                    </td>
                    <td>
                        <?= $row['type']; ?>
                    </td>
                    <td>
                        <?= $row['username']; ?>
                    </td>
                    <td>
                        <?= $row['control_number']; ?>
                    </td>
                    <td>
                        <?= $row['particulars']; ?>
                    </td>
                    <td>
                        <?= $row['date_created']; ?>
                    </td>
                    <?php
                    $number_count++
                        ?>
                    </tr>
                    <?php
                }
            } else {
                // echo "No Search Found.";
            }
            ?>

        </tbody>
    </table>

    <table class="table table-hover table-bordered table-striped table-info" style="width: 95%; margin: 24px;"
        id="table_AOC">
        <thead style="text-align: center;" class="bg-dark text-light">
            <tr></tr>
            <th scope="col"></th>
            <th scope="col">Type</th>
            <th scope="col">Generated By:</th>
            <th scope="col">Control Number</th>
            <th scope="col">Particulars</th>
            <th scope="col">Date Created</th>
        </thead>
        <tbody>
            <?php
            $filtervalues = "_";
            $query = "SELECT * FROM records WHERE type = 'abstract_of_canvas'";
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
            }
            $number_count = 1;
            // $query = "SELECT * FROM exam_questions WHERE CONCAT(id, type, question) LIKE '%$filtervalues%' ";
            $query = "SELECT * FROM records WHERE type = 'abstract_of_canvas'
            AND CONCAT (control_number, particulars, username) LIKE '%$filtervalues%'";
            $query_run = mysqli_query($conn, $query);
            if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                    $idd = $row['id']
                        ?>
                    <td style="font-weight: 700;">
                        <?= $number_count; ?>
                    </td>
                    <td>
                        <?= $row['type']; ?>
                    </td>
                    <td>
                        <?= $row['username']; ?>
                    </td>
                    <td>
                        <?= $row['control_number']; ?>
                    </td>
                    <td>
                        <?= $row['particulars']; ?>
                    </td>
                    <td>
                        <?= $row['date_created']; ?>
                    </td>
                    <?php
                    $number_count++
                        ?>
                    </tr>
                    <?php
                }
            } else {
                // echo "No Search Found.";
            }
            ?>

        </tbody>
    </table>



    <!-- //Scripts for table function -->
    <script>

        function updated(num) {
            // document.getElementById("question_ID").innerHTML = num;
            document.cookie = "idNumber=" + num;

            window.scrollTo(0, document.body.scrollHeight);
        }

    </script>

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

    th,
    td {
        border: 2px solid black;
    }

    #table_TO,
    #table_PR,
    #table_PO,
    #table_AOC {
        table-layout: fixed;
        width: 100%;
    }
</style>

<script>
    document.getElementById("table_TO").style.display = "initial";
    document.getElementById("table_PR").style.display = "none";
    document.getElementById("table_PO").style.display = "none";
    document.getElementById("table_AOC").style.display = "none";
</script>

<script>
    // Get references to the select elements
    var citySelect = document.getElementById("destination_city");
    var brgySelect = document.getElementById("destination_brgy");

    // Define the options for each province or city
    var options = {
        "Muntinlupa": ["Alabang", "Ayala Alabang", "Bayanan", "Buli", "Cupang", "Putatan", "Sucat", "Tunasan", "Poblacion"],
        "Naga City": ["Abella", "Bagumbayan Norte", "Bagumbayan Sur", "Balatas", "Calauag", "Cararayan", "Carolina", "Concepcion Grande", "Concepcion Pequeña", "Dayangdang", "Del Rosario", "Dinaga", "Igualdad Interior", "Lerma", "Liboton", "Mabolo", "Pacol", "Panicuason", "Peñafrancia", "Sabang", "San Felipe", "San Francisco", "San Isidro", "Santa Cruz", "Tabuco", "Tinago", "Triangulo"],
        "Abra": ["Bangued", "Boliney", "Bucay", "Bucloc", "Daguioman", "Danglas", "Dolores", "La Paz", "Lacub", "Lagangilang", "Lagayan", "Langiden", "Licuan-Baay", "Luba", "Malibcong", "Manabo", "Peñarrubia", "Pidigan", "Pilar", "Sallapadan", "San Isidro", "San Juan", "San Quintin", "Tayum", "Tineg", "Tubo", "Villaviciosa"],
        "Agusan del Norte": ["Buenavista", "Butuan City", "Cabadbaran City", "Carmen", "Jabonga", "Kitcharao", "Las Nieves", "Magallanes", "Nasipit", "Remedios T. Romualdez", "Santiago", "Tubay"],
        "Agusan del Sur": ["Bayugan City", "Bunawan", "Esperanza", "La Paz", "Loreto", "Prosperidad", "Rosario", "San Francisco", "San Luis", "Santa Josefa", "Sibagat", "Talacogon", "Trento", "Veruela"],
        "Aklan": ["Altavas", "Balete", "Banga", "Batan", "Buruanga", "Ibajay", "Kalibo", "Lezo", "Libacao", "Madalag", "Makato", "Malay", "Malinao", "Nabas", "New Washington", "Numancia", "Tangalan"],
        "Albay": ["Bacacay", "Camalig", "Daraga", "Guinobatan", "Jovellar", "Legazpi City", "Libon", "Ligao City", "Malilipot", "Malinao", "Manito", "Oas", "Pio Duran", "Polangui", "Rapu-Rapu", "Santo Domingo", "Tabaco City", "Tiwi"],
        "Antique": ["Anini-y", "Barbaza", "Belison", "Bugasong", "Caluya", "Culasi", "Hamtic", "Laua-an", "Libertad", "Pandan", "Patnongon", "San Jose de Buenavista", "San Remigio", "Sebaste", "Sibalom", "Tibiao", "Tobias Fornier", "Valderrama"],
        "Apayao": ["Calanasan", "Conner", "Flora", "Kabugao", "Luna", "Pudtol", "Santa Marcela"],
        "Aurora": ["Baler", "Casiguran", "Dilasag", "Dingalan", "Dinalungan", "Dipaculao", "Maria Aurora", "San Luis"],
        "Basilan": ["Akbar", "Al-Barka", "Hadji Mohammad Ajul", "Hadji Muhtamad", "Isabela City", "Lamitan City", "Lantawan", "Maluso", "Sumisip", "Tabuan-Lasa", "Tipo-Tipo", "Tuburan", "Ungkaya Pukan"],
        "Bataan": ["Abucay", "Bagac", "Balanga City", "Dinalupihan", "Hermosa", "Limay", "Mariveles", "Morong", "Orani", "Orion", "Pilar", "Samal"],
        "Batanes": ["Basco", "Itbayat", "Ivana", "Mahatao", "Sabtang", "Uyugan"],
        "Batangas": ["Agoncillo", "Alitagtag", "Balayan", "Balete", "Batangas City", "Bauan", "Calaca", "Calatagan", "Cuenca", "Ibaan", "Laurel", "Lemery", "Lian", "Lipa City", "Lobo", "Mabini", "Malvar", "Mataasnakahoy", "Nasugbu", "Padre Garcia", "Rosario", "San Jose", "San Juan", "San Luis", "San Nicolas", "San Pascual", "Santa Teresita", "Santo Tomas", "Taal", "Talisay", "Tanauan City", "Taysan", "Tingloy", "Tuy"],
        "Benguet": ["Atok", "Bakun", "Bokod", "Buguias", "Itogon", "Kabayan", "Kapangan", "Kibungan", "La Trinidad", "Mankayan", "Sablan", "Tuba", "Tublay"],
        "Biliran": ["Almeria", "Biliran", "Cabucgayan", "Caibiran", "Culaba", "Kawayan", "Maripipi", "Naval"],
        "Bohol": ["Alburquerque", "Alicia", "Anda", "Antequera", "Baclayon", "Balilihan", "Batuan", "Bien Unido", "Bilar", "Buenavista", "Calape", "Candijay", "Carmen", "Catigbian", "Clarin", "Corella", "Cortes", "Dagohoy", "Danao", "Dauis", "Dimiao", "Duero", "Garcia Hernandez", "Guindulman", "Inabanga", "Jagna", "Lila", "Loay", "Loboc", "Loon", "Mabini", "Maribojoc", "Panglao", "Pilar", "President Carlos P. Garcia", "Sagbayan", "San Isidro", "San Miguel", "Sevilla", "Sierra Bullones", "Sikatuna", "Tagbilaran City", "Talibon", "Trinidad", "Tubigon", "Ubay", "Valencia"],
        "Bukidnon": ["Baungon", "Cabanglasan", "Damulog", "Dangcagan", "Don Carlos", "Impasug-ong", "Kadingilan", "Kalilangan", "Kibawe", "Kitaotao", "Lantapan", "Libona", "Malaybalay City", "Malitbog", "Manolo Fortich", "Maramag", "Pangantucan", "Quezon", "San Fernando", "Sumilao", "Talakag", "Valencia City"],
        "Bulacan": ["Angat", "Balagtas", "Baliuag", "Bocaue", "Bulacan", "Bustos", "Calumpit", "Doña Remedios Trinidad", "Guiguinto", "Hagonoy", "Malolos City", "Marilao", "Meycauayan City", "Norzagaray", "Obando", "Pandi", "Paombong", "Plaridel", "Pulilan", "San Ildefonso", "San Jose del Monte City", "San Miguel", "San Rafael", "Santa Maria"],
        "Cagayan": ["Abulug", "Alcala", "Allacapan", "Amulung", "Aparri", "Baggao", "Ballesteros", "Buguey", "Calayan", "Camalaniugan", "Claveria", "Enrile", "Gattaran", "Gonzaga", "Iguig", "Lal-Lo", "Lasam", "Pamplona", "Peñablanca", "Piat", "Rizal", "Sanchez-Mira", "Santa Ana", "Santa Praxedes", "Santa Teresita", "Santo Niño", "Solana", "Tuao"],
        "Camarines Norte": ["Basud", "Capalonga", "Daet", "Jose Panganiban", "Labo", "Mercedes", "Paracale", "San Lorenzo Ruiz", "San Vicente", "Santa Elena", "Talisay", "Vinzons"],
        "Camarines Sur": ["Baao", "Balatan", "Bato", "Bombon", "Buhi", "Bula", "Cabusao", "Calabanga", "Camaligan", "Canaman", "Caramoan", "Del Gallego", "Gainza", "Garchitorena", "Goa", "Iriga City", "Lagonoy", "Libmanan", "Lupi", "Magarao", "Milaor", "Minalabac", "Nabua", "Naga City", "Ocampo", "Pamplona", "Pasacao", "Pili", "Presentacion", "Ragay", "Sagñay", "San Fernando", "San Jose", "Sipocot", "Siruma", "Tigaon", "Tinambac"],
        "Camiguin": ["Catarman", "Guinsiliban", "Mahinog", "Mambajao", "Sagay"],
        "Capiz": ["Cuartero", "Dao", "Dumalag", "Dumarao", "Ivisan", "Jamindan", "Maayon", "Mambusao", "Panay", "Panitan", "Pilar", "Pontevedra", "President Roxas", "Roxas City", "Sapi-an", "Sigma", "Tapaz"],
        "Catanduanes": ["Bagamanoc", "Baras", "Bato", "Caramoran", "Gigmoto", "Pandan", "Panganiban", "San Andres", "San Miguel", "Viga", "Virac"],
        "Cavite": ["Alfonso", "Amadeo", "Bacoor City", "Carmona", "Cavite City", "Dasmarinas City", "General Emilio Aguinaldo", "General Mariano Alvarez", "General Trias City", "Imus City", "Indang", "Kawit", "Magallanes", "Maragondon", "Mendez", "Naic", "Noveleta", "Rosario", "Silang", "Tagaytay City", "Tanza", "Ternate", "Trece Martires City"],
        "Cebu": ["Alcantara", "Alcoy", "Alegria", "Aloguinsan", "Argao", "Asturias", "Badian", "Balamban", "Bantayan", "Barili", "Bogo City", "Boljoon", "Borbon", "Carcar City", "Carmen", "Catmon", "Cebu City", "Compostela", "Consolacion", "Cordova", "Daanbantayan", "Dalaguete", "Danao City", "Dumanjug", "Ginatilan", "Lapu-Lapu City", "Liloan", "Madridejos", "Malabuyoc", "Mandaue City", "Medellin", "Minglanilla", "Moalboal", "Naga City", "Oslob", "Pilar", "Pinamungahan", "Poro", "Ronda", "Samboan", "San Fernando", "San Francisco", "San Remigio", "Santa Fe", "Santander", "Sibonga", "Sogod", "Tabogon", "Tabuelan", "Talisay City", "Toledo City", "Tuburan", "Tudela"],
        "Compostela Valley": ["Compostela", "Laak", "Mabini", "Maco", "Maragusan", "Mawab", "Monkayo", "Montevista", "Nabunturan", "New Bataan", "Pantukan"],
        "Cotabato": ["Alamada", "Aleosan", "Antipas", "Arakan", "Banisilan", "Carmen", "Kabacan", "Kidapawan City", "Libungan", "Magpet", "Makilala", "Matalam", "Midsayap", "M'lang", "Pigkawayan", "Pikit", "President Roxas", "Tulunan"],
        "Davao del Norte": ["Asuncion", "Braulio E. Dujali", "Carmen", "Kapalong", "New Corella", "Panabo City", "Samal City", "San Isidro", "Santo Tomas", "Tagum City", "Talaingod"],
        "Davao del Sur": ["Bansalan", "Davao City", "Digos City", "Don Marcelino", "Hagonoy", "Jose Abad Santos", "Kiblawan", "Magsaysay", "Malalag", "Malita", "Matanao", "Padada", "Santa Cruz", "Santa Maria", "Sarangani", "Sulop"],
        "Davao Occidental": ["Don Marcelino", "Jose Abad Santos", "Malita", "Santa Maria", "Sarangani"],
        "Davao Oriental": ["Baganga", "Banaybanay", "Boston", "Caraga", "Cateel", "Governor Generoso", "Lupon", "Manay", "Mati City", "San Isidro", "Tarragona"],
        "Dinagat Islands": ["Basilisa", "Cagdianao", "Dinagat", "Libjo", "Loreto", "San Jose", "Tubajon"],
        "Eastern Samar": ["Arteche", "Balangiga", "Balangkayan", "Borongan City", "Can-avid", "Dolores", "General MacArthur", "Giporlos", "Guiuan", "Hernani", "Jipapad", "Lawaan", "Llorente", "Maslog", "Maydolong", "Mercedes", "Oras", "Quinapondan", "Salcedo", "San Julian", "San Policarpo", "Sulat", "Taft"],
        "Guimaras": ["Buenavista", "Jordan", "Nueva Valencia", "San Lorenzo", "Sibunag"],
        "Ifugao": ["Aguinaldo", "Alfonso Lista", "Asipulo", "Banaue", "Hingyon", "Hungduan", "Kiangan", "Lagawe", "Lamut", "Mayoyao", "Tinoc"],
        "Ilocos Norte": ["Adams", "Bacarra", "Badoc", "Bangui", "Banna", "Batac City", "Burgos", "Carasi", "Currimao", "Dingras", "Dumalneg", "Laoag City", "Marcos", "Nueva Era", "Pagudpud", "Paoay", "Pasuquin", "Piddig", "Pinili", "San Nicolas", "Sarrat", "Solsona", "Vintar"],
        "Ilocos Sur": ["Alilem", "Banayoyo", "Bantay", "Burgos", "Cabugao", "Candon City", "Caoayan", "Cervantes", "Galimuyod", "Gregorio Del Pilar", "Lidlidda", "Magsingal", "Nagbukel", "Narvacan", "Quirino", "Salcedo", "San Emilio", "San Esteban", "San Ildefonso", "San Juan", "San Vicente", "Santa", "Santa Catalina", "Santa Cruz", "Santa Lucia", "Santa Maria", "Santiago", "Santo Domingo", "Sigay", "Sinait", "Sugpon", "Suyo", "Tagudin"],
        "Iloilo": ["Ajuy", "Alimodian", "Anilao", "Badiangan", "Balasan", "Banate", "Barotac Nuevo", "Barotac Viejo", "Batad", "Bingawan", "Cabatuan", "Calinog", "Carles", "Concepcion", "Dingle", "Dueñas", "Dumangas", "Estancia", "Guimbal", "Igbaras", "Iloilo City", "Janiuay", "Lambunao", "Leganes", "Lemery", "Leon", "Maasin", "Miagao", "Mina", "New Lucena", "Oton", "Passi City", "Pavia", "Pototan", "San Dionisio", "San Enrique", "San Joaquin", "San Miguel", "San Rafael", "Santa Barbara", "Sara", "Tigbauan", "Tubungan", "Zarraga"],
        "Isabela": ["Alicia", "Angadanan", "Aurora", "Benito Soliven", "Burgos", "Cabagan", "Cabatuan", "Cordon", "Delfin Albano", "Dinapigue", "Divilacan", "Echague", "Gamu", "Ilagan City", "Jones", "Luna", "Maconacon", "Mallig", "Naguilian", "Palanan", "Quezon", "Quirino", "Ramon", "Reina Mercedes", "Roxas", "San Agustin", "San Guillermo", "San Isidro", "San Manuel", "San Mariano", "San Mateo", "San Pablo", "Santa Maria", "Santiago City", "Santo Tomas", "Tumauini"],
        "Kalinga": ["Balbalan", "Lubuagan", "Pasil", "Pinukpuk", "Rizal", "Tabuk City", "Tanudan", "Tinglayan"],
        "La Union": ["Agoo", "Aringay", "Bacnotan", "Bagulin", "Balaoan", "Bangar", "Bauang", "Burgos", "Caba", "Luna", "Naguilian", "Pugo", "Rosario", "San Fernando City", "San Gabriel", "San Juan", "Santo Tomas", "Santol", "Sudipen", "Tubao"],
        "Laguna": ["Alaminos", "Bay", "Biñan City", "Cabuyao City", "Calamba City", "Calauan", "Cavinti", "Famy", "Kalayaan", "Liliw", "Los Baños", "Luisiana", "Lumban", "Mabitac", "Magdalena", "Majayjay", "Nagcarlan", "Paete", "Pagsanjan", "Pakil", "Pangil", "Pila", "Rizal", "San Pablo City", "San Pedro City", "Santa Cruz", "Santa Maria", "Santa Rosa City", "Siniloan", "Victoria"],
        "Lanao del Norte": ["Bacolod", "Baloi", "Baroy", "Iligan City", "Kapatagan", "Kauswagan", "Kolambugan", "Lala", "Linamon", "Magsaysay", "Maigo", "Matungao", "Munai", "Nunungan", "Pantao Ragat", "Pantar", "Poona Piagapo", "Salvador", "Sapad", "Sultan Naga Dimaporo", "Tagoloan", "Tangcal", "Tubod"],
        "Lanao del Sur": ["Amai Manabilang", "Bacolod-Kalawi", "Balabagan", "Balindong", "Bayang", "Binidayan", "Buadiposo-Buntong", "Bubong", "Butig", "Calanogas", "Ditsaan-Ramain", "Ganassi", "Kapai", "Kapatagan", "Lumba-Bayabao", "Lumbaca-Unayan", "Lumbatan", "Lumbayanague", "Madalum", "Madamba", "Maguing", "Malabang", "Marantao", "Marawi City", "Marogong", "Masiu", "Mulondo", "Pagayawan", "Piagapo", "Picong", "Poona Bayabao", "Pualas", "Saguiaran", "Sultan Dumalondong", "Tagoloan II", "Tamparan", "Taraka", "Tubaran", "Tugaya", "Wao"],
        "Leyte": ["Abuyog", "Alangalang", "Albuera", "Babatngon", "Barugo", "Bato", "Baybay City", "Burauen", "Calubian", "Capoocan", "Carigara", "Dagami", "Dulag", "Hilongos", "Hindang", "Inopacan", "Isabel", "Jaro", "Javier", "Julita", "Kananga", "La Paz", "Leyte", "MacArthur", "Mahaplag", "Matag-ob", "Matalom", "Mayorga", "Merida", "Ormoc City", "Palo", "Palompon", "Pastrana", "San Isidro", "San Miguel", "Santa Fe", "Tabango", "Tabontabon", "Tacloban City", "Tanauan", "Tolosa", "Tunga", "Villaba"],
        "Maguindanao": ["Ampatuan", "Barira", "Buldon", "Buluan", "Cotabato City", "Datu Abdullah Sangki", "Datu Anggal Midtimbang", "Datu Blah T. Sinsuat", "Datu Hoffer Ampatuan", "Datu Montawal", "Datu Odin Sinsuat", "Datu Paglas", "Datu Piang", "Datu Salibo", "Datu Saudi-Ampatuan", "Datu Unsay", "General Salipada K. Pendatun", "Guindulungan", "Kabuntalan", "Mamasapano", "Mangudadatu", "Matanog", "Northern Kabuntalan", "Pagalungan", "Paglat", "Pandag", "Parang", "Rajah Buayan", "Shariff Aguak", "Shariff Saydona Mustapha", "South Upi", "Sultan Kudarat", "Sultan Mastura", "Sultan sa Barongis", "Talayan", "Talitay", "Upi"],
        "Marinduque": ["Boac", "Buenavista", "Gasan", "Mogpog", "Santa Cruz", "Torrijos"],
        "Masbate": ["Aroroy", "Baleno", "Balud", "Batuan", "Cataingan", "Cawayan", "Claveria", "Dimasalang", "Esperanza", "Mandaon", "Masbate City", "Milagros", "Mobo", "Monreal", "Palanas", "Pio V. Corpuz", "Placer", "San Fernando", "San Jacinto", "San Pascual", "Uson"],
        "Metro Manila": ["Caloocan City", "Las Piñas City", "Makati City", "Malabon City", "Mandaluyong City", "Manila", "Marikina City", "Muntinlupa City", "Navotas City", "Parañaque City", "Pasay City", "Pasig City", "Pateros", "Quezon City", "San Juan City", "Taguig City", "Valenzuela City"],
        "Misamis Occidental": ["Aloran", "Baliangao", "Bonifacio", "Calamba", "Clarin", "Concepcion", "Don Victoriano Chiongbian", "Jimenez", "Lopez Jaena", "Oroquieta City", "Ozamiz City", "Panaon", "Plaridel", "Sapang Dalaga", "Sinacaban", "Tangub City", "Tudela"],
        "Misamis Oriental": ["Alubijid", "Balingasag", "Balingoan", "Binuangan", "Cagayan de Oro City", "Claveria", "El Salvador City", "Gingoog City", "Gitagum", "Initao", "Jasaan", "Kinoguitan", "Lagonglong", "Laguindingan", "Libertad", "Lugait", "Magsaysay", "Manticao", "Medina", "Naawan", "Opol", "Salay", "Sugbongcogon", "Tagoloan", "Talisayan", "Villanueva"],
        "Mountain Province": ["Barlig", "Bauko", "Besao", "Bontoc", "Natonin", "Paracelis", "Sabangan", "Sadanga", "Sagada", "Tadian"],
        "Negros Occidental": ["Bacolod City", "Bago City", "Binalbagan", "Cadiz City", "Calatrava", "Candoni", "Cauayan", "Enrique B. Magalona", "Escalante City", "Himamaylan City", "Hinigaran", "Hinoba-an", "Ilog", "Isabela", "Kabankalan City", "La Carlota City", "La Castellana", "Manapla", "Moises Padilla", "Murcia", "Pontevedra", "Pulupandan", "Sagay City", "Salvador Benedicto", "San Carlos City", "San Enrique", "Silay City", "Sipalay City", "Talisay City", "Toboso", "Valladolid", "Victorias City"],
        "Negros Oriental": ["Amlan", "Ayungon", "Bacong", "Bais City", "Basay", "Bayawan City", "Bindoy", "Canlaon City", "Dauin", "Dumaguete City", "Guihulngan City", "Jimalalud", "La Libertad", "Mabinay", "Manjuyod", "Pamplona", "San Jose", "Santa Catalina", "Siaton", "Sibulan", "Tanjay City", "Tayasan", "Valencia", "Vallehermoso", "Zamboanguita"],
        "Northern Samar": ["Allen", "Biri", "Bobon", "Capul", "Catarman", "Catubig", "Gamay", "Laoang", "Lapinig", "Las Navas", "Lavezares", "Lope de Vega", "Mapanas", "Mondragon", "Palapag", "Pambujan", "Rosario", "San Antonio", "San Isidro", "San Jose", "San Roque", "San Vicente", "Silvino Lobos", "Victoria"],
        "Nueva Ecija": ["Aliaga", "Bongabon", "Cabiao", "Cabanatuan City", "Cabiao", "Carranglan", "Cuyapo", "Gabaldon", "Gapan City", "General Mamerto Natividad", "General Tinio", "Guimba", "Jaen", "Laur", "Licab", "Llanera", "Lupao", "Nampicuan", "Pantabangan", "Peñaranda", "Quezon", "Rizal", "San Antonio", "San Isidro", "San Jose City", "San Leonardo", "Santa Rosa", "Santo Domingo", "Science City of Muñoz", "Talavera", "Talugtug", "Zaragoza"],
        "Nueva Vizcaya": ["Alfonso Castañeda", "Ambaguio", "Aritao", "Bagabag", "Bambang", "Bayombong", "Diadi", "Dupax del Norte", "Dupax del Sur", "Kasibu", "Kayapa", "Quezon", "Santa Fe", "Solano", "Villaverde"],
        "Occidental Mindoro": ["Abra de Ilog", "Calintaan", "Looc", "Lubang", "Magsaysay", "Mamburao", "Paluan", "Rizal", "Sablayan", "San Jose", "Santa Cruz"],
        "Oriental Mindoro": ["Baco", "Bansud", "Bongabong", "Bulalacao", "Calapan City", "Gloria", "Mansalay", "Naujan", "Pinamalayan", "Pola", "Puerto Galera", "Roxas", "San Teodoro", "Socorro", "Victoria"],
        "Palawan": ["Aborlan", "Agutaya", "Araceli", "Balabac", "Bataraza", "Brooke's Point", "Busuanga", "Cagayancillo", "Coron", "Culion", "Cuyo", "Dumaran", "El Nido", "Kalayaan", "Linapacan", "Magsaysay", "Narra", "Puerto Princesa City", "Quezon", "Rizal", "Roxas", "San Vicente", "Sofronio Española", "Taytay"],
        "Pampanga": ["Angeles City", "Apalit", "Arayat", "Bacolor", "Candaba", "Floridablanca", "Guagua", "Lubao", "Mabalacat City", "Macabebe", "Magalang", "Masantol", "Mexico", "Minalin", "Porac", "San Fernando City", "San Luis", "San Simon", "Santa Ana", "Santa Rita", "Santo Tomas", "Sasmuan"],
        "Pangasinan": ["Agno", "Aguilar", "Alaminos City", "Alcala", "Anda", "Asingan", "Balungao", "Bani", "Basista", "Bautista", "Bayambang", "Binalonan", "Binmaley", "Bolinao", "Bugallon", "Burgos", "Calasiao", "Dagupan City", "Dasol", "Infanta", "Labrador", "Laoac", "Lingayen", "Mabini", "Malasiqui", "Manaoag", "Mangaldan", "Mangatarem", "Mapandan", "Natividad", "Pozorrubio", "Rosales", "San Carlos City", "San Fabian", "San Jacinto", "San Manuel", "San Nicolas", "San Quintin", "Santa Barbara", "Santa Maria", "Santo Tomas", "Sison", "Sual", "Tayug", "Umingan", "Urbiztondo", "Urdaneta City", "Villasis"],
        "Quezon": ["Agdangan", "Alabat", "Atimonan", "Buenavista", "Burdeos", "Calauag", "Candelaria", "Catanauan", "Dolores", "General Luna", "General Nakar", "Guinayangan", "Gumaca", "Infanta", "Jomalig", "Lopez", "Lucban", "Lucena City", "Macalelon", "Mauban", "Mulanay", "Padre Burgos", "Pagbilao", "Panukulan", "Patnanungan", "Perez", "Pitogo", "Plaridel", "Polillo", "Quezon", "Real", "Sampaloc", "San Andres", "San Antonio", "San Francisco", "San Narciso", "Sariaya", "Tagkawayan", "Tayabas City", "Tiaong", "Unisan"],
        "Quirino": ["Aglipay", "Cabarroguis", "Diffun", "Maddela", "Nagtipunan", "Saguday"],
        "Rizal": ["Angono", "Antipolo City", "Baras", "Binangonan", "Cainta", "Cardona", "Jalajala", "Morong", "Pililla", "Rodriguez", "San Mateo", "Tanay", "Taytay", "Teresa"],
        "Romblon": ["Alcantara", "Banton", "Cajidiocan", "Calatrava", "Concepcion", "Corcuera", "Ferrol", "Looc", "Magdiwang", "Odiongan", "Romblon", "San Agustin", "San Andres", "San Fernando", "San Jose", "Santa Fe", "Santa Maria"],
        "Samar": ["Almagro", "Basey", "Calbayog City", "Calbiga", "Catbalogan City", "Daram", "Gandara", "Hinabangan", "Jiabong", "Marabut", "Matuguinao", "Motiong", "Pagsanghan", "Paranas", "Pinabacdao", "San Jorge", "San Jose de Buan", "San Sebastian", "Santa Margarita", "Santa Rita", "Santo Niño", "Tagapul-an", "Talalora", "Tarangnan", "Villareal", "Zumarraga"],
        "Sarangani": ["Alabel", "Glan", "Kiamba", "Maasim", "Maitum", "Malapatan", "Malungon"],
        "Siquijor": ["Enrique Villanueva", "Larena", "Lazi", "Maria", "San Juan", "Siquijor"],
        "Sorsogon": ["Barcelona", "Bulan", "Bulusan", "Casiguran", "Castilla", "Donsol", "Gubat", "Irosin", "Juban", "Magallanes", "Matnog", "Pilar", "Prieto Diaz", "Santa Magdalena", "Sorsogon City"],
        "South Cotabato": ["Banga", "General Santos City", "Koronadal City", "Lake Sebu", "Norala", "Polomolok", "Santo Niño", "Surallah", "T'boli", "Tampakan", "Tantangan", "Tupi"],
        "Southern Leyte": ["Anahawan", "Bontoc", "Hinunangan", "Hinundayan", "Libagon", "Liloan", "Limasawa", "Maasin City", "Macrohon", "Malitbog", "Padre Burgos", "Pintuyan", "Saint Bernard", "San Francisco", "San Juan", "San Ricardo", "Silago", "Sogod", "Tomas Oppus"],
        "Sultan Kudarat": ["Bagumbayan", "Columbio", "Esperanza", "Isulan", "Kalamansig", "Lambayong", "Lebak", "Lutayan", "Palimbang", "President Quirino", "Senator Ninoy Aquino", "Tacurong City"],
        "Sulu": ["Hadji Panglima Tahil", "Indanan", "Jolo", "Kalingalan Caluang", "Lugus", "Luuk", "Maimbung", "Old Panamao", "Omar", "Pandami", "Panglima Estino", "Pangutaran", "Parang", "Pata", "Patikul", "Siasi", "Talipao", "Tapul"],
        "Surigao del Norte": ["Alegria", "Bacuag", "Burgos", "Claver", "Dapa", "Del Carmen", "General Luna", "Gigaquit", "Mainit", "Malimono", "Pilar", "Placer", "San Benito", "San Francisco", "San Isidro", "Santa Monica", "Sison", "Socorro", "Surigao City", "Tagana-an", "Tubod"],
        "Surigao del Sur": ["Barobo", "Bayabas", "Bislig City", "Cagwait", "Cantilan", "Carmen", "Carrascal", "Cortes", "Hinatuan", "Lanuza", "Lianga", "Lingig", "Madrid", "Marihatag", "San Agustin", "San Miguel", "Tagbina", "Tago", "Tandag City"],
        "Tarlac": ["Anao", "Bamban", "Camiling", "Capas", "Concepcion", "Gerona", "La Paz", "Mayantoc", "Moncada", "Paniqui", "Pura", "Ramos", "San Clemente", "San Jose", "San Manuel", "Santa Ignacia", "Tarlac City", "Victoria"],
        "Tawi-Tawi": ["Bongao", "Languyan", "Mapun", "Panglima Sugala", "Sapa-Sapa", "Sibutu", "Simunul", "Sitangkai", "South Ubian", "Tandubas", "Turtle Islands"],
        "Zambales": ["Botolan", "Cabangan", "Candelaria", "Castillejos", "Iba", "Masinloc", "Olongapo City", "Palauig", "San Antonio", "San Felipe", "San Marcelino", "San Narciso", "Santa Cruz", "Subic"],
        "Zamboanga del Norte": ["Baliguian", "Dapitan City", "Dipolog City", "Godod", "Gutalac", "Jose Dalman", "Kalawit", "Katipunan", "La Libertad", "Labason", "Liloy", "Manukan", "Mutia", "Piñan", "Polanco", "President Manuel A. Roxas", "Rizal", "Salug", "Sergio Osmeña Sr.", "Siayan", "Sibuco", "Sibutad", "Sindangan", "Siocon", "Sirawai", "Tampilisan"],
        "Zamboanga del Sur": ["Aurora", "Bayog", "Dimataling", "Dinas", "Dumalinao", "Dumingag", "Guipos", "Josefina", "Kumalarang", "Labangan", "Lakewood", "Lapuyan", "Mahayag", "Margosatubig", "Midsalip", "Molave", "Pagadian City", "Pitogo", "Ramon Magsaysay", "San Miguel", "San Pablo", "Sominot", "Tabina", "Tambulig", "Tigbao", "Tukuran", "Vincenzo A. Sagun"],
        "Zamboanga Sibugay": ["Alicia", "Buug", "Diplahan", "Imelda", "Ipil", "Kabasalan", "Mabuhay", "Malangas", "Naga", "Olutanga", "Payao", "Roseller Lim", "Siay", "Talusan", "Titay", "Tungawan"]
    }


    // Function to update the barangay options based on the selected city
    function updateBrgyOptions() {
        // Clear previous options
        brgySelect.innerHTML = "<option value=''></option>";

        // Get the selected city
        var selectedCity = citySelect.value;

        // Check if the selected city has options defined
        if (options.hasOwnProperty(selectedCity)) {
            // Get the options for the selected city
            var cityOptions = options[selectedCity];

            // Create option elements and append them to the select element
            for (var i = 0; i < cityOptions.length; i++) {
                var option = document.createElement("option");
                option.value = cityOptions[i];
                option.textContent = cityOptions[i];
                brgySelect.appendChild(option);
            }
        }
    }

    // Attach event listener to the city select element
    citySelect.addEventListener("change", updateBrgyOptions);
</script>

<script>
    //setting button
    btn_TO = document.getElementById("to");
    btn_PO = document.getElementById("po");
    btn_PR = document.getElementById("pr");
    btn_AOC = document.getElementById("aoc");

    //setting the containers for the inputs
    // input_container_TO = getElementById("travel_order");
    // input_container_PO = getElementById("purchase_order");
    // input_container_PR = getElementById("purchase_request");
    // input_container_AOC = getElementById("abstract_of_canvas");
    document.getElementById("travel_order").style.display = "none";
    document.getElementById("purchase_order").style.display = "none";
    document.getElementById("purchase_request").style.display = "none";
    document.getElementById("abstract_of_canvas").style.display = "none";

    btn_TO.addEventListener("click", function () {
        document.getElementById("travel_order").style.display = "block";
        document.getElementById("purchase_order").style.display = "none";
        document.getElementById("purchase_request").style.display = "none";
        document.getElementById("abstract_of_canvas").style.display = "none";
    })
    btn_PO.addEventListener("click", function () {
        document.getElementById("travel_order").style.display = "none";
        document.getElementById("purchase_order").style.display = "block";
        document.getElementById("purchase_request").style.display = "none";
        document.getElementById("abstract_of_canvas").style.display = "none";
    })
    btn_PR.addEventListener("click", function () {
        document.getElementById("travel_order").style.display = "none";
        document.getElementById("purchase_order").style.display = "none";
        document.getElementById("purchase_request").style.display = "block";
        document.getElementById("abstract_of_canvas").style.display = "none";
    })
    btn_AOC.addEventListener("click", function () {
        document.getElementById("travel_order").style.display = "none";
        document.getElementById("purchase_order").style.display = "none";
        document.getElementById("purchase_request").style.display = "none";
        document.getElementById("abstract_of_canvas").style.display = "block";
    })
</script>