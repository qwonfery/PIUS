<?php

namespace App;

class Department
{
    public function __construct(
        private array $employeeArray,
        private string $name
    ) {
    }

    public function getEmployeeAmount(): int
    {
        return count($this->employeeArray);
    }

    public function sumSalary(): int
    {
        $sum = 0;

        foreach ($this->employeeArray as $employee) {
            $sum += $employee->getSalary();
        }
        return $sum;
    }

    public function departmentInfo(): string
    {
        $message = "Department ".$this->name.'<br>';
        $message .= "Sum salary = ".$this->sumSalary().'<br>';
        $message .= "Number of employees = ".$this->getEmployeeAmount();
        return $message;
    }

    public function __toString(): string
    {
        $message = "Department".$this->name.'<br>';

        foreach ($this->employeeArray as $employee) {
            $message .= strval($employee).'<br>';
        }
        return $message;
    }

}