<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
                body {
            /* padding: 20px; */
            font-family: sans-serif;
        }
        .card-title {
    margin-bottom: var(--bs-card-title-spacer-y);
    color: var(--bs-card-title-color);
    text-align: center;
    font-weight: bold;
    font-size: xxx-large;
}

        /* Improved Modal Styles */
        .modal-dialog {
            max-width: 800px; /* Adjusted modal width for better content display */
        }
        .modal-content {
            border-radius: 10px; /* Rounded corners for modal */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Added shadow effect */
        }
        .modal-header {
            background-color: #f0f0f0; /* Light background for modal header */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .modal-body {
            padding: 20px; 
            color: black; 
            overflow-y: auto; /* Make content scrollable if it overflows */
            max-height: max-content; /* Set a max height for modal body */
        }
        .modal-footer {
            background-color: #f0f0f0; 
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .details-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse; 
        }
        .details-table th, .details-table td {
            padding: 10px; /* Increased padding for better readability */
            border: 1px solid #ccc; /* Lighter border color */
            text-align: left; 
        }
        .details-table th {
            background-color: #e0e0e0; /* Light gray background for table header */
            font-weight: 600; /* Bolder font weight for table headers */
        }
        .details-table tr:nth-child(even) {
            background-color: #f5f5f5; /* Alternate row background color for improved readability */
        }
        .details-title {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.5em;
        }
    </style>
</head>
<body>

