<?php

namespace lab1;

require_once 'Employee.php';

class Department
{
    public function __construct(
        public array $employeeArray,
        public string $name
    ) {
    }

    public function sumSalary(): int
    {
        $sum = 0;
        foreach ($this->employeeArray as $employee) {
            $sum += $employee->getSalary();
        }
        return $sum;
    }

    public function __toString(): string
    {
        $message = "Department".$this->name.'<br>';
        foreach ($this->employeeArray as $employee){
            $message .= strval($employee).'<br>';
        }
        return $message;
    }

}
