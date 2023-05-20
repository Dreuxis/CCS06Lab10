<?php

require "config.php";

use App\Department;

$depts = Department::list();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <style>
    body {
        background-image: url("https://wallpapercave.com/uwp/uwp3689863.jpeg");
        background-size: 100% 120%;
    }
    </style>
    <body>
    <div class="main">
    <table border="1" cellpadding="5">
        <tr>
            <th>Deptpartment Number</th>
            <th>Deptpartment Name</th>
            <th>Manager Name</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Number of Years</th>
            <th>View Department Employees</th>
        </tr> 
        <?php foreach ($depts as $dept) {
            echo "<tr>";
            foreach ($dept as $key => $data) {
                if ($key === 'dept_no') {
                    $deptNo = $data;
                }
                echo "<td>$data</td>";
            }
            echo "<td><a href='employees.php?dept_no=$deptNo'>View Employees</a></td>"; 
            echo "</tr>";
        }
        ?>
    </table>
    </body>
    </div>
</html>
<?php
/*echo '<pre>';
var_dump($depts);
echo '<hr />';
var_dump($emps);*/