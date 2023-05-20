<?php

namespace App;

use Exception;

class Employee
{
    public static function list($deptNo, $limit = null, $offset = null)
    {
        global $conn;

        try {
            $sql = "SELECT DISTINCT
                t.title,
                e.emp_no,
                CONCAT (e.first_name, ' ', e.last_name) AS employee,
                e.birth_date,
                TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) AS age,
                e.gender,
                e.hire_date,
                MAX(s.salary) AS salary
            FROM employees AS e
            LEFT JOIN titles AS t
                ON (e.emp_no = t.emp_no)
            LEFT JOIN dept_emp AS de
                ON (e.emp_no = de.emp_no)
            LEFT JOIN salaries AS s
                ON e.emp_no = s.emp_no
            WHERE de.dept_no = :deptNo
            GROUP BY e.emp_no";

            if ($limit !== null && $offset !== null) {
                $sql .= " LIMIT :limit OFFSET :offset";
            }

            $statement = $conn->prepare($sql);
            $statement->bindParam(':deptNo', $deptNo);

            if ($limit !== null && $offset !== null) {
                $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
                $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);
            }
            $statement->execute();
            $records = $statement->fetchAll();

            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}