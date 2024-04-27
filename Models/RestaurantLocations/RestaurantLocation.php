<?php

namespace Models\RestaurantLocations;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThru;

    public function __construct(string $name, string $address, string $city, string $state, string $zipCode, array $employees, bool $isOpen, bool $hasDriveThru) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThru = $hasDriveThru;
    }

    public function toString(): string {
        return sprintf(
            "Name: %s, Address: %s, City: %s, State: %s, ZIP: %s, Open: %s, Drive-Thru: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->isOpen ? 'Yes' : 'No',
            $this->hasDriveThru ? 'Yes' : 'No'
        );
    }

    public function toHTML(): string {
        $employeeHTML = '';
        foreach ($this->employees as $employee) {
            $employeeHTML .= $employee->toHTML();
        }

        $accordionId = 'accordion-' . rand(1000, 9999);

        return sprintf(
            "<div class='bg-white shadow-lg rounded-lg p-6 mb-6 cursor-pointer'>
            <h2 class='text-2xl text-gray-800 mb-2 random-color' onclick='toggleAccordion(\"%s\")'>Company Name: %s</h2>
            <div id='%s' class='hidden'>
                <p class='text-gray-700'>Address: %s, %s, %s</p>
                <p class='text-gray-700'>ZipCode: %s</p>
                <div class='flex items-center justify-between mt-4'>
                    <span class='text-lg %s'>Status: %s</span>
                    <span class='text-lg %s'>Drive-Thru: %s</span>
                </div>
                <div class='mt-4'>
                    <h3 class='text-xl font-semibold text-gray-800'>Employees:</h3>
                    <div class='border-b border-gray-400 my-3'></div>
                    <div class='space-y-4 mt-2'>
                        %s
                    </div>
                </div>
            </div>
        </div>",
            $accordionId,
            htmlspecialchars($this->name),
            $accordionId,
            htmlspecialchars($this->address),
            htmlspecialchars($this->city),
            htmlspecialchars($this->state),
            htmlspecialchars($this->zipCode),
            $this->isOpen ? 'text-green-600' : 'text-red-600',
            $this->isOpen ? 'Open' : 'Closed',
            $this->hasDriveThru ? 'text-green-600' : 'text-red-600',
            $this->hasDriveThru ? 'Available' : 'Not Available',
            $employeeHTML
        );
    }

    public function toMarkdown(): string {
        return sprintf(
            "## %s\n- **Address**: %s, %s, %s, %s\n- **Status**: %s, **Drive-Thru**: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->isOpen ? 'Open' : 'Closed',
            $this->hasDriveThru ? 'Available' : 'Not Available'
        );
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'employees' => array_map(function ($employee) {return $employee->toArray();}, $this->employees),
            'isOpen' => $this->isOpen,
            'hasDriveThru' => $this->hasDriveThru
        ];
    }
}