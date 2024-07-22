<?php
include 'nav.php';
include 'db.php';
?>

<!-- msg bar -->
<div id="update-success" class="floating-bar alert alert-success alert-dismissible fade show" role="alert">
   Record updated successfully!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div id="add-success" class="floating-bar alert alert-success alert-dismissible fade show" role="alert">
   New record added successfully!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div id="update-fail" class="floating-bar alert alert-danger alert-dismissible fade show" role="alert">
   Error updating record. Please try again!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div id="add-fail" class="floating-bar alert alert-danger alert-dismissible fade show" role="alert">
   Error adding new record. Please try again!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php 
// Check the 'msg' parameter
if (isset($_GET['msg'])) { 
  $msg = $_GET['msg'];

  // Determine the message bar to show and its ID
  switch ($msg) {
    case 'update_success':
      $barId = 'update-success';
      break; 
    case 'add_success':
      $barId = 'add-success'; 
      break; 
    case 'update_fail':
      $barId = 'update-fail';
      break;
    case 'add_fail':
      $barId = 'add-fail';
      break;
    default:
      $barId = null; // Or display a default message 
  } 

  // Show the message bar if $barId is set
  if ($barId) { 
    echo "<script>
          document.getElementById('$barId').style.display = 'block';
          setTimeout(function() {
            document.getElementById('$barId').style.display = 'none'; 
          }, 3000); 
        </script>";
  } 
}
?> 

<!-- <div class="content p-3 flex-grow-1"> -->
    <!-- <h6>All Employees</h6> -->

    <?php

    // SQL query to fetch employee data and related information from other tables
    $sql = "
  SELECT 
    e.nEmpID, 
    e.cEPFNo, 
    e.cEmpNo, 
    e.cInitials, 
    e.cLastName, 
    t.cTitle,
    ty.cEmpType,
    d.cDesignation,
    s.cCivilStatus,
    b.cBankName,
    e.cBankAccountNo
  FROM Pay_GenEmployees AS e
  LEFT JOIN gen_RefCustomerTittle AS t ON e.nTitleID = t.nTitleID
  LEFT JOIN Pay_RefEmpType AS ty ON e.nEmpTypeID = ty.nEmpTypeID
  LEFT JOIN Pay_RefDesignations AS d ON e.nDesignationID = d.nDesignationID
  LEFT JOIN gen_RefCivilStatus AS s ON e.nCivilStatusID = s.nCivilStatusID
  LEFT JOIN Pay_RefBanks AS b ON e.nBankID = b.nBankID
";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class=\"table table-hover table-dark table-striped\">
    <thead>
    <tr class=\"table-dark\">
      <th>Employee ID</th>
      <th>EPF No</th>
      <th>Employee No</th>
      <th>Name</th>
      <th>Employee Type</th>
      <th>Designation</th>
      <th>Civil Status</th>
      <th>Bank Name</th>
      <th>Bank Account No</th>
    </tr>
    </thead>
    <tbody id=\"employee-table\">"; // Moved tbody tag inside the if condition
        // Output data of each row using foreach
        foreach ($result as $row) {
            echo "
    <tr class=\"row-button\" data-toggle=\"modal\" data-target=\"#employee-modal\" data-id={$row["nEmpID"]}>
      <td>" . $row["nEmpID"] . "</td>
      <td>" . $row["cEPFNo"] . "</td>
      <td>" . $row["cEmpNo"] . "</td>
      <td>" . $row["cTitle"] . ". " . $row["cInitials"] . " " . $row["cLastName"] . "</td>
      <td>" . $row["cEmpType"] . "</td>
      <td>" . $row["cDesignation"] . "</td>
      <td>" . $row["cCivilStatus"] . "</td>
      <td>" . $row["cBankName"] . "</td>
      <td>" . $row["cBankAccountNo"] . "</td>
    </tr>";
        }
        echo "</tbody></table>"; // Closed tbody and table tags
    } else {
        echo "0 results";
    }

    $conn->close();

    ?>

</div>

<!-- Modal -->
<div class="modal fade" id="employee-modal" tabindex="-1" role="dialog" aria-labelledby="employee-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header"> -->
                <!-- <h5 class="modal-title" id="employee-modal-label">Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            <!-- </div> -->
            <div class="modal-body">
                <!-- Employee details will be inserted here by JS -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript code to handle row click event and display employee details
    document.addEventListener('DOMContentLoaded', function () {
        const employeeTable = document.getElementById('employee-table');
        const employeeModal = document.getElementById('employee-modal');
        const modalBody = employeeModal.querySelector('.modal-body');

        employeeTable.addEventListener('click', function (event) {
            const target = event.target;
            if (target.tagName === 'TD') {
                const row = target.closest('tr');
                const employeeId = row.dataset.id;
                // You can fetch the employee details from the server using AJAX and update the modal body
                fetch(`popDetails.php?employeeId=${employeeId}`)
                    .then(response => response.text())
                    .then(data => {
                        modalBody.innerHTML = data;
                        // Show the modal
                        $('#employee-modal').modal('show');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
</script>
