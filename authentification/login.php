<?php
require_once '../app/class/user.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::getByEmail($email); 
  
    if ($user && password_verify($password, $user['mot_de_passe'])) {
        if ($user['id_role_fk'] == 1) {
            header('Location: ../Dashboard/index.php ');

        }else if ($user['id_role_fk'] == 2) {
            header('location: ../public/home.php');
        }
        

    }else {
        $error = 'Email ou mot de passe incorrect';
    }



 
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

</head>



<body>







    <section class="bg-[url('../public/img/landingPageBG.jpg')] bg-cover bg-center ">
        <div class="flex    md:h-screen lg:py-0">

            <div
                class="w-[45%] flex flex-col justify-center px-8 border-r-2 border-r-white bg-black    h-[100vh] bg-  sblackhadow-xl shadow-white/40">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-2xl font-bold text-white ">
                        Login
                    </h1>
                    <form action="login.php" method="post" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="email" class="block mb-2 text-sm text-white">Your email</label>
                            <input type="email" name="email" id="email"
                                class="w-full p-3 border-2 border-white  rounded-xl text-sm "
                                placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm text-white">Your password</label>
                            <input type="password" name="password" id="password" class="w-full p-3  rounded-xl text-sm"
                                placeholder="********" required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                        required="">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-white">Remember me</label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium text-primary-600 hover:underline text-white">Forgot
                                password?</a>
                        </div>
                        <button 
                            class="w-full text-black rounded-2xl bg-white text-center py-2 hover:bg-black border-2 hover:text-white hover:border-2 border-white transform duration-300"> Login</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="signup.php"
                                class="font-medium text-white hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>

            <div class="flex flex-col justify-center px-8">
            <h2 class="text-balance text-slate-100 font-semibold w-[450px]  text-5xl"><span
                        class="text-white font-light">VROOM</span> the perfect car rental experience!</h2>
                <p class="mt-6 text-pretty text-lg/8 w-[550px] font-light  text-gray-100">Ready to hit the road? Take
                    the wheel of your perfect car today! Whether it's for a weekend getaway, a business trip, or just
                    exploring your city, we’ve got the ideal vehicle waiting for you. With quick booking, flexible
                    rental terms, and the best prices around, it's never been easier to drive in comfort and style.
                    Don't wait—your next adventure starts now!</p>
              
                
            </div>

        </div>
    </section>












</body>

</html>