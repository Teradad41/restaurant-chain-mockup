<?php

namespace Helpers;

use Faker\Factory;
use Models\RestaurantChains\RestaurantChain;
use Models\RestaurantLocations\RestaurantLocation;
use Models\Employees\Employee;

class RandomGenerator {
    private static $faker;

    public static function init() {
        self::$faker = Factory::create();
    }

    public static function generateRestaurantChain(): RestaurantChain {
        return new RestaurantChain(
            self::$faker->company(),
            (int) self::$faker->year(),
            self::$faker->realText(150),
            self::$faker->url(),
            self::$faker->phoneNumber(),
            self::$faker->randomElement(['Food']),
            self::$faker->name(),
            self::$faker->boolean(),
            self::$faker->country(),
            self::$faker->name(),
            self::$faker->randomNumber(3),
            self::$faker->randomNumber(6, true),
            self::generateArray('restaurantLocations', 1, 3),
            self::$faker->randomElement(['Japanese', 'Chinese', 'Korean', 'Italian', 'French', 'Indian']),
            self::$faker->randomNumber(2),
            self::$faker->company()
        );
    }

    public static function generateRestaurantLocation(): RestaurantLocation {
        return new RestaurantLocation(
            self::$faker->name(),
            self::$faker->address(),
            self::$faker->city(),
            self::$faker->state(),
            self::$faker->postcode(),
            self::generateArray('employees', 1, 10),
            self::$faker->boolean(),
            self::$faker->boolean()
        );
    }

    public static function generateEmployee(): Employee {
        return new Employee(
            self::$faker->randomNumber(6, true),
            self::$faker->firstName(),
            self::$faker->lastName(),
            self::$faker->email(),
            self::$faker->password(),
            self::$faker->phoneNumber(),
            self::$faker->address(),
            self::$faker->dateTimeThisCentury(),
            self::$faker->dateTimeThisDecade(),
            self::$faker->randomElement(['admin', 'staff', 'part-time']),
            self::$faker->jobTitle(),
            self::$faker->randomFloat(2, 2000, 10000),
            self::$faker->dateTimeBetween("-30 years", "now"),
            [self::$faker->word()]
        );
    }

    public static function generateArray(string $type, int $min = 2, int $max = 5): array {
        $arr = [];
        $numOfInstance = self::$faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfInstance; $i++) {
            switch ($type) {
                case 'restaurantChains':
                    $arr[] = self::generateRestaurantChain();
                    break;
                case 'restaurantLocations':
                    $arr[] = self::generateRestaurantLocation();
                    break;
                case 'employees':
                    $arr[] = self::generateEmployee();
                    break;
            }
        }

        return $arr;
    }
}

// Initialize the Faker instance
RandomGenerator::init();
