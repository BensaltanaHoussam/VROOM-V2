<?php
require_once __DIR__ . '/../app/database/Database.php';
require_once __DIR__ . '/../app/class/categorie.php';
require_once __DIR__ . '/../app/class/vehicule.php'; 
require_once __DIR__ . '/../app/class/reservation.php'; // Add this line to include the Reservation class

// Initialize database connection
$database = new Database();
$db = $database->connect();

// Initialize Vehicule class
$vehicule = new Vehicule($db);

// Initialize Reservation class
$reservation = new Reservation($db);

// Get category ID from URL
$categoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;

// Get reserved vehicle ID from POST
$reservedVehicleId = isset($_POST['reserve_vehicle_id']) ? $_POST['reserve_vehicle_id'] : null;

// Use an existing user ID from the users table
$userId = 1; // Replace with an actual user ID from your users table

if ($reservedVehicleId) {
    // Insert reservation into the database
    $reservation->addReservation($userId, $reservedVehicleId);
    // Redirect to historique.php with reserved vehicle ID
    header("Location: historique.php?reserved_vehicle_id=$reservedVehicleId");
    exit();
}

if ($categoryId) {
    // Fetch vehicles by category
    $vehicles = $vehicule->getVehiclesByCategory($categoryId);
} else {
    $vehicles = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles in Category</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body>
    <section class="landingPage h-[230px] flex flex-col items-center rounded-b-full">
        <div class="flex fixed z-40 rounded-b-xl w-[85%] justify-around gap-24 items-center py-3 md:px-24 bg-white shadow-2xl">
            <a href="./home.php"><img class="w-[120px]" src="./img/logo.png" alt="logo"></a>
            <div class="flex gap-12 items-center">
                <a class="bg-black text-white border-2 hover:bg-white hover:border-2 hover:text-black py-1 px-4 rounded-md transform duration-300" href="./home.php">Home</a>
                <a href="./historique.php">Reservations</a>
                <a href="./categories.php">Categories</a>
                <a href="./services.php">Services</a>
            </div>
            <div>
                <a href="#" class="text-white text-lg bg-black border-2 rounded-3xl py-1 px-4 hover:text-black hover:bg-white hover:border-black transform duration-300">Contact Us</a>
            </div>
        </div>

        <div class="bg-center gap-12 bg-cover h-[100vh] lg:pt-0 mt-24">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Vehicles in Category</h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-200">Explore the vehicles in this category!</p>
            </div>
        </div>
    </section>

    <section>
        <div class="w-[80%] mx-auto py-12">
            
            <?php if (!empty($vehicles)): ?>
                <div class="flex flex-wrap gap-12 px-4 justify-center">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <div class="relative group w-[calc(50%-1.5rem)] shadow-2xl h-[300px] bg-cover bg-center rounded-lg hover:scale-90 duration-300 hover:cursor-pointer"
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
                                    <form action="vihicules.php?category_id=<?php echo $categoryId; ?>" method="POST">
                                        <input type="hidden" name="reserve_vehicle_id" value="<?php echo $vehicle['id_vehicule']; ?>">
                                        <button type="submit" class="rounded-md self-end text-black bg-white px-8 py-1 text-xs font-semibold shadow-sm hover:text-white hover:bg-black border-2 border-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transform duration-300">Reserve now <i class="ri-speed-up-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500">No vehicles found in this category.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>