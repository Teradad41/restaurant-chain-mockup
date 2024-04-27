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

    public function __construct(int $id, string $firstName, string $lastName, string $email, string $password, string $phoneNumber, string $address, DateTime $birthDate, DateTime $membershipExpirationDate, string $role, string $jobTitle, float $salary, DateTime $startDate, array $awards) {
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

    public function toHTML(): string
    {
        $awardsList = implode(", ", array_map('htmlspecialchars', $this->awards));

        return sprintf("
        <div class='bg-white shadow-md rounded-lg p-4 my-4'>
            <p class='text-gray-600'><span class='font-semibold'>Name:</span> %s</p>
            <p class='text-gray-600'><span class='font-semibold'>ID:</span> %d</p>
            <p class='text-gray-600'><span class='font-semibold'>Job Title:</span> %s</p>
            <p class='text-gray-600'><span class='font-semibold'>Salary:</span> $%.2f</p>
            <p class='text-gray-600'><span class='font-semibold'>Start Date:</span> %s</p>
        </div>",
                htmlspecialchars($this->firstName . " " . $this->lastName),
                htmlspecialchars($this->id),
                htmlspecialchars($this->jobTitle),
                $this->salary,
                $this->startDate->format('Y-m-d'),
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