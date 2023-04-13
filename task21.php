<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Employee;

try {
    $Jora = new Employee(0, "", -2, new \DateTime("12.02.2002"));
    echo $Jora;
    echo $Jora->getExperience();
} catch (\ValueError $ex) {
    echo $ex->getMessage();
}
echo '<br>';

try {
    $Kolya = new Employee(1, "", 2, new \DateTime("12.02.2000"));
    echo $Kolya;
    echo $Kolya->getExperience();
} catch (\ValueError $ex) {
    echo $ex->getMessage();
}

echo '<br>';
try {
    $Borya = new Employee(1, "Borya", 2, new \DateTime("12.02.2006"));
    echo $Borya;
    echo $Borya->getExperience();

} catch (\ValueError $ex) {
    echo $ex->getMessage();
}