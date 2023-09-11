<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>HTML List Generator</title>
</head>

<body>
    <div class="container mx-auto mt-10">
        <div
            class="w-full p-10 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="mx-auto max-w-2xl text-center pt-5">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">HTML Generator by PHP</h2>
            </div>

            <form action="control_view.php" method="post">
                <label for="description" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter
                    HTML codes:</label><br>
                <textarea name="description" id="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Please insert html code for output."><?= htmlspecialchars($description) ?></textarea><br>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 mt-4 rounded">
                    Submit
                </button>
            </form>

            <?php
            require_once 'model.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST['description'];
                $html = HTMLListGenerator\generateHTMLList($input);

                echo '<h2 class="mt-6">Generated HTML</h2>';
                echo $html;
            }
            ?>
        </div>
    </div>
</body>

</html>