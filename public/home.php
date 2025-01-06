<?php
require_once __DIR__ . '/../app/database/Database.php';
require_once __DIR__ . '/../app/class/vehicule.php';
require_once __DIR__ . '/../app/class/categorie.php';

// Initialize database connection
$database = new Database();
$db = $database->connect();

// Initialize Vehicule and Category classes
$vehicule = new Vehicule($db);
$category = new Category($db);

// Get category ID from GET request
$categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;

// Fetch vehicles based on category
if ($categoryId) {
    $vehicles = $vehicule->getVehiclesByCategory($categoryId);
} else {
    $vehicles = $vehicule->getAllVehicles();
}

// Fetch all categories for the filter dropdown
$categories = $category->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <script>
        function filterByCategory() {
            const categoryId = document.getElementById('category-filter').value;
            window.location.href = `home.php?category_id=${categoryId}`;
        }
    </script>
</head>

<body>
    <!-- FIRST SECTION -->
    <section class="landingPage h-[530px] flex flex-col items-center">
        <div
            class="flex fixed z-40 rounded-b-xl w-[85%]  justify-around gap-24 items-center py-3  md:px-24 bg-white shadow-2xl">
            <a href=""><img class="w-[120px]" src="./img/logo.png" alt="logo"></a>
            <div class="flex gap-12 items-center">
                <a class=" bg-black text-white border-2 hover:bg-white hover:border-2 hover:text-black py-1 px-4 rounded-md transform duration-300"
                    href="./home.php">Home</a>
                <a href="./historique.php">Reservations</a>
                <a href="./categories.php">Categories</a>
                <a href="./services.php">themes</a>
            </div>
            <div>
                <a href="#"
                    class="text-white text-lg bg-black border-2 rounded-3xl py-1 px-4 hover:text-black hover:bg-white hover:border-black transform duration-300  ">Contact
                    Us</a>
            </div>
        </div>

        <div class=" flex  justify-center bg-center gap-12 bg-cover  h-[100vh] lg:px-24 lg:pt-0">



            <div class=" w-[60%] text-start mt-28  ">
                <h2 class="text-balance text-slate-100 font-semibold w-[450px]  text-5xl"><span
                        class="text-white font-light">VROOM</span> the perfect car rental experience!</h2>
                <p class="mt-6 text-pretty text-lg/8 w-[550px] font-light  text-gray-100">Ready to hit the road? Take
                    the wheel of your perfect car today! Whether it's for a weekend getaway, a business trip, or just
                    exploring your city, we’ve got the ideal vehicle waiting for you. With quick booking, flexible
                    rental terms, and the best prices around, it's never been easier to drive in comfort and style.
                    Don't wait—your next adventure starts now!</p>
                <div class="mt-10  justify-center gap-x-6 lg:justify-CENTER">
                    <a href="#"
                        class="rounded-md text-black bg-white px-8 py-2.5 text-sm font-semibold  shadow-sm hover:text-white hover:bg-black border-2 border-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transform duration-300">Reserve
                        your car now <i class="ri-speed-up-fill"></i></a>
                </div>
            </div>

            <div>
                <img class="w-[800px] translate-y-[200px]" src="./img/porchepnj.png" alt="dacia">

            </div>

        </div>

    </section>


    <section class="py-4 px-8 flex bg-[url('./img/bagr.jpg')] bg-center bg-cover">
        <div class="max-w-2xl mx-auto">
            <label for="category-filter" class="mb-2 pb-2 text-sm font-medium text-black">Filter by Category</label>
            <div class="relative">
                <select id="category-filter" name="category_id" onchange="filterByCategory()"
                    class="block p-4 px-8 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-black focus:border-black dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-black dark:focus:border-black">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id_categorie']; ?>" <?php echo $categoryId == $category['id_categorie'] ? 'selected' : ''; ?>>
                            <?php echo $category['nom']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </section>

    <section class="bg-[url('./img/bagrm9loba.jpg')] bg-center bg-cover">
        <div class="flex flex-wrap gap-12 px-4 justify-center py-12">
            <?php foreach ($vehicles as $vehicle): ?>
                <div class="relative group w-[500px] shadow-2xl h-[300px] bg-cover bg-center rounded-lg hover:scale-90 duration-300 hover:cursor-pointer"
                    style="background-image: url('<?php echo $vehicle['vehicule_image']; ?>');">
                    <div class="absolute inset-0 rounded-lg bg-black bg-opacity-50 text-white flex opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="p-8">
                            <h3 class="text-2xl font-semibold"><?php echo $vehicle['nom_vehicule']; ?></h3>
                            <p class="mt-2 font-light"><?php echo $vehicle['description']; ?></p>
                            <ul class="pb-4 text-sm">
                                <li><strong>Fuel Economy:</strong> <?php echo $vehicle['fuel_economy']; ?></li>
                                <li><strong>Price:</strong> <?php echo $vehicle['price']; ?></li>
                                <li><strong>Features:</strong> <?php echo $vehicle['features']; ?></li>
                            </ul>
                            <a href="./historique.php"
                                class="rounded-md self-end text-black bg-white px-8 py-1 text-xs font-semibold shadow-sm hover:text-white hover:bg-black border-2 border-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transform duration-300">Reserve
                                now <i class="ri-speed-up-fill"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-white">
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    About
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Blog
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Team
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Pricing
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Contact
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                    Terms
                </a>
            </div>
        </nav>
        <div class="flex justify-center mt-8 space-x-6">
            <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Facebook</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Instagram</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Twitter</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">GitHub</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.