<?php
session_start();
require_once "./config/connection_database.php";
$id = $_SESSION["userid"];

$result = $database_connection->prepare("SELECT * FROM `tb_user` WHERE `id` = ? ;");
$result->execute([$id]);
$data = $result->fetch();

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./tailwind.css" />
    <title>ToDoes</title>
</head>

<body>
    <div class="w-screen flex items-start justify-center bg-gray-50">
        <div class="absolute w-screen h-48 bg-indigo-500 z-0">
            <a href="dashboard.php" class="block px-4 py-2 w-auto text-sm text-white m-9 hover:underline">
                Kembali ke halaman dashboard
            </a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 w-4/5 h-auto mt-24 mb-32 z-30">
            <div class="tabContainer">
                <div class="buttonContainer w-full flex">
                    <button class="w-1/2 h-16 font-bold" style="outline: none;" onclick="showPanel(0)">Profile</button>
                    <button class="w-1/2 h-16 font-bold" style="outline: none;" onclick="showPanel(1)">Edit Profile</button>
                </div>
                <!-- PANEL 1 -->
                <div class="tabPanel">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="flex items-center justify-center mt-12">
                            <img class="h-1/3 w-1/3 rounded-full" src="./images/profile_pic.svg" alt="">
                        </div>
                        <p class="font-bold text-3xl text-gray-800"><?php echo $data["username"] ?></p>
                        <p class="font-bold text-2xl text-gray-800"><?php echo $data["nama_lengkap"] ?></p>
                        <p class="font-bold text-sm text-gray-800"><?php echo $data["email"] ?></p>
                    </div>
                </div>
                <!-- PANEL 2 -->
                <div class="tabPanel">
                    <div class="md:grid md:grid-cols-2 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="flex items-center justify-center mt-12">
                                <img class="h-1/2 w-1/2 rounded-full" src="./images/profile_pic.svg" alt="">
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-1">
                            <form action="./config/edit_profile.php" method="POST">
                                <div class="sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-3 sm:p-6">
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">
                                                Username
                                            </label>
                                            <div class="mt-1">
                                                <input value='<?php echo $data["username"] ?>' id="username" name="username" type="text" autocomplete="username" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">
                                                Nama lengkap
                                            </label>
                                            <div class="mt-1">
                                                <input value='<?php echo $data["nama_lengkap"] ?>' id="nama_lengkap" name="nama_lengkap" type="text" autocomplete="namalengkap" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">
                                                Old Password
                                            </label>
                                            <div class="mt-1">
                                                <input id="old-password" name="old-password" type="password" autocomplete="old-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">
                                                New Password
                                            </label>
                                            <div class="mt-1">
                                                <input id="new-password" name="new-password" type="password" autocomplete="new-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">
                                                Confirmation New Password
                                            </label>
                                            <div class="mt-1">
                                                <input id="confirm-new-password" name="confirm-new-password" type="password" autocomplete="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Confirmation Password">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-indigo-500 text-white flex justify-center py-2 z-40" style="position: fixed;left: 0;bottom: 0;width: 100%;text-align: center;">©Copyright by 18111032 - Dandi Supriyadi</div>
    <script>
        var tabButtons = document.querySelectorAll(".tabContainer .buttonContainer button");
        var tabPanels = document.querySelectorAll(".tabContainer  .tabPanel");

        function showPanel(panelIndex) {
            tabButtons.forEach(function(node) {
                //button unselected
                node.classList.remove("text-gray-700")
                node.classList.remove("border-b-2");
                node.classList.remove("border-indigo-600");
                node.classList.add("text-gray-400")
            });
            // button selected
            tabButtons[panelIndex].classList.remove("text-gray-400");
            tabButtons[panelIndex].classList.add("text-gray-700");
            tabButtons[panelIndex].classList.add("border-b-2");
            tabButtons[panelIndex].classList.add("border-indigo-600");
            console.log(tabButtons[panelIndex]);

            tabPanels.forEach(function(node) {
                // panel unselected
                node.style.display = "none";
            });
            // panel selected
            tabPanels[panelIndex].style.display = "block";
        }
        showPanel(0);
    </script>
</body>

</html>