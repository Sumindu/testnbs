<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
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

// Prepare SQL statement using placeholders
$sql = "SELECT 
            e.nEmpID, e.nCompanyID, e.nCompanyNo, e.cEPFNo, 
            e.cEmpNo, e.nTitleID, e.cInitials, e.cLastName, 
            e.cOtherNames, e.cUseName, e.bSex, 
            e.dDateOfBirth, e.dDateJoined, e.dDateConfirmed, 
            e.cBirthPlace, e.cBirthCountry, e.cNICNo, e.dNICIssueDate,
            e.nEmpTypeID, e.nDesignationID, /* Include Designation */ 
            e.nCurrentBasicSalary, e.nPMonthSalary, 
            e.nJoinedSalary, e.nLastIncrement, e.dLastIncrementDate, 
            e.cPAddress1, e.cPAddress2, e.cPAddress3, e.cPAddress4, 
            e.cBAddress1, e.cBAddress2, e.cBAddress3, e.cBAddress4, 
            e.nBankID, e.cBankAccountNo, e.cBranchName, e.cBranchCode, 
            e.nAmountForBank, e.nNatID, e.nRelID, e.nCivilStatusID,
            t.cTitle, ty.cEmpType, s.cCivilStatus, 
            b.cBankName, nat.cNationality, rel.cReligon
        FROM Pay_GenEmployees AS e
        LEFT JOIN gen_RefCustomerTittle AS t ON e.nTitleID = t.nTitleID
        LEFT JOIN Pay_RefEmpType AS ty ON e.nEmpTypeID = ty.nEmpTypeID
        LEFT JOIN gen_RefCivilStatus AS s ON e.nCivilStatusID = s.nCivilStatusID
        LEFT JOIN Pay_RefBanks AS b ON e.nBankID = b.nBankID
        LEFT JOIN gen_RefNationality AS nat ON e.nNatID = nat.nNationalityID
        LEFT JOIN gen_RefReligion AS rel ON e.nRelID = rel.nReligionID
        WHERE e.nEmpID = ?"; 

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employeeId);
$stmt->execute();
$result = $stmt->get_result();

// Handle the query result
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    ?>
    <div class="container mt-5"> 
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <h3 class="card-title">Employee Details</h3>
                    </div> 
                    <div class="card-body">
                        <div class='details-title'>Personal Information</div>
                        <table class='details-table'> 
                            <tr><th>Employee ID</th><td><?= $row['nEmpID'] ?></td></tr>
                            <tr><th>Company ID</th><td><?= $row['nCompanyID'] ?></td></tr>
                            <tr><th>Company No</th><td><?= $row['nCompanyNo'] ?></td></tr>
                            <tr><th>EPF No</th><td><?= $row['cEPFNo'] ?></td></tr>
                            <tr><th>Employee No</th><td><?= $row['cEmpNo'] ?></td></tr>
                            <tr><th>Title</th><td><?= $row['cTitle'] ?></td></tr>
                            <tr><th>Initials</th><td><?= $row['cInitials'] ?></td></tr>
                            <tr><th>Last Name</th><td><?= $row['cLastName'] ?></td></tr>
                            <tr><th>Other Names</th><td><?= $row['cOtherNames'] ?></td></tr>
                            <tr><th>Use Name</th><td><?= $row['cUseName'] ?></td></tr>
                            <tr><th>Sex</th><td><?= $row['bSex'] ? 'Male' : 'Female' ?></td></tr>
                            <tr><th>Date of Birth</th><td><?= $row['dDateOfBirth'] ?></td></tr>
                            <tr><th>Date Joined</th><td><?= $row['dDateJoined'] ?></td></tr>
                            <tr><th>Date Confirmed</th><td><?= $row['dDateConfirmed'] ?></td></tr>
                            <tr><th>Birth Place</th><td><?= $row['cBirthPlace'] ?></td></tr>
                            <tr><th>Birth Country</th><td><?= $row['cBirthCountry'] ?></td></tr>
                            <tr><th>NIC No</th><td><?= $row['cNICNo'] ?></td></tr>
                            <tr><th>NIC Issue Date</th><td><?= $row['dNICIssueDate'] ?></td></tr>
                            <tr><th>Civil Status</th><td><?= $row['cCivilStatus'] ?></td></tr>
                        </table>

                        <div class='details-title'>Employment Information</div>
                        <table class='details-table'>
                            <tr><th>Employee Type</th><td><?= $row['cEmpType'] ?></td></tr>
                            <tr><th>Designation</th><td><?= $row['nDesignationID'] ?></td></tr>
                            <tr><th>Current Basic Salary</th><td><?= $row['nCurrentBasicSalary'] ?></td></tr>
                            <tr><th>Previous Month Salary</th><td><?= $row['nPMonthSalary'] ?></td></tr>
                            <tr><th>Joined Salary</th><td><?= $row['nJoinedSalary'] ?></td></tr>
                            <tr><th>Last Increment</th><td><?= $row['nLastIncrement'] ?></td></tr>
                            <tr><th>Last Increment Date</th><td><?= $row['dLastIncrementDate'] ?></td></tr>
                        </table>
                       
                        <div class='details-title'>Contact Information</div>
                        <table class='details-table'>
                            <tr>
                                <th>Permanent Address</th>
                                <td>
                                    <?= $row['cPAddress1'] ?>
                                    <?php if (!empty($row['cPAddress2'])) : ?>
                                        <?= ', ' . $row['cPAddress2'] ?>
                                    <?php endif; ?>
                                    <?php if (!empty($row['cPAddress3'])) : ?>
                                        <?= ', ' . $row['cPAddress3'] ?>
                                    <?php endif; ?>
                                    <?php if (!empty($row['cPAddress4'])) : ?>
                                        <?= ', ' . $row['cPAddress4'] ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Present Address</th>
                                <td>
                                    <?= $row['cBAddress1'] ?>
                                    <?php if (!empty($row['cBAddress2'])) : ?>
                                        <?= ', ' . $row['cBAddress2'] ?>
                                    <?php endif; ?>
                                    <?php if (!empty($row['cBAddress3'])) : ?>
                                        <?= ', ' . $row['cBAddress3'] ?>
                                    <?php endif; ?>
                                    <?php if (!empty($row['cBAddress4'])) : ?>
                                        <?= ', ' . $row['cBAddress4'] ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table> 

                        <div class='details-title'>Bank Information</div>
                        <table class='details-table'>
                            <tr><th>Bank Name</th><td><?= $row['cBankName'] ?></td></tr>
                            <tr><th>Bank Account No</th><td><?= $row['cBankAccountNo'] ?></td></tr>
                            <tr><th>Branch Name</th><td><?= $row['cBranchName'] ?></td></tr>
                            <tr><th>Branch Code</th><td><?= $row['cBranchCode'] ?></td></tr>
                            <tr><th>Amount for Bank</th><td><?= $row['nAmountForBank'] ?></td></tr>
                        </table>
                       
                        <div class='details-title'>Additional Information</div>
                        <table class='details-table'>
                            <tr><th>Religion</th><td><?= $row['cReligon'] ?></td></tr>
                            <tr><th>Nationality</th><td><?= $row['cNationality'] ?></td></tr>
                        </table>
                        <a href='updateEmp.php?employeeId=<?= $row['nEmpID'] ?>' class='btn btn-primary btn-lg float-end'>Edit Details</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<div class='alert alert-warning'>No employee details found for ID: " . $employeeId . "</div>";
}

$stmt->close(); 
$conn->close();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>