<?php
include 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get employee ID from query string
$employeeId = $_GET['employeeId'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

        // Collect form data
        $nCompanyID = $_POST['nCompanyID'];
        $nCompanyNo = $_POST['nCompanyNo'];
        $cEPFNo = $_POST['cEPFNo'];
        $cEmpNo = $_POST['cEmpNo'];
        $nTitleID = $_POST['nTitleID'];
        $cInitials = $_POST['cInitials'];
        $cLastName = $_POST['cLastName'];
        $cOtherNames = $_POST['cOtherNames'];
        $cUseName = $_POST['cUseName'];
        $bSex = $_POST['bSex'];
        $dDateOfBirth = $_POST['dDateOfBirth']; //
        $dDateJoined = $_POST['dDateJoined']; //
        $dDateConfirmed = $_POST['dDateConfirmed']; //
        $cBirthPlace = $_POST['cBirthPlace'];
        $cBirthCountry = $_POST['cBirthCountry'];
        $cNICNo = $_POST['cNICNo'];
        $dNICIssueDate = $_POST['dNICIssueDate'];
        $nEmpTypeID = $_POST['nEmpTypeID'];
        $nDesignationID = $_POST['nDesignationID']; // Added Designation 
        $nCurrentBasicSalary = $_POST['nCurrentBasicSalary'];
        $nPMonthSalary = $_POST['nPMonthSalary'];
        $nJoinedSalary = $_POST['nJoinedSalary'];
        $nLastIncrement = $_POST['nLastIncrement'];
        $dLastIncrementDate = $_POST['dLastIncrementDate'];
        $cPAddress1 = $_POST['cPAddress1'];
        $cBAddress1 = $_POST['cBAddress1'];
        $nBankID = $_POST['nBankID'];
        $cBankAccountNo = $_POST['cBankAccountNo'];
        $cBranchName = $_POST['cBranchName'];
        $cBranchCode = $_POST['cBranchCode'];
        $nAmountForBank = $_POST['nAmountForBank'];
        $nNatID = $_POST['nNatID'];
        $nRelID = $_POST['nRelID'];
        $nCivilStatusID = $_POST['nCivilStatusID']; 

        // Prepare and execute the SQL query (using prepared statements to prevent SQL injection)
        $stmt = $conn->prepare("UPDATE Pay_GenEmployees SET
            nCompanyID = ?, 
            nCompanyNo = ?, 
            cEPFNo = ?, 
            cEmpNo = ?, 
            nTitleID = ?, 
            cInitials = ?, 
            cLastName = ?, 
            cOtherNames = ?, 
            cUseName = ?, 
            bSex = ?, 
            dDateOfBirth = ?, 
            dDateJoined = ?, 
            dDateConfirmed = ?, 
            cBirthPlace = ?, 
            cBirthCountry = ?, 
            cNICNo = ?, 
            dNICIssueDate = ?, 
            nEmpTypeID = ?, 
            nDesignationID = ?, /* Included Designation */
            nCurrentBasicSalary = ?, 
            nPMonthSalary = ?, 
            nJoinedSalary = ?, 
            nLastIncrement = ?, 
            dLastIncrementDate = ?, 
            cPAddress1 = ?,  
            cBAddress1 = ?,  
            nBankID = ?, 
            cBankAccountNo = ?, 
            cBranchName = ?, 
            cBranchCode = ?, 
            nAmountForBank = ?, 
            nNatID = ?, 
            nRelID = ?,
            nCivilStatusID = ?
            WHERE nEmpID = ?"); 

        // Bind parameters to the prepared statement
        $stmt->bind_param("iissssssiiisiiiiiiiiissddssiiisiiii", 
           $nCompanyID, 
           $nCompanyNo, 
           $cEPFNo, 
           $cEmpNo, 
           $nTitleID, 
           $cInitials, 
           $cLastName, 
           $cOtherNames, 
           $cUseName, 
           $bSex, 
           $dDateOfBirth, 
           $dDateJoined, 
           $dDateConfirmed, 
           $cBirthPlace, 
           $cBirthCountry, 
           $cNICNo, 
           $dNICIssueDate, 
           $nEmpTypeID, 
           $nDesignationID, /* Bind Designation */
           $nCurrentBasicSalary, 
           $nPMonthSalary, 
           $nJoinedSalary, 
           $nLastIncrement, 
           $dLastIncrementDate, 
           $cPAddress1,  
           $cBAddress1,  
           $nBankID, 
           $cBankAccountNo, 
           $cBranchName, 
           $cBranchCode, 
           $nAmountForBank, 
           $nNatID, 
           $nRelID,
           $nCivilStatusID, 
           $employeeId
        );


        if ($stmt->execute() === TRUE) {
            echo "<div class='alert alert-success'>Record Updated successfully</div>";
            header("Location: home.php?msg=update_success");
            exit; // Ensure script stops after redirect
        } else {
            echo "<div class='alert alert-danger'>Error creating record: " . $stmt->error . "</div>";
            header("Location: home.php?msg=update_fail"); 
            exit;
        }

        // Close the statement
        $stmt->close();

}

// SQL query to fetch employee details - Fetch data with properly formatted dates 
$sql = "SELECT 
            e.nEmpID, 
            e.nCompanyID, 
            e.nCompanyNo, 
            e.cEPFNo, 
            e.cEmpNo,
            e.nTitleID, 
            e.cInitials, 
            e.cLastName, 
            e.cOtherNames, 
            e.cUseName, 
            e.bSex, 
            DATE_FORMAT(e.dDateOfBirth, '%Y-%m-%d') AS dDateOfBirth, /* Format date columns */ 
            DATE_FORMAT(e.dDateJoined, '%Y-%m-%d') AS dDateJoined, 
            DATE_FORMAT(e.dDateConfirmed, '%Y-%m-%d') AS dDateConfirmed,
            e.cBirthPlace, 
            e.cBirthCountry, 
            e.cNICNo, 
            DATE_FORMAT(e.dNICIssueDate, '%Y-%m-%d') AS dNICIssueDate,
            e.nEmpTypeID,
            nDesignationID, 
            e.nCurrentBasicSalary, 
            e.nPMonthSalary, 
            e.nJoinedSalary, 
            e.nLastIncrement, 
            DATE_FORMAT(e.dLastIncrementDate, '%Y-%m-%d') AS dLastIncrementDate,
            e.cPAddress1, 
            -- e.cPAddress2, 
            -- e.cPAddress3, 
            -- e.cPAddress4, 
            e.cBAddress1, 
            -- e.cBAddress2, 
            -- e.cBAddress3, 
            -- e.cBAddress4, 
            e.nBankID, 
            e.cBankAccountNo, 
            e.cBranchName, 
            e.cBranchCode, 
            e.nAmountForBank, 
            e.nNatID, 
            e.nRelID,
            e.nCivilStatusID, 
            t.cTitle,
            ty.cEmpType,
            s.cCivilStatus,
            nat.cNationality,
            rel.cReligon,
            b.cBankName
        FROM Pay_GenEmployees AS e
        LEFT JOIN gen_RefCustomerTittle AS t ON e.nTitleID = t.nTitleID
        LEFT JOIN Pay_RefEmpType AS ty ON e.nEmpTypeID = ty.nEmpTypeID
        LEFT JOIN gen_RefCivilStatus AS s ON e.nCivilStatusID = s.nCivilStatusID
        LEFT JOIN Pay_RefBanks AS b ON e.nBankID = b.nBankID
        LEFT JOIN gen_RefNationality AS nat ON e.nNatID = nat.nNationalityID
        LEFT JOIN gen_RefReligion AS rel ON e.nRelID = rel.nReligionID 
        WHERE e.nEmpID = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employeeId); 
