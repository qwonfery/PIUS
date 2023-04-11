<?php

namespace lab1;

require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Employee
{
    public function __construct(
        private int $id,
        private string $name,
        private int $salary,
        private \DateTime $employmentDate
    ) {
        $this->validate();
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {

        $metadata->addPropertyConstraint('id', new Assert\Positive());
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('salary', new Assert\PositiveOrZero());
        $metadata->addPropertyConstraint('employmentDate', new Assert\GreaterThan(new \DateTime("12.02.2002")));

    }

    public function validate(): void
    {
        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();
        $violations = $validator->validate($this);
        $message = "Errors when creating an Employee:<br>";
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $message .= $violation->getMessage().'<br>';
            }
            throw new \ValueError($message);
        }
    }

    public function getExperience(): int
    {
        return $this->employmentDate->diff(new \DateTime())->y;
    }

    public function getSalary(): int
    {
        return $this->salary;
    }

    public function __toString(): string
    {
        $message = "";
        $message .= "id = ".$this->id.'</br>';
        $message .= "name = ".$this->name.'</br>';
        $message .= "salary = ".$this->salary.'</br>';
        $message .= "employmentDate = ".$this->employmentDate->format("d-m-Y").'</br>';
        return $message;
    }

}
