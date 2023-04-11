<?php

namespace lab1;

require_once 'Employee.php';

try {
    $Jora = new Employee(0, "", -2, new \DateTime("12.02.2002"));
    echo $Jora;
    echo $Jora->getExperience();
} catch (\ValueError $ex) {
    echo $ex->getMessage();
}


