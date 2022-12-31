<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }

    include('../config/db_connect.php');
    include('../config/functions.php');


    if(isset($_POST['add_package'])){
        $package_type=$_POST['package'];

        addPackage($package_type);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chefleys</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .-z-1 {
            z-index: -1;
        }

        .origin-0 {
            transform-origin: 0%;
        }

        input:focus ~ label,
        input:not(:placeholder-shown) ~ label,
        textarea:focus ~ label,
        textarea:not(:placeholder-shown) ~ label,
        select:focus ~ label,
        select:not([value='']):valid ~ label {
            /* @apply transform; scale-75; -translate-y-6; */
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate))
            skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            --tw-scale-x: 0.75;
            --tw-scale-y: 0.75;
            --tw-translate-y: -1.5rem;
        }

        input:focus ~ label,
        select:focus ~ label {
            /* @apply text-black; left-0; */
            --tw-text-opacity: 1;
            color: rgba(0, 0, 0, var(--tw-text-opacity));
            left: 0px;
        }
        </style>
</head>
<body class="bg-gray-100">
    <?php include('./sidebar.php'); ?>
    <section class="container mx-auto mt-6">
        <div class="min-h-screen sm:p-12 p-2">
            <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg rounded-3xl">
                <h1 class="text-2xl font-bold mb-8 text-center">Add Package</h1>
                <form id="form" method="post" action="">
                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="text"
                        name="package"
                        placeholder=" "
                        required
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="package" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter Package</label>
                        <span class="text-sm text-red-600 hidden" id="error">This field is required</span>
                    </div>

                    <button
                        id="button"
                        type="submit"
                        name="add_package"
                        class="w-full px-4 py-1.5 sm:px-6 sm:py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
                    >
                        Add package
                    </button>
                </form>
            </div>
        </div>

    </section>
    <script src="../assets/sidebar.js"></script>
    <!-- sidenav link -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
</body>
</html>