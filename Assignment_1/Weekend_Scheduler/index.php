<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekend Scheduler</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 items-center justify-center h-screen">
    <div class="mx-auto max-w-2xl text-center pt-5">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Weekend Scheduler</h2>
    </div>
    <div class="container mx-auto p-10">
        <div class="bg-white rounded shadow-lg mx-auto p-8 w-1/2">

            <?php
            $total_cost = null;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Define the menu prices
                $menu_prices = [
                    "BBQ Ribs" => 15,
                    "Chicken Sandwich" => 10,
                    "Vegetarian Pasta" => 12,
                ];

                // Define the place prices
                $place_prices = [
                    "Nelson-Atkins Museum of Art" => 10,
                    "Kansas City Zoo" => 15,
                    "Union Station" => 12,
                    "Science City" => 8,
                ];

                // Get user input
                $num_people = isset($_POST['num_people']) ? (int) $_POST['num_people'] : 0;
                $selected_menu = isset($_POST['menu']) ? $_POST['menu'] : '';
                $selected_place = isset($_POST['place']) ? $_POST['place'] : '';

                // Calculate the cost
                $menu_price = $menu_prices[$selected_menu] ?? 0;
                $place_price = $place_prices[$selected_place] ?? 0;

                if ($menu_price > 0 && $place_price > 0 && $num_people > 0) {
                    $total_cost = $num_people * ($menu_price + $place_price);
                }
            }
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mb-4">
                <div class="mb-4">
                    <label for="num_people" class="block font-bold">Number of People:</label>
                    <input type="number" name="num_people" id="num_people" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Lunch Menu:</label>
                    <input type="radio" id="BBQ" name="menu" value="BBQ Ribs">
                    <label for="BBQ">BBQ Ribs - $15 per person</label><br>
                    <input type="radio" id="chicken_sandwich" name="menu" value="Chicken Sandwich">
                    <label for="chicken_sandwich">Chicken Sandwich - $10 per person</label><br>
                    <input type="radio" id="veg_pasta" name="menu" value="Vegetarian Pasta">
                    <label for="veg_pasta">Vegetarian Pasta - $12 per person</label>
                </div>
                <div class="mb-4">
                    <label for="place" class="block font-bold">Place to Go:</label>
                    <select name="place" id="place" class="w-full p-2 border rounded">
                        <option value="Nelson-Atkins Museum of Art">Nelson-Atkins Museum of Art - $10 per person
                        </option>
                        <option value="Kansas City Zoo">Kansas City Zoo - $15 per person</option>
                        <option value="Union Station">Union Station - $12 per person</option>
                        <option value="Science City">Science City - $8 per person</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Calculate</button>
            </form>

            <?php if ($total_cost !== null): ?>
                <p class="mb-4"><b>Number of People:</b>
                    <?php echo $num_people; ?>
                </p>
                <p class="mb-4"><b>Lunch:</b>
                    <?php echo $selected_menu; ?>
                </p>
                <p class="mb-4"><b>Place:</b>
                    <?php echo $selected_place; ?>
                </p>
                <p class="mb-4"><b>The total cost:</b>
                $<?php echo $total_cost; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>