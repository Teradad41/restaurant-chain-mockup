<?php

namespace Models\Employees;

use DateTime;
use Interfaces\FileConvertible;
use Models\Users\User;

class Employee extends User implements FileConvertible {
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    public function __construct(int $id, string $firstName, string $lastName, string $email, string   $password, string $phoneNumber, string $address, DateTime $birthDate, DateTime $membershipExpirationDate, string $role, string $jobTitle, float $salary, DateTime $startDate, array $awards) {
        parent::__construct($id, $firstName, $lastName, $email, $password, $phoneNumber, $address, $birthDate, $membershipExpirationDate, $role);

        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public function toString(): string
    {
        $parentString = parent::toString();
        $awardsList = implode(", ", $this->awards);

        return $parentString . sprintf("Job Title: %s\nSalary: $%.2f\nStart Date: %s\nAwards: %s\n",
                $this->jobTitle,
                $this->salary,
                $this->startDate->format('Y-m-d'),
                $awardsList);
    }

    public function toHTML(): string {
        $parentHTML = parent::toHTML();
        $awardsList = implode(", ", array_map('htmlspecialchars', $this->awards));

        return $parentHTML . sprintf("
            <div class='employee-details'>
                <p>Job Title: %s</p>
                <p>Salary: $%.2f</p>
                <p>Start Date: %s</p>
                <p>Awards: %s</p>
            </div>",
                htmlspecialchars($this->jobTitle),
                $this->salary,
                $this->startDate->format('Y-m-d'),
                $awardsList
            );
    }

    public function toMarkdown(): string
    {
        $parentMarkdown = parent::toMarkdown();
        $awardsList = implode(", ", $this->awards);
        return $parentMarkdown . sprintf(
                "\n### Job Details\n- Job Title: %s\n- Salary: $%.2f\n- Start Date: %s\n- Awards: %s",
                $this->jobTitle,
                $this->salary,
                $this->startDate->format('Y-m-d'),
                $awardsList
            );
    }

    public function toArray(): array
    {
        $parentArray = parent::toArray();
        return array_merge($parentArray, [
            'jobTitle' => $this->jobTitle,
            'salary' => $this->salary,
            'startDate' => $this->startDate->format('Y-m-d'),
            'awards' => $this->awards,
        ]);
    }
}