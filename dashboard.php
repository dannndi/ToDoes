<?php
session_start();
include 'config/get_notes.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tailwind.css" />
    <title>Dashboard ToDoes</title>
</head>

<body>
    <div id="overlay" class="hidden absolute w-full h-full bg-black opacity-25"></div>
    <div class="flex flex-col">
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="./images/logo.svg" alt="Workflow">
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold leading-tight text-gray-900">
                        ToDoes
                    </h1>
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="ml-3 relative">
                            <div class="flex items-center">
                                <h3 class="mr-2"><?php echo $_SESSION["username"] ?></h3>
                                <button class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true" onclick="showHideMenu()">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full" src="./images/profile_pic.svg" alt="">
                                </button>
                            </div>
                            <div class="hidden z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu" id="menu-profile">
                                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
                                <a href="config/signout_user.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <header class="shadow-lg">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-start">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">
                    Dashboard
                </h1>
                <button type="submit" onclick="showAddNote()" class="group relative w-32 flex justify-center py-2 px-4 ml-12 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Tambah Note
                </button>
            </div>
        </header>
        <!-- START Add Todoes PopUp -->
        <div id="add" class="hidden container absolute mt-20 w-full lg:w-1/2 lg:transform lg:translate-x-1/2 md:w-1/2 md:transform md:translate-x-1/2  bg-white shadow-lg p-5 rounded-lg">
            <form id="form-note" action="config/tambah_note.php" method="POST">
                <div class="flex justify-between items-center">
                    <h3 id="tambah-note" class="text-md tracking-tight font-bold text-gray-800">Tambah Note</h3>
                    <button type="button" onclick="closeAddNote()" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <hr class="my-3">
                <input type="hidden" id="id-card" name="id-card" value="" />
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 sm:col-span-2">
                        <label for="company_website" class="block text-sm font-medium text-gray-700">
                            Judul
                        </label>
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text" name="title" id="title" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Make Hello World Project">
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <label for="about" class="block text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>
                    <div class="mt-2">
                        <textarea id="desc" name="desc" rows="4" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Make hello world project in all program language"></textarea>
                    </div>
                </div>

                <div class="mt-2">
                    <label for="about" class="block text-sm font-medium text-gray-700">
                        Tanggal Deadline
                    </label>
                    <div class="mt-2">
                        <input type="date" name="datepicker" id="datepicker" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" />
                    </div>
                </div>

                <div class="mt-16">
                    <button type="submit" id="button-buat" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        </span>
                        Buat Note
                    </button>

                    <button type="submit" id="button-edit" class="hidden group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Edit Note
                    </button>

                    <button type="submit" id="button-delete" onclick="deleteNote()" class="hidden group mt-4 relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Delete Note
                    </button>
                </div>
            </form>
        </div>
        <!-- END Add Todoes PopUp -->
        <main class="bg-gray-50 h-screen">
            <?php if ($q->rowCount() == 0) : ?>
                <div class="flex justify-center flex-col items-center py-2">
                    <h1 class="text-2xl leading-tight text-gray-900 text-center	">Baru di Todoes ? mulai dengan buat Note Baru !</h1>
                    <img class="mt-20 h-1/2 w-1/4" src="./images/Add_notes.svg" alt="Workflow">
                </div>
            <?php else : ?>
                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                    <?php while ($row = $q->fetch()) :
                        $id = $row['id'];
                        $title = $row['title_todoes'];
                        $desc = $row['des_todoes'];
                        $fulldesc = $row['des_todoes'];
                        $date = trim($row['date_todoes'], " ");
                        $desclimited = '';
                        if (strlen($desc) >= 100) {
                            $desclimited = substr($desc, 0, 99);
                        } else {
                            $desclimited = $desc;
                        }
                    ?>
                        <div data-modal-target="#model" id="todo-card" class="col-span-1 bg-white shadow-lg m-3 p-3 rounded-lg flex flex-col justify-between">
                            <input type="hidden" id="id-card" value=<?php echo $id ?> />
                            <h3 class="text-2xl tracking-tight font-bold text-gray-800"><?php echo $title; ?></h3>
                            <p class="hidden text-md text-gray-400 px-2 my-2"><?php echo $fulldesc; ?></p>
                            <p class=" text-md text-gray-400 px-2 my-2"><?php echo $desclimited; ?></p>
                            <div class="flex items-center justify-end">
                                <p class="text-md text-gray-400 mr-2">Deadline : </p>
                                <p class="text-md text-indigo-400"><?php echo $date; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <div class="mt-20 bg-indigo-500 text-white flex justify-center py-2" style="position: fixed;left: 0;bottom: 0;width: 100%;text-align: center;">©Copyright by 18111032 - Dandi Supriyadi</div>
        </main>
    </div>
    <script>
        var edit = document.querySelectorAll('[data-modal-target]');
        edit.forEach(card => {
            card.addEventListener("click", () => {
                showAddNote();
                document.getElementById('form-note').action = "config/edit_note.php";
                document.getElementById('id-card').value = card.children[0].value;
                document.getElementById('tambah-note').innerHTML = "Edit Note ";
                document.getElementById('title').value = card.children[1].innerHTML;
                document.getElementById('desc').value = card.children[2].innerHTML;
                var date = card.children[4].children[1].innerHTML;
                console.log(date);
                var datemanual = "2021-01-16";
                console.log(datemanual);
                document.getElementById('datepicker').value = date;
                document.getElementById('button-edit').style.display = "block";
                document.getElementById('button-delete').style.display = "block";
                document.getElementById('button-buat').style.display = "none";
            });
        });

        function deleteNote() {
            document.getElementById('form-note').action = "config/delete_note.php";
        }

        function showHideMenu() {
            var menu = document.getElementById('menu-profile');
            if (menu.style.display == "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        function showHideMenu() {
            var menu = document.getElementById('menu-profile');
            if (menu.style.display == "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        function showAddNote() {
            var add = document.getElementById('add');
            var overlay = document.getElementById('overlay');

            add.style.display = "block";
            overlay.style.display = "block";

            document.getElementById('form-note').action = "config/tambah_note.php";
            document.getElementById('id-card').value = "";
            document.getElementById('tambah-note').innerHTML = "Tambah Note";
            document.getElementById('title').value = "";
            document.getElementById('desc').value = "";
            document.getElementById('datepicker').value = "";
            document.getElementById('button-edit').style.display = "none";
            document.getElementById('button-delete').style.display = "none";
            document.getElementById('button-buat').style.display = "block";
        }

        function closeAddNote() {
            var add = document.getElementById('add');
            var overlay = document.getElementById('overlay');
            add.style.display = "none";
            overlay.style.display = "none";
        }
    </script>
</body>

</html>