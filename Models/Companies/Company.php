<?php

namespace Models\Companies;

use Interfaces\FileConvertible;

class Company implements FileConvertible {
    protected string $name;
    protected int $foundingYear;
    protected string $description;
    protected string $website;
    protected string $phone;
    protected string $industry;
    protected string $ceo;
    protected bool $isPubliclyTraded;
    protected string $country;
    protected string $founder;
    protected int $totalEmployees;

    public function __construct(string $name, int $foundingYear, string $description, string $website, string $phone, string $industry, string $ceo, bool $isPubliclyTraded, string $country, string $founder, int $totalEmployees) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }

    public function getName(): string {
        return $this->name;
    }

    public function toString(): string
    {
        return sprintf(
            "Name: %s\nFounded: %d\nDescription: %s\nWebsite: %s\nPhone: %s\nIndustry: %s\nCEO: %s\nPublicly Traded: %s\nCountry: %s\nFounder: %s\nTotal Employees: %d",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? 'Yes' : 'No',
            $this->country,
            $this->founder,
            $this->totalEmployees
        );
    }

    public function toHTML(): string
    {
        return sprintf(
            '<table>
            <tr><th>Name:</th><td>%s</td></tr>
            <tr><th>Founded:</th><td>%d</td></tr>
            <tr><th>Description:</th><td>%s</td></tr>
            <tr><th>Website:</th><td><a href="%s">%s</a></td></tr>
            <tr><th>Phone:</th><td>%s</td></tr>
            <tr><th>Industry:</th><td>%s</td></tr>
            <tr><th>CEO:</th><td>%s</td></tr>
            <tr><th>Publicly Traded:</th><td>%s</td></tr>
            <tr><th>Country:</th><td>%s</td></tr>
            <tr><th>Founder:</th><td>%s</td></tr>
            <tr><th>Total Employees:</th><td>%d</td></tr>
         </table>',
            htmlspecialchars($this->name),
            $this->foundingYear,
            htmlspecialchars($this->description),
            htmlspecialchars($this->website), htmlspecialchars($this->website),
            htmlspecialchars($this->phone),
            htmlspecialchars($this->industry),
            htmlspecialchars($this->ceo),
            $this->isPubliclyTraded ? 'Yes' : 'No',
            htmlspecialchars($this->country),
            htmlspecialchars($this->founder),
            $this->totalEmployees
        );
    }

    public function toMarkdown(): string
    {
        return "## Name: {$this->name}\n" .
                "- Founding Year: {$this->foundingYear}\n" .
                "- Description: {$this->description}\n" .
                "- Website: [{$this->website}]({$this->website})\n" .
                "- Phone: {$this->phone}\n" .
                "- Industry: {$this->industry}\n" .
                "- CEO: {$this->ceo}\n" .
                "- Is Publicly Traded: " . ($this->isPubliclyTraded ? 'Yes' : 'No') . "\n" .
                "- Country: {$this->country}\n" .
                "- Founder: {$this->founder}\n" .
                "- Total Employees: {$this->totalEmployees}";
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded,
            'country' => $this->country,
            'founder' => $this->founder,
            'totalEmployees' => $this->totalEmployees
        ];
    }
}