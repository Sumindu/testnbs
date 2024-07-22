<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            font-family: sans-serif;
        }
        .details-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .details-table th, .details-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details-table th {
            background-color: #f2f2f2;
        }
        .details-title {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.5em;
        }
        .card-title {
    margin-bottom: var(--bs-card-title-spacer-y);
    color: var(--bs-card-title-color);
    text-align: center;
    font-weight: bold;
    font-size: xxx-large;
}
    </style>
</head>
<body>

    <?php

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
        $dDateOfBirth = $_POST['dDateOfBirth'];
        $dDateJoined = $_POST['dDateJoined'];
        $dDateConfirmed = $_POST['dDateConfirmed'];
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
        $stmt = $conn->prepare("INSERT INTO Pay_GenEmployees (
            nCompanyID, 
            nCompanyNo, 
            cEPFNo, 
            cEmpNo, 
            nTitleID, 
            cInitials, 
            cLastName, 
            cOtherNames, 
            cUseName, 
            bSex, 
            dDateOfBirth, 
            dDateJoined, 
            dDateConfirmed, 
            cBirthPlace, 
            cBirthCountry, 
            cNICNo, 
            dNICIssueDate, 
            nEmpTypeID, 
            nDesignationID, /* Included Designation */
            nCurrentBasicSalary, 
            nPMonthSalary, 
            nJoinedSalary, 
            nLastIncrement, 
            dLastIncrementDate, 
            cPAddress1,  
            cBAddress1,  
            nBankID, 
            cBankAccountNo, 
            cBranchName, 
            cBranchCode, 
            nAmountForBank, 
            nNatID, 
            nRelID,
            nCivilStatusID
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Check if the prepare statement was successful
        if ($stmt === false) {
            die("Error preparing SQL statement: " . $conn->error);
        }

        // Bind parameters to the prepared statement
        $stmt->bind_param("iissssssiiisiiiiiiiiissddssiiisiii", 
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
           $nCivilStatusID);


        if ($stmt->execute() === TRUE) {
            // Redirect to index.php with success message
            header("Location: index.php?msg=add_success");
            exit;
        } else {
            header("Location: index.php?msg=add_fail");
            exit;
            echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
        }


        // Close the statement
        $stmt->close();
    }
    ?>
    <div class="container mt-5"> 
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <h1 class="card-title">Add New Employee Details</h1>
                    </div> 
                    <div class="card-body"> 
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <div class="details-title">Personal Information</div>
        <table class="details-table table"> 
            <tr>
                <th>Company ID</th>
                <td><input type="text" name="nCompanyID" class="form-control" required></td>
            </tr>
            <tr>
                <th>Company No</th>
                <td><input type="text" name="nCompanyNo" class="form-control" required></td>
            </tr>
            <tr>
                <th>EPF No</th>
                <td><input type="text" name="cEPFNo" class="form-control" required></td>
            </tr>
            <tr>
                <th>Employee No</th>
                <td><input type="text" name="cEmpNo" class="form-control" required></td>
            </tr>
            <tr>
                <th>Title</th>
                <td>
                    <select name="nTitleID" class="form-select" required>
                        <option value="">Select Title</option>
                        <?php
                        $titles = $conn->query("SELECT * FROM gen_RefCustomerTittle");
                        while ($title = $titles->fetch_assoc()) {
                            echo "<option value='" . $title['nTitleID'] . "'>" . $title['cTitle'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Initials</th>
                <td><input type="text" name="cInitials" class="form-control" required></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><input type="text" name="cLastName" class="form-control" required></td>
            </tr>
            <tr>
                <th>Other Names</th>
                <td><input type="text" name="cOtherNames" class="form-control"></td>
            </tr>
            <tr>
                <th>Use Name</th>
                <td><input type="text" name="cUseName" class="form-control" required></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td>
                    <select name="bSex" class="form-select" required>
                        <option value="">Select Sex</option>
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><input type="date" name="dDateOfBirth" class="form-control" required></td>
            </tr>
            <tr>
                <th>Date Joined</th>
                <td><input type="date" name="dDateJoined" class="form-control" required></td>
            </tr>
            <tr>
                <th>Date Confirmed</th>
                <td><input type="date" name="dDateConfirmed" class="form-control"></td>
            </tr>
            <tr>
                <th>Birth Place</th>
                <td><input type="text" name="cBirthPlace" class="form-control" ></td>
            </tr>
            <tr>
                <th>Birth Country</th>
                <td><input type="text" name="cBirthCountry" class="form-control" ></td>
            </tr>
            <tr>
                <th>NIC No</th>
                <td><input type="text" name="cNICNo" class="form-control" ></td>
            </tr>
            <tr>
                <th>NIC Issue Date</th>
                <td><input type="date" name="dNICIssueDate" class="form-control" ></td>
            </tr>
            <tr>
                <th>Civil Status</th>
                <td>
                    <select name="nCivilStatusID" class="form-select" required>
                        <option value="">Select Civil Status</option> 
                        <?php
                        $civilStatuses = $conn->query("SELECT * FROM gen_RefCivilStatus");
                        while ($civilStatus = $civilStatuses->fetch_assoc()) {
                            echo "<option value='" . $civilStatus['nCivilStatusID'] . "'>" . $civilStatus['cCivilStatus'] . "</option>";
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
                    <select name="nEmpTypeID" class="form-select" required>
                        <option value="">Select Employee Type</option>
                        <?php
                        $empTypes = $conn->query("SELECT * FROM Pay_RefEmpType");
                        while ($empType = $empTypes->fetch_assoc()) {
                            echo "<option value='" . $empType['nEmpTypeID'] . "'>" . $empType['cEmpType'] . "</option>";
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
                            echo "<option value='" . $designation['nDesignationID'] . "'>" . $designation['cDesignation'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Current Basic Salary</th>
                <td><input type="number" name="nCurrentBasicSalary" class="form-control"></td>
            </tr>
            <tr>
                <th>Previous Month Salary</th>
                <td><input type="number" name="nPMonthSalary" class="form-control"></td>
            </tr>
            <tr>
                <th>Joined Salary</th>
                <td><input type="number" name="nJoinedSalary" class="form-control"></td>
            </tr>
            <tr>
                <th>Last Increment</th>
                <td><input type="number" name="nLastIncrement" class="form-control"></td>
            </tr>
            <tr>
                <th>Last Increment Date</th>
                <td><input type="date" name="dLastIncrementDate" class="form-control"></td>
            </tr>
        </table>

        <div class="details-title">Contact Information</div>
        <table class="details-table table">
            <tr>
                <th>Permanent Address</th>
                <td><input type="text" name="cPAddress1" class="form-control"></td>
            </tr>
            <tr>
                <th>Present Address</th>
                <td><input type="text" name="cBAddress1" class="form-control"></td>
            </tr>
        </table>

        <div class="details-title">Bank Information</div>
        <table class="details-table table">
            <tr>
                <th>Bank Name</th>
                <td>
                    <select name="nBankID" class="form-select">
                        <option value="">Select Bank</option>
                        <?php
                        $banks = $conn->query("SELECT * FROM Pay_RefBanks");
                        while ($bank = $banks->fetch_assoc()) {
                            echo "<option value='" . $bank['nBankID'] . "'>" . $bank['cBankName'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Bank Account No</th>
                <td><input type="text" name="cBankAccountNo" class="form-control"></td>
            </tr>
            <tr>
                <th>Branch Name</th>
                <td><input type="text" name="cBranchName" class="form-control"></td>
            </tr>
            <tr>
                <th>Branch Code</th>
                <td><input type="text" name="cBranchCode" class="form-control"></td>
            </tr>
            <tr>
                <th>Amount for Bank</th>
                <td><input type="number" name="nAmountForBank" class="form-control"></td>
            </tr>
        </table>

        <div class="details-title">Additional Information</div>
        <table class="details-table table">
            <tr>
                <th>Religion</th>
                <td>
                    <select name="nRelID" class="form-select">
                        <option value="">Select Religion</option>
                        <?php
                        $religions = $conn->query("SELECT * FROM gen_RefReligion");
                        while ($religion = $religions->fetch_assoc()) {
                            echo "<option value='" . $religion['nReligionID'] . "'>" . $religion['cReligion'] . "</option>"; 
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>
                    <select name="nNatID" class="form-select"> 
                        <option value="">Select Nationality</option> 
                        <?php
                        $nationalities = $conn->query("SELECT * FROM gen_RefNationality");
                        while ($nationality = $nationalities->fetch_assoc()) {
                            echo "<option value='" . $nationality['nNationalityID'] . "'>" . $nationality['cNationality'] . "</option>"; 
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>

        <input type="submit" class="btn btn-primary btn-lg float-end" value="Save">
        <a href="index.php" class="btn btn-secondary btn-lg">Cancel</a>
    </form>
    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php
    $conn->close(); 
    ?>
</div>
</body>
</html>