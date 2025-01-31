<?php
session_start(); // Ensure the session is started
// ...existing code...

// Ensure $_SESSION['user_id'] is set before accessing it
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}


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
    <style>
        @keyframes appear {
            from {
                opacity: 0;
                scale: 0.5;
            }

            to {
                opacity: 1;
                scale: 1;
            }

        }

        .animation {
            animation: appear linear;
            animation-timeline: view();
            animation-range: entry 0% cover 30%;
        }
    </style>

</head>

<body class="bg-gray-100">
    <section class="landingPage h-[400px] flex flex-col items-center rounded-b-3xl ">
        <div
            class="flex fixed z-40 rounded-b-xl w-[85%]  justify-around gap-24 items-center py-3  md:px-24 bg-white shadow-2xl">
            <a href="./home.php"><img class="w-[120px]" src="./img/logo.png" alt="logo"></a>
            <div class="flex gap-12 items-center">
                <a class=" bg-black text-white border-2 hover:bg-white hover:border-2 hover:text-black py-1 px-4 rounded-md transform duration-300"
                    href="./home.php">Home</a>
                <a href="./historique.php">Reservations</a>
                <a href="./categories.php">Categories</a>
                <a href="./bloger.php">Services</a>
            </div>
            <div>
                <a href="#"
                    class="text-white text-lg bg-black border-2 rounded-3xl py-1 px-4 hover:text-black hover:bg-white hover:border-black transform duration-300  ">Contact
                    Us</a>
            </div>
        </div>

        <div class=" bg-center gap-12 bg-cover   h-[100vh]  lg:pt-0 mt-24">

            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    We have thems for you to explore !</h2>
                <p class="font-light text-gray-500  sm:text-xl dark:text-gray-200">Welcome to our collection of cars! We
                    have a wide range of vehicles available for you to explore and find the perfect match. Whether
                    you're looking for a sleek and stylish ride or a practical and reliable option, our selection has
                    something for everyone. Take your time to browse through our cars and discover the ideal vehicle
                    that fits your needs and style. We're excited to help you find your next car!</p>
                <div class="mt-8    flex items-center justify-center gap-x-6 lg:justify-CENTER">
                    <a onclick="openAddModal()"
                        class="rounded-md cursor-pointer text-black bg-white px-8 py-2.5 text-sm font-semibold  shadow-sm hover:text-white hover:bg-black border-2 border-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transform duration-300">Add
                        your own article now !</a>
                </div>
            </div>




        </div>

    </section>


    <section class="bg-[url('./img/bagr.jpg')] bg-center bg-cover    lg:px-24 lg:pt-0">


        <!-- Blog Listing Page -->
        <div class="max-w-6xl mx-auto px-4 py-8">
            <!-- Search and Filters -->
            <div class="mb-8">
                <div class="flex gap-4 flex-wrap">
                    <input type="text" placeholder="Rechercher un article..."
                        class="px-4 py-2 border rounded-lg flex-grow">
                    <select class="px-4 py-2 border rounded-lg">
                        <option>tag1</option>
                        <option>tag2</option>
                        <option>tag2</option>
                    </select>
                </div>
                <div class="mt-4 flex gap-2 flex-wrap">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">#voyage</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">#cuisine</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">#technologie</span>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="animation grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Article Card -->
                <article
                    class="bg-white rounded-lg shadow-black transform hover:scale-95 duration-300 hover:cursor-pointer overflow-hidden shadow-2xl">
                    <img src="./img/toy.avif" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Titre de l'article</h2>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <div class="flex gap-2 mb-4">
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">#tag1</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">#tag2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="articleInfo.php" class="text-blue-500 hover:text-blue-700">Lire la suite →</a>
                            <button class="flex items-center gap-2 text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>


                        </div>
                    </div>
                </article>
                <!-- Article Card -->
                <article
                    class="animation bg-white rounded-lg shadow-black transform hover:scale-95 duration-300 hover:cursor-pointer overflow-hidden shadow-2xl">
                    <img src="./img/mer.jpg" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Titre de l'article</h2>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <div class="flex gap-2 mb-4">
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">#tag1</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">#tag2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700">Lire la suite →</a>
                            <button class="flex items-center gap-2 text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>


                        </div>
                    </div>
                </article>
                <!-- Article Card -->
                <article
                    class="animation bg-white rounded-lg shadow-black transform hover:scale-95 duration-300 hover:cursor-pointer overflow-hidden shadow-2xl">
                    <img src="./img/nis.jpg" alt="Article" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Titre de l'article</h2>
                        <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <div class="flex gap-2 mb-4">
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">#tag1</span>
                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">#tag2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-blue-500 hover:text-blue-700">Lire la suite →</a>
                            <button class="flex items-center gap-2 text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>


                        </div>
                    </div>


                </article>

                <?php
                require_once './../app/database/Database.php';
                $database = new Database();
                $db = $database->connect();

                $query = "SELECT * FROM articles";
                $stmt = $db->prepare($query);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($row["id_blog_fk"] == $_GET['id']) { // Corrected here
                        // Card container
                        echo '<div class="animation max-w-4xl mx-auto px-4 py-8">';

                        // Article structure
                        echo '<article class="animation bg-white rounded-lg shadow-black transform hover:scale-95 duration-300 hover:cursor-pointer overflow-hidden shadow-2xl">';

                        // Image (empty variable)
                        echo '<img src="' . htmlspecialchars($row['images']) . '" alt="Article" class="w-full h-48 object-cover">';

                        // Content
                        echo '<div class="p-4">';

                        // Title (empty variable)
                        echo '<h2 class="text-xl font-semibold mb-2">' . htmlspecialchars($row['titre']) . '</h2>';

                        // Description (empty variable)
                        echo '<p class="text-gray-600 mb-4 w-[310px] truncate">' . htmlspecialchars($row['contenu']) . '</p>';

                        // Corrected status div 
                        echo '<div class="flex justify-start">'; // Use flexbox to center the content
                        echo '<p class="text-black text-sm font-light bg-yellow-500/20 px-2 py-2 rounded-xl mb-4">' . htmlspecialchars($row['statut']) . '</p>';
                        echo '</div>';

                        // Action buttons (empty variables)
                        echo '<div class="flex justify-between items-center">';
                        echo '<a href="articleInfo.php" class="text-blue-500 hover:text-blue-700">Lire la suite →</a>';
                        echo '<form action="../app/action/admin/Article/delete.php?id" method="POST">';
                        echo '<input type="hidden" name="id_article" value="' . htmlspecialchars($row['id_article']) . '">';
                        echo '<input type="hidden" name="id_blog" value="' . $_GET['id'] . '">'; // Corrected here
                        echo '<button type="submit" class="flex items-center gap-2 text-red-500 hover:text-red-700">';
                        echo '<p class="text-red-500">Cancel</p>';
                        echo '</button>';
                        echo '</form>';
                        echo '</div>';


                        echo '</div>';
                        echo '</article>';
                        echo '</div>';
                    } else {

                        echo '<p>No articles found</p>';
                    }
                }


                $database->disconnect();
                ?>




            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center gap-2">
                <button class="px-4 py-2 border bg-white rounded-lg hover:bg-gray-100">Précédent</button>
                <button class="px-4 py-2 border   rounded-lg bg-blue-500 text-white">1</button>
                <button class="px-4 py-2 border bg-white  rounded-lg hover:bg-gray-100">2</button>
                <button class="px-4 py-2 border bg-white  rounded-lg hover:bg-gray-100">3</button>
                <button class="px-4 py-2 border bg-white  rounded-lg hover:bg-gray-100">Suivant</button>
            </div>
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
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                        </path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">GitHub</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Dribbble</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            <p class="mt-8 text-base leading-6 text-center text-gray-400">
                © 2021 SomeCompany, Inc. All rights reserved.
            </p>
        </div>
    </section>




    <!-- Add Article Modal -->
    <div id="addArticleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-3xl w-full mx-4 shadow-2xl">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-black">Ajouter un article</h3>
                    <button onclick="closeAddModal()" class="text-gray-400 hover:text-white transition-colors"
                        aria-label="Fermer">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="addArticleForm" action="../app/action/admin/Article/add.php" method="POST" class="space-y-4"
                    onsubmit="handleSubmit(event)">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <input type="hidden" name="id_blog" value="<?php echo $_GET['id'] ?>">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id'] ?>">
                            <label for="articleTitle" class="block text-sm font-medium text-gray-700 mb-2">Article
                                Title</label>
                            <input type="text" id="articleTitle" name="titre" required
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter the title of the article">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleTitleError"></div>
                        </div>

                        <div>
                            <label for="articleContent"
                                class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <textarea id="articleContent" name="contenu" required
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                rows="5" placeholder="Write the content"></textarea>
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleContentError"></div>
                        </div>

                        <div>
                            <label for="articleImages" class="block text-sm font-medium text-gray-700 mb-2">Images
                                (URLs)</label>
                            <input type="text" id="articleImages" name="images"
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter image URLs separated by commas">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleImagesError"></div>
                        </div>

                        <div>
                            <label for="articleVideos" class="block text-sm font-medium text-gray-700 mb-2">Videos
                                (URLs)</label>
                            <input type="text" id="articleVideos" name="videos"
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter video URLs separated by commas">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleVideosError"></div>
                        </div>



                        <div>
                            <label for="articleTags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                            <input type="text" id="articleTags" name="article_tag"
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter tags separated by commas">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleTagsError"></div>
                        </div>

                        <div>
                            <label for="articleGImg1" class="block text-sm font-medium text-gray-700 mb-2">Gallery Image
                                1 (URL)</label>
                            <input type="text" id="articleGImg1" name="g_img1"
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter gallery image 1 URL">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleGImg1Error"></div>
                        </div>

                        <div>
                            <label for="articleGImg2" class="block text-sm font-medium text-gray-700 mb-2">Gallery Image
                                2 (URL)</label>
                            <input type="text" id="articleGImg2" name="g_img2"
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter gallery image 2 URL">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleGImg2Error"></div>
                        </div>

                        <div>
                            <label for="articleGImg3" class="block text-sm font-medium text-gray-700 mb-2">Gallery Image
                                3 (URL)</label>
                            <input type="text" id="articleGImg3" name="g_img3"
                                class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700"
                                placeholder="Enter gallery image 3 URL">
                            <div class="text-red-500 text-xs mt-1 hidden" id="articleGImg3Error"></div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeAddModal()"
                            class="px-4 py-2 bg-white text-black border-black border-2 rounded-lg hover:bg-black hover:text-white transition-colors">
                            Cancel
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-black text-white border-black border-2 rounded-lg hover:bg-white hover:text-black transition-colors">
                            <span>Add</span>
                            <div id="loadingSpinner" class="hidden ml-2">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addArticleModal').classList.remove('hidden');
            document.getElementById('addArticleModal').classList.add('flex');
        }

        function closeAddModal() {
            const modal = document.getElementById('addArticleModal');
            modal.classList.add('hidden');
            document.getElementById('addArticleForm').reset();
        }


    </script>




</body>

</html>