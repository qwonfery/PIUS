<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Employee;
use App\Department;

function departmentAmountMax(array $departments): array
{
    $maxDepartments = array();
    $maxValue = 0;

    foreach ($departments as $department) {
        $departmentSize =  $department->getEmployeeAmount();
        switch (true) {
            case $departmentSize > $maxValue:
                unset($maxDepartments);
                $maxDepartments = array($department);
                $maxValue = $departmentSize;
                break;
            case $departmentSize == $maxValue:
                $maxDepartments[] = $department;
                break;
        }
    }

    return $maxDepartments;
}

function departmentsMinMax(array $departments): void
{
    $minDepartments = array();
    $minValue = $departments[0]->sumSalary();

    $maxDepartments = array();
    $maxValue = $departments[0]->sumSalary();

    foreach ($departments as $department) {
        $departmentSalary = $department->sumSalary();
        echo $department->departmentInfo().'<br>';

        if ($departmentSalary > $maxValue) {
            unset($maxDepartments);
            $maxDepartments = array($department);
            $maxValue = $departmentSalary;
            continue;
        } elseif ($departmentSalary < $minValue) {
            unset($minDepartments);
            $minDepartments = array($department);
            $minValue = $departmentSalary;
            continue;
        }

        if ($departmentSalary == $maxValue) {
            $maxDepartments[] = $department;
        }

        if ($departmentSalary == $minValue) {
            $minDepartments[] = $department;
        }

    }

    $maxDepartments = departmentAmountMax($maxDepartments);
    $minDepartments = departmentAmountMax($minDepartments);

    echo '<br>';
    echo "Department(s) with max salary<br>";
    foreach ($maxDepartments as $maxDepartment) {
        echo $maxDepartment->departmentInfo().'<br>';
    }

    echo '<br><br>';
    echo "Department(s) with min salary<br>";
    foreach ($minDepartments as $minDepartment) {
        echo $minDepartment->departmentInfo().'<br>';
    }

}

try {
    $departmentsArray = array();
    for ($j = 1; $j <= 10; $j++) {
        $employeeArray = array();
        for ($i = 1; $i <= rand(1, 5); $i++) {
            $employeeArray[] = new Employee($i, "Jora", 10000*rand(1, 5), new \DateTime("12.02.2007"));
        }
        $departmentsArray[] = new Department($employeeArray, $j);
    }
    departmentsMinMax($departmentsArray);
} catch (\ValueError $ex) {
    echo $ex->getMessage();
}
