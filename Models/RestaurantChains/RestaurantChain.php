<?php

namespace  Models\RestaurantChains;

use Interfaces\FileConvertible;
use Models\Companies\Company;
use Models\RestaurantLocations\RestaurantLocation;

class RestaurantChain extends Company implements FileConvertible {
    private string $chainId;

    /** @var RestaurantLocation[] */
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        string $name, int $foundingYear, string $description, string $website, string $phone, string $industry,
        string $ceo, bool $isPubliclyTraded, string $country, string $founder, int $totalEmployees, string $chainId,
        array $restaurantLocations, string $cuisineType, int $numberOfLocations, string $parentCompany) {
        parent::__construct($name, $foundingYear, $description, $website, $phone, $industry, $ceo, $isPubliclyTraded, $country, $founder, $totalEmployees);

        $this->chainId = $chainId;
        $this->restaurantLocations = array_filter($restaurantLocations, function ($location) {
            return $location instanceof RestaurantLocation;
        });
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string {
        $locationsSummary = implode(", ", array_map(function ($location) {
            return $location->getName();
        }, $this->restaurantLocations));

        return parent::toString() . sprintf(
                "Chain ID: %s, Cuisine Type: %s, Number of Locations: %d, Parent Company: %s, Locations: %s",
                $this->chainId,
                $this->cuisineType,
                $this->numberOfLocations,
                $this->parentCompany,
                $locationsSummary
            );
    }

    public function toHTML(): string {
        $locationsHTML = implode("<br>", array_map(function ($location) {
            return sprintf("<div class='text-sm text-gray-600'>%s</div>", htmlspecialchars($location->getName()));
        }, $this->restaurantLocations));

        return sprintf(
            "<div class='bg-white shadow-lg rounded-lg p-6 mb-6'>
            <h1 class='text-2xl font-bold text-gray-800 mb-4'>%s</h1>
            <p><strong>Founded:</strong> %d</p>
            <p><strong>Description:</strong> %s</p>
            <p><strong>Website:</strong> <a href='%s' class='text-blue-500 hover:text-blue-700'>Visit Site</a></p>
            <p><strong>Phone:</strong> %s</p>
            <p><strong>Industry:</strong> %s</p>
            <p><strong>CEO:</strong> %s</p>
            <p><strong>Publicly Traded:</strong> %s</p>
            <p><strong>Country:</strong> %s</p>
            <p><strong>Founder:</strong> %s</p>
            <p><strong>Total Employees:</strong> %d</p>
            <p><strong>Chain ID:</strong> %s</p>
            <p><strong>Cuisine Type:</strong> %s</p>
            <p><strong>Number of Locations:</strong> %d</p>
            <p><strong>Parent Company:</strong> %s</p>
            <p><strong>Locations:</strong> %s</p>
        </div>",
            htmlspecialchars($this->name),
            $this->foundingYear,
            htmlspecialchars($this->description),
            htmlspecialchars($this->website),
            htmlspecialchars($this->phone),
            htmlspecialchars($this->industry),
            htmlspecialchars($this->ceo),
            $this->isPubliclyTraded ? 'Yes' : 'No',
            htmlspecialchars($this->country),
            htmlspecialchars($this->founder),
            $this->totalEmployees,
            htmlspecialchars($this->chainId),
            htmlspecialchars($this->cuisineType),
            $this->numberOfLocations,
            htmlspecialchars($this->parentCompany),
            $locationsHTML
        );
    }

    public function toMarkdown(): string {
        $locationsMarkdown = implode(", ", array_map(function ($location) {
            return $location->getName();
        }, $this->restaurantLocations));

        return parent::toMarkdown() . sprintf(
                "\n### Restaurant Chain Details\n- Chain ID: %s\n- Cuisine Type: %s\n- Number of Locations: %d\n- Parent Company: %s\n- Locations: %s",
                $this->chainId,
                $this->cuisineType,
                $this->numberOfLocations,
                $this->parentCompany,
                $locationsMarkdown
            );
    }

    public function toArray(): array {
        $locationsArray = array_map(function ($location) {
            return $location->toArray();
        }, $this->restaurantLocations);

        return parent::toArray() + [
                'chainId' => $this->chainId,
                'restaurantLocations' => $locationsArray,
                'cuisineType' => $this->cuisineType,
                'numberOfLocations' => $this->numberOfLocations,
                'parentCompany' => $this->parentCompany
            ];
    }

    public function getName(): string {
        return $this->name;
    }

    public function getRestaurantLocations(): array {
        return $this->restaurantLocations;
    }
}
