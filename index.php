<?php

use Helpers\RandomGenerator;

spl_autoload_extensions('.php');
spl_autoload_register();

require './vendor/autoload.php';

$min = max((int)($_GET["min"] ?? 2), 2);
$max = max((int)($_GET["max"] ?? 6), $min);

$restaurantChains = RandomGenerator::generateArray("restaurantChains", $min, $max);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restaurant Chain Mockup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-6">
        <?php foreach ($restaurantChains as $restaurantChain): ?>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-5 mb-6">
                <?php echo $restaurantChain->toHTML(); ?>
                <div class="bg-blue-200 p-5 mt-4">
                    <h4 class="font-semibold text-xl">Restaurant Chain Information</h4>
                </div>
                <div class="bg-gray-50 p-5">
                    <?php foreach ($restaurantChain->getRestaurantLocations() as $restaurantLocation): ?>
                        <div class="p-5">
                            <?php echo $restaurantLocation->toHTML(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="/Public/index.js"></script>
</body>
</html>
