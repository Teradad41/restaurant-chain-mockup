<?php

namespace  Models\RestaurantChains;

use Interfaces\FileConvertible;
use Models\Companies\Company;

class RestaurantChain extends Company implements FileConvertible {
    private string $chainId;
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(string $name, int $foundingYear, string $description, string $website, string $phone, string $industry,
                                string $ceo, bool $isPubliclyTraded, string $country, string $founder, int $totalEmployees, string $chainId,
                                array $restaurantLocations, string $cuisineType, int $numberOfLocations, string $parentCompany)
    {
        parent::__construct($name, $foundingYear, $description, $website, $phone, $industry, $ceo, $isPubliclyTraded, $country, $founder, $totalEmployees);

        $this->chainId = $chainId;
        $this->restaurantLocations = $restaurantLocations;
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
        return sprintf(
            "<h1 class='font-bold text-center text-3xl'>Restaurant Chain : %s</h1>",
            parent::getName());
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

    public function getRestaurantLocations(): array {
        return $this->restaurantLocations;
    }
}
