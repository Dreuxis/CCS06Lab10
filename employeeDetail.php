<?php

require "config.php";

use App\EmployeeDetail;

// Retrieve the employee ID from the query parameter
$empId = $_GET['emp_no'];

// Get the employee's basic information
$employee = EmployeeDetail::getEmployee($empId);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Employee Details</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <style>
    body {
        background-image: url("https://wallpapercave.com/wp/wp8363906.jpg");
        background-size: 110% 130%;
    }
    </style>
    <body>
    <div class="main">
    <?php
    if ($employee) { ?>
            <h1>Employee Details for <?php echo $employee['employee']; ?></h1>

            <h2>Basic Information</h2>
            <p>
                <strong>Title:</strong> <?php echo $employee['title']; ?><br>
                <strong>Employee Name:</strong> <?php echo $employee['employee']; ?><br>
                <strong>Birth Date:</strong> <?php echo $employee['birth_date']; ?><br>
                <strong>Age:</strong> <?php echo $employee['age']; ?><br>
                <strong>Gender:</strong> <?php echo $employee['gender']; ?><br>
                <strong>Hire Date:</strong> <?php echo $employee['hire_date']; ?><br>
            </p>

            <h2>Salary History</h2>
            <?php
            // Get the employee's salary history
            $salaryHistory = EmployeeDetail::getSalary($empId);

            if ($salaryHistory) 
            {
                ?>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Salary</th>
                        <th>From Date</th>
                        <th>To Date</th>
                    </tr>
                    <?php foreach ($salaryHistory as $salary) { ?>
                        <tr>
                            <td><?php echo $salary['salary']; ?></td>
                            <td><?php echo $salary['from_date']; ?></td>
                            <td><?php echo $salary['to_date']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <?php
            } 
            else {
                echo "<p>No salary history found for this employee.</p>";
            }
        } else {
            echo "<p>Employee not found.</p>";
        }
        ?>
        <br>
        <a href="index.php">Go Back to Index</a>
    </div>
    </body>
</html>