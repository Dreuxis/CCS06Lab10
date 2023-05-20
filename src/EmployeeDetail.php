<?php

namespace App;

use Exception;
use PDO;

class EmployeeDetail
{

    public static function getEmployee($empId)
    {
        global $conn;

        try {
            $sql = "SELECT
                t.title,
                CONCAT(e.first_name, ' ', e.last_name) AS employee,
                e.birth_date,
                TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) AS age,
                e.gender,
                e.hire_date
            FROM employees AS e
            LEFT JOIN titles AS t
                ON (e.emp_no = t.emp_no)
            WHERE e.emp_no = :empId";

            $statement = $conn->prepare($sql);
            $statement->bindParam(':empId', $empId);
            $statement->execute();
            $employee = $statement->fetch(PDO::FETCH_ASSOC);

            return $employee;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }

    public static function getSalary($empId)
    {
        global $conn;

        try {
            $sql = "SELECT
                s.salary,
                s.from_date,
                s.to_date
            FROM salaries AS s
            WHERE s.emp_no = :empId
            ORDER BY s.from_date";

            $statement = $conn->prepare($sql);
            $statement->bindParam(':empId', $empId);
            $statement->execute();
            $salaryHistory = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $salaryHistory;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}