<?php

require "config.php";

use App\Employee;
use App\Department;

// Retrieve the department number from the URL parameter
$deptNo = $_GET['dept_no'];

// Fetch the total number of employees for the specified department number
$totalEmployees = count(Employee::list($deptNo));

// Set the limit of rows per page
$limit = 20;

// Calculate the total number of pages
$totalPages = ceil($totalEmployees / $limit);

// Retrieve the current page number from the URL parameter
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $limit;

// Fetch the employees for the specified department number
$employees = Employee::list($deptNo, $limit, $offset);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<style>
    body {
        background-image: url("https://free4kwallpapers.com/uploads/originals/2020/02/14/a-super-detailed-fantasy-world-.-been-there-in-my-collection-since-years-wallpaper_.jpg");
        background-size: 100% 110%;
    }
</style>
<body>
    <div class="main">
    <h1>Employees in Department: <?php echo Department::get_Dept($deptNo); ?></h1>
    <br>
    
    <table border="1" cellpadding="5">
        <tr>
            <th>Title</th>
            <th>Employee Number</th>
            <th>Employee Name</th>
            <th>Birth Date</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Hire Date</th>
            <th>Salary</th>
            <th>View Employee Details</th>
        </tr>
        
        <?php foreach ($employees as $employee) { ?>
            <tr>
                <td><?php echo $employee['title']; ?></td>
                <td><?php echo $employee['emp_no']; ?></td>
                <td><?php echo $employee['employee']; ?></td>
                <td><?php echo $employee['birth_date']; ?></td>
                <td><?php echo $employee['age']; ?></td>
                <td><?php echo $employee['gender']; ?></td>
                <td><?php echo $employee['hire_date']; ?></td>
                <td><?php echo $employee['salary']; ?></td>
                <td>
                    <a href="employeeDetail.php?emp_no=<?php echo $employee['emp_no']; ?>">View Details</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <!-- Pagination buttons -->
    <?php if ($currentPage > 1) { ?>
        <a href="employees.php?dept_no=<?php echo $deptNo; ?>&page=<?php echo ($currentPage - 1); ?>">Previous</a>
    <?php } ?>
    
    <?php if ($currentPage < $totalPages) { ?>
        <a href="employees.php?dept_no=<?php echo $deptNo; ?>&page=<?php echo ($currentPage + 1); ?>">Next</a>
    <?php } ?>

    <br>
    <a href="index.php">Go Back to Index</a>
    </div>
</body>
</html>

<pre>
