<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DishUP</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="flex min-h-screen h-full">
        <aside class="w-52 bg-[#FAF5EF] border-r border-[#14452B] min-h-full flex flex-col items-center gap-4">
            <div class="drop-shadow-xl">
                <img src="img/africa.png" alt="">
            </div>
            <div>
                <div class="grid gap-4 w-[100%]">
                    <a href="index.php"><img class="w-[150px]" src="../img/DishUP.png" alt=""></a>
                    <a href="javascript:void(0);" class="flex gap-4 px-4 py-2 rounded-2xl"
                        onclick="toggleContent('articles')">
                        <img src="img/Settings_Future.svg" alt=""> Articles
                    </a>
                    <a href="javascript:void(0);" class="flex gap-4 px-4 py-2 rounded-2xl"
                        onclick="toggleContent('blogs')">
                        <img src="img/Settings_Future.svg" alt=""> Blogs
                    </a>
                    <a href="javascript:void(0);" class="flex gap-4 px-4 py-2 rounded-2xl"
                        onclick="toggleContent('tags')">
                        <img src="img/Settings_Future.svg" alt=""> Tags
                    </a>
                </div>
            </div>
        </aside>
        <div class="grow">
            <header class="border-[#14452B] bg-[#FAF5EF] h-20 border-b">
                <nav class="h-full flex justify-between mx-8 items-center">
                    <div class="flex gap-2">
                        <img src="img/Search.svg" alt="">
                        <input class="search outline-none border-none w-64 px-4 py-2 rounded-2xl" type="search"
                            name="search-input" id="search-input" placeholder="Search anything here">
                    </div>
                    <div class="flex w-72 justify-between items-center">
                        <img class="cursor-pointer" src="img/settings.svg" alt="">
                        <img class="cursor-pointer" src="img/Icon.svg" alt="">
                        <div class="flex items-center gap-2 cursor-pointer">
                            <div class="cursor-pointer w-10 h-10 bg-black bg-cover rounded-full text-white relative">
                                <div class="bg-[#228B22] h-3 w-3 rounded-full absolute bottom-0 right-0"></div>
                            </div>
                            <p class="text-[#606060] font-bold">Houssam Bensaltana</p>
                        </div>
                    </div>
                </nav>
            </header>

            <main class="p-8 bg-[url('../img/background_dash.jpg')] bg-cover bg-center h-[500px]">
                <!-- Articles Section -->
                <div id="articles-section">
                    <h1 class="text-2xl font-bold mb-6">Articles</h1>
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border bg-slate-400 border-gray-300 px-4 py-2">ID</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Title</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Content</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Date Created</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Status</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Edit Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../../app/database/Database.php';
                            $database = new Database();
                            $db = $database->connect();

                            $query = "SELECT * FROM articles";
                            $stmt = $db->prepare($query);
                            $stmt->execute();

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['id_article']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['titre']) . '</td>';
                                echo '<td class="border w-[500px] bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['contenu']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['date_creation']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['statut']) . '</td>';
                                echo '<td class="border bg-slate-100 border-gray-300 px-4 py-2">';
                                echo '<button onclick="openEditModal(' . htmlspecialchars($row['id_article']) . ', \'' . htmlspecialchars($row['statut']) . '\')" class="text-white px-4 rounded-xl py-2 bg-blue-500 hover:underline">Edit</button>';
                                echo '</td>';
                                echo '</tr>';
                            }

                            $database->disconnect();
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Blogs Section -->
                <div id="blogs-section">
                    <h1 class="text-2xl font-bold mb-6">Blogs</h1>
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border bg-slate-400 border-gray-300 px-4 py-2"></th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Name</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Tags</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Description</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Date Created</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../../app/database/Database.php';
                            $database = new Database();
                            $db = $database->connect();

                            $query = "SELECT * FROM blogs";
                            $stmt = $db->prepare($query);
                            $stmt->execute();

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['id_blog']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['name']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['tags']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['description']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['date_creation']) . '</td>';
                                echo '<td class="border bg-slate-100 border-gray-300 px-4 py-2">';
                                echo '<a href="edit_blog.php?id=' . htmlspecialchars($row['id_blog']) . '" class="text-blue-500 hover:underline">Edit</a> | ';
                                echo '<a href="delete_blog.php?id=' . htmlspecialchars($row['id_blog']) . '" class="text-red-500 hover:underline" onclick="return confirm(\'Are you sure you want to delete this blog?\');">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }

                            $database->disconnect();
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tags Section -->
                <div id="tags-section">
                    <h1 class="text-2xl font-bold mb-6">Tags</h1>
                    <form action="../../app/action/admin/tags/add.php" method="POST" class="mb-6">
                        <div class="flex gap-4">
                            <input type="text" name="tag_name" placeholder="Tag Name"
                                class="w-full px-4 py-2 border rounded-lg">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Tag</button>
                        </div>
                    </form>
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border bg-slate-400 border-gray-300 px-4 py-2">ID</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Tag Name</th>
                                <th class="border bg-gray-400 border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../../app/database/Database.php';
                            $database = new Database();
                            $db = $database->connect();

                            $query = "SELECT * FROM tags";
                            $stmt = $db->prepare($query);
                            $stmt->execute();

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td class="border border-gray-300 px-4 py-2">' . htmlspecialchars($row['id_tag']) . '</td>';
                                echo '<td class="border bg-slate-100 font-medium border-gray-300 px-4 py-2">' . htmlspecialchars($row['nom_tag']) . '</td>';
                                echo '<td class="border bg-slate-100 border-gray-300 px-4 py-2">';
                                echo '<a href="edit_tag.php?id=' . htmlspecialchars($row['id_tag']) . '" class="text-blue-500 hover:underline">Edit</a> | ';
                                echo '<a href="../../app/action/admin/tags/delete.php?id=' . htmlspecialchars($row['id_tag']) . '" class="text-red-500 hover:underline" onclick="return confirm(\'Are you sure you want to delete this tag?\');">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }

                            $database->disconnect();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Edit Status Modal -->
    <div id="editStatusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-3xl w-full mx-4 shadow-2xl">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-black">Edit Article Status</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-white transition-colors"
                        aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                

                <form id="editStatusForm" action="../../app/action/admin/Article/edit_status.php" method="POST"
                    class="space-y-4">
                    <input type="hidden" id="editArticleId" name="id_article">
                    <div>
                        <label for="articleStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="articleStatus" name="statut" required
                            class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-600 transition-all border border-gray-700">
                            <option value="In progress">In progress</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-white text-black border-black border-2 rounded-lg hover:bg-black hover:text-white transition-colors">
                            Cancel
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-black text-white border-black border-2 rounded-lg hover:bg-white hover:text-black transition-colors">
                            <span>Save</span>
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
        function openEditModal(id, status) {
            document.getElementById('editArticleId').value = id;
            const statusSelect = document.getElementById('articleStatus');
            for (let i = 0; i < statusSelect.options.length; i++) {
                if (statusSelect.options[i].value === status) {
                    statusSelect.selectedIndex = i;
                    break;
                }
            }
            document.getElementById('editStatusModal').classList.remove('hidden');
            document.getElementById('editStatusModal').classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('editStatusModal');
            modal.classList.add('hidden');
            document.getElementById('editStatusForm').reset();
        }
    </script>
</body>

</html>