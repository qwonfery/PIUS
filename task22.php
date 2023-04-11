<?php

namespace lab1;

require_once 'Department.php';
require_once 'Employee.php';

function departmentAmountMax(array $departments): array
{
    $maxDepartments = array();
    $maxValue = count($departments[0]->employeeArray);
    
    foreach ($departments as $department) {
        $departmentCount =  count($department->employeeArray);
         if ($departmentCount == $maxValue){
            $maxDepartments[] = $department;
         }
    }

    return $maxDepartments;
}

function departmentsMinMax(array $departments): void
{
    $minDepartments = array($departments[0]);
    $minValue = $departments[0]->sumSalary();
    $maxDepartments = array($departments[0]);
    $maxValue = $departments[0]->sumSalary();
    foreach ($departments as $department){
        $departmentSalary = $department->sumSalary();

        switch (true) {
            case $departmentSalary > $maxValue:
                unset($maxDepartments);
                $maxDepartments = array($department);
                $maxValue = $departmentSalary;
                break;
            case $departmentSalary == $maxValue:
                $maxDepartments[] = $department;
                break;
            case $departmentSalary < $minValue:
                unset($minDepartments);
                $minDepartments = array($department);
                $minValue = $departmentSalary;
                break;
            case $departmentSalary == $minValue:
                $minDepartments[] = $department;
                break;
        }        
    }

    $maxDepartments = departmentAmountMax($maxDepartments);
    $minDepartments = departmentAmountMax($minDepartments);

    echo '<br>';
    echo "Department(s) with max salary<br>";
    foreach ($maxDepartments as $maxDepartment){
        echo $maxDepartment;
    }
    echo "Department(s) with min salary<br>";
    foreach ($minDepartments as $minDepartment){
        echo $minDepartment;
    }
    
}

try {


    $departmentsArray = array();
    for ($j = 1; $j <= 10; $j++){
        $employeeArray = array();
        for ($i = 1; $i <= 3; $i++){
            $employeeArray[] = new Employee($i, "Jora", rand(1000,10000), new \DateTime("12.02.2007"));
        }
        $departmentsArray[] = new Department($employeeArray,$j);
    }

    departmentsMinMax($departmentsArray);

} catch (\ValueError $ex) {
    echo $ex->getMessage();
}