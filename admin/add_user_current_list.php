<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }
    include('../config/db_connect.php');
    include('../config/functions.php');

    $result=null;
    $search_res = '';
    if(isset($_POST['search_btn'])){
        $search_res = $_POST['search_res'];
        $Cap_search_res = strtoupper($search_res);
        $query = "SELECT * FROM user WHERE name LIKE '$Cap_search_res%'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_rows = mysqli_num_rows($result);
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
<body>
    <section class="container mx-auto">
        <div class="flex justify-center mt-24 flex-wrap items-center px-4 py-4 bg-white ">
            <div class="relative">
                <form action="" method="POST">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3">
                        <button type="submit" name="search_btn">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <input type="text" name="search_res" value="<?php echo $search_res; ?>" id="table-search-users" class="block p-2 pl-12 px-24 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-400 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for users">
                </form>
            </div>
        </div>

        <div class="main-container overflow-x-auto relative shadow-md rounded-lg mt-12 lg:mx-80">
            <table class="w-full text-sm text-left text-gray-500">
                <tbody>
                    <?php if($result): ?>
                        <?php if($total_rows > 0): ?>
                            <?php foreach($data as $records): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold"><?php echo $records['name']; ?></div>
                                            <div class="font-normal text-gray-500"><?php echo $records['email']; ?></div>
                                            <div class="font-normal text-gray-500"><?php echo $records['phone_no']; ?></div>
                                        </div>  
                                    </th>
                                    <!-- <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $records['food_timing']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $records['delivery_boy']; ?></div>
                                    </td> -->
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $records['package_type']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div> Active
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <a type="button" href="./add_user_to_current_table.php?user_id=<?php echo $records['id']; ?>" class="font-medium text-blue-600 hover:underline cursor-pointer">Add user</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <h3>No result found!</h3>
                        <?php endif; ?>
                    <?php else: ?>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../assets/sidebar.js"></script>
    <!-- sidenav link -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
</body>
</html>