$stmt->execute(); 
$result = $stmt->get_result();


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    ?>
    <div class="container mt-5"> 
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <h3 class="card-title">Update Employee Details</h3>
                    </div> 
                    <div class="card-body"> 

        <form method="POST" action="updateEmp.php?employeeId=<?php echo $employeeId; ?>">
            <div class="details-title">Personal Information</div>
            <table class="details-table table">
                <tr>
                    <th>Employee ID</th>
                    <td><?php echo $row['nEmpID']; ?></td>
                </tr>
                <tr>
                    <th>Company ID</th>
                    <td><input type="text" name="nCompanyID" value="<?php echo $row['nCompanyID']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Company No</th>
                    <td><input type="text" name="nCompanyNo" value="<?php echo $row['nCompanyNo']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>EPF No</th>
                    <td><input type="text" name="cEPFNo" value="<?php echo $row['cEPFNo']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Employee No</th>
                    <td><input type="text" name="cEmpNo" value="<?php echo $row['cEmpNo']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>
                        <select name="nTitleID" class="form-select"> 
                            <?php
                            $titles = $conn->query("SELECT * FROM gen_RefCustomerTittle");
                            while ($title = $titles->fetch_assoc()) {
                                $selected = ($title['nTitleID'] == $row['nTitleID']) ? 'selected' : '';
                                echo "<option value='" . $title['nTitleID'] . "' $selected>" . $title['cTitle'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Initials</th>
                    <td><input type="text" name="cInitials" value="<?php echo $row['cInitials']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input type="text" name="cLastName" value="<?php echo $row['cLastName']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Other Names</th>
                    <td><input type="text" name="cOtherNames" value="<?php echo $row['cOtherNames']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Use Name</th>
                    <td><input type="text" name="cUseName" value="<?php echo $row['cUseName']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>
                        <select name="bSex" class="form-select">
                            <option value="1" <?php echo ($row['bSex'] == 1) ? 'selected' : ''; ?>>Male</option>
                            <option value="0" <?php echo ($row['bSex'] == 0) ? 'selected' : ''; ?>>Female</option> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>
                        <!-- <input type="date" name="dDateOfBirth" value="<?= $row['dDateOfBirth']; ?>" class="form-control" required>  -->
                        <input type="date" name="dDateOfBirth" value="<?= date('Y-m-d', strtotime($row['dDateOfBirth'])) ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>Date Joined</th>
                    <td><input type="date" name="dDateJoined" value="<?= $row['dDateJoined'] ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Date Confirmed</th>
                    <td><input type="date" name="dDateConfirmed" value="<?= $row['dDateConfirmed'] ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Birth Place</th>
                    <td><input type="text" name="cBirthPlace" value="<?php echo $row['cBirthPlace']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Birth Country</th>
                    <td><input type="text" name="cBirthCountry" value="<?php echo $row['cBirthCountry']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>NIC No</th>
                    <td><input type="text" name="cNICNo" value="<?php echo $row['cNICNo']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>NIC Issue Date</th>
                    <td><input type="date" name="dNICIssueDate" value="<?= $row['dNICIssueDate'] ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Civil Status</th>
                    <td>
                        <select name="nCivilStatusID" class="form-select"> 
                            <?php
                            $civilStatuses = $conn->query("SELECT * FROM gen_RefCivilStatus");
                            while ($civilStatus = $civilStatuses->fetch_assoc()) {
                                $selected = ($civilStatus['nCivilStatusID'] == $row['nCivilStatusID']) ? 'selected' : '';
                                echo "<option value='" . $civilStatus['nCivilStatusID'] . "' $selected>" . $civilStatus['cCivilStatus'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                <th>Designation</th> 
                <td> 
                    <select name="nDesignationID" class="form-select" required>
                        <option value="">Select Designation</option>
                        <?php
                        $designations = $conn->query("SELECT * FROM Pay_RefDesignations");
                        while ($designation = $designations->fetch_assoc()) {
                            $selected = ($designation['nDesignationID'] == $row['nDesignationID']) ? 'selected' : '';
                            echo "<option value='" . $designation['nDesignationID'] . "'$selected>" . $designation['cDesignation'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
                </tr>
            </table>
            <div class="details-title">Employment Information</div>
            <table class="details-table table">
                <tr>
                    <th>Employee Type</th>
                    <td>
                        <select name="nEmpTypeID" class="form-select"> 
                            <?php
                            $empTypes = $conn->query("SELECT * FROM Pay_RefEmpType");
                            while ($empType = $empTypes->fetch_assoc()) {
                                $selected = ($empType['nEmpTypeID'] == $row['nEmpTypeID']) ? 'selected' : '';
                                echo "<option value='" . $empType['nEmpTypeID'] . "' $selected>" . $empType['cEmpType'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Current Basic Salary</th>
                    <td><input type="text" name="nCurrentBasicSalary" value="<?php echo $row['nCurrentBasicSalary']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Previous Month Salary</th>
                    <td><input type="text" name="nPMonthSalary" value="<?php echo $row['nPMonthSalary']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Joined Salary</th>
                    <td><input type="text" name="nJoinedSalary" value="<?php echo $row['nJoinedSalary']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Last Increment</th>
                    <td><input type="text" name="nLastIncrement" value="<?php echo $row['nLastIncrement']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Last Increment Date</th>
                    <td><input type="date" name="dLastIncrementDate" value="<?= $row['dLastIncrementDate'] ?>" class="form-control"></td>
                </tr>
            </table> 

            <div class="details-title">Contact Information</div>
            <table class="details-table table">
                <tr>
                    <th>Permanent Address</th>
                    <td><input type="text" name="cPAddress1" value="<?php echo $row['cPAddress1']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Present Address</th>
                    <td><input type="text" name="cBAddress1" value="<?php echo $row['cBAddress1']; ?>" class="form-control"></td>
                </tr>
            </table>

            <div class="details-title">Bank Information</div>
            <table class="details-table table">
                <tr>
                    <th>Bank Name</th>
                    <td>
                        <select name="nBankID" class="form-select"> 
                            <?php
                            $banks = $conn->query("SELECT * FROM Pay_RefBanks");
                            while ($bank = $banks->fetch_assoc()) {
                                $selected = ($bank['nBankID'] == $row['nBankID']) ? 'selected' : '';
                                echo "<option value='" . $bank['nBankID'] . "' $selected>" . $bank['cBankName'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Bank Account No</th>
                    <td><input type="text" name="cBankAccountNo" value="<?php echo $row['cBankAccountNo']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Branch Name</th>
                    <td><input type="text" name="cBranchName" value="<?php echo $row['cBranchName']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Branch Code</th>
                    <td><input type="text" name="cBranchCode" value="<?php echo $row['cBranchCode']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Amount for Bank</th>
                    <td><input type="text" name="nAmountForBank" value="<?php echo $row['nAmountForBank']; ?>" class="form-control"></td>
                </tr>
            </table> 

            <div class="details-title">Additional Information</div>
            <table class="details-table table">
                <tr>
                    <th>Religion</th>
                    <td>
                        <select name="nRelID" class="form-select"> 
                            <?php
                            $religions = $conn->query("SELECT * FROM gen_RefReligion");
                            while ($religion = $religions->fetch_assoc()) {
                                $selected = ($religion['nReligionID'] == $row['nRelID']) ? 'selected' : '';
                                echo "<option value='" . $religion['nReligionID'] . "' $selected>" . $religion['cReligion'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Nationality</th>
                    <td> 
                        <select name="nNatID" class="form-select"> 
                            <?php
                            $nationalities = $conn->query("SELECT * FROM gen_RefNationality");
                            while ($nationality = $nationalities->fetch_assoc()) {
                                $selected = ($nationality['nNationalityID'] == $row['nNatID']) ? 'selected' : '';
                                echo "<option value='" . $nationality['nNationalityID'] . "' $selected>" . $nationality['cNationality'] . "</option>";
                            }
                            ?>
                        </select> 
                    </td> 
                </tr> 
            </table>


            <input type="submit" class="btn btn-primary btn-lg float-end" value="Update">
            <a href="home.php" class="btn btn-secondary btn-lg">Cancel</a>
        </form> 

                    </div> 
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
} else {
    echo "<p>No employee details found.</p>";
}

$stmt->close(); 
$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html> 