<?php

namespace App;

use Exception;
use PDO;

class Department
{
    public static function list()
    {
        global $conn;

        try {
            $sql = 'SELECT
                d.dept_no,
                d.dept_name,
                CONCAT (e.first_name, " ", e.last_name) AS manager,
                dm.from_date,
                dm.to_date,
                floor(DATEDIFF(dm.to_date, dm.from_date)/365) AS num_of_years
            FROM departments as d
            LEFT JOIN dept_manager AS dm
                ON (d.dept_no = dm.dept_no)
            LEFT JOIN employees as e
                ON (dm.emp_no = e.emp_no);
            ';

            $statement = $conn->prepare($sql);
            $statement->execute();
            $records = [];

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                array_push($records, $row);
            }

            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }

    public static function get_Dept($deptNo)
    {
        global $conn;

        try {
            $sql="SELECT dept_name FROM departments WHERE dept_no='$deptNo'";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $dept = $statement->fetchColumn();

            return $dept;
        }
        catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}