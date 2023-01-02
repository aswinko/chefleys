<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }

    include('../config/db_connect.php');
    include('../config/functions.php');


    $show_package = show_packages();
    $package = mysqli_fetch_all($show_package, MYSQLI_ASSOC);

    $show_delivery_partner = show_delivery_partner();
    $delivery_partner = mysqli_fetch_all($show_delivery_partner, MYSQLI_ASSOC);

    if(isset($_POST['add_user'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone_no=$_POST['phone_no'];
        $address1=$_POST['address1'];
        $address2=$_POST['address2'];
        $veg_or_nonveg=$_POST['veg_or_nonveg'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $delivery_boy=$_POST['delivery_boy'];
        $package_type=$_POST['package_type'];
        $no_of_package=$_POST['no_of_package'];
        $remarks=$_POST['remarks'];
        $food_timing=implode(',',$_POST['food_timing']);

        addUser(
            $name,
            $email,
            $phone_no,
            $address1,
            $address2,
            $veg_or_nonveg,
            $food_timing,
            $start_date,
            $end_date,
            $delivery_boy,
            $package_type,
            $no_of_package,
            $remarks
        );

        // echo $all_food_timing;
    }

    //filter tood timing query
    // $sql = "SELECT * FROM user WHERE food_timing LIKE '%breakfast%'";
    // $query = mysqli_query($conn, $sql);
    // $data = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // foreach($data as $datas){
    //     $check = $datas['name'];
    //     echo $check;
    // }
    
    //retrive back comma seperated value from database
    // $check = explode(',', $check);
    // // echo $check[1];
    // $trimSpaces = array_map('trim',$check);

    // print_r($trimSpaces);
    

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
    <section class="container mx-auto">
        <div class="min-h-screen bg-gray-100 p-1.5 sm:p-12 sm:pt-0">
            <?php if(isset($_SESSION['success_message'])): ?>
                <div class="alert mt-6 bg-green-100 border border-green-400 text-green-700 rounded-lg py-5 px-6 mb-3 text-base inline-flex items-center w-full alert-dismissible fade show" role="alert">
                    <strong class="mr-1">Hey, </strong><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close">
                        <img src="../assets/icons/cross.svg" alt="" style="filter: invert(39%) sepia(31%) saturate(1061%) hue-rotate(90deg) brightness(94%) contrast(95%);">
                    </button>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert mt-6 bg-red-100 border border-red-400 text-red-700 rounded-lg py-5 px-6 mb-3 text-base inline-flex items-center w-full alert-dismissible fade show" role="alert">
                    <strong class="mr-1">Hey, </strong><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close">
                        <img src="../assets/icons/cross.svg" alt="" style="filter: invert(14%) sepia(86%) saturate(3288%) hue-rotate(15deg) brightness(112%) contrast(120%);">
                    </button>
                </div>
            <?php endif; ?>
            <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg rounded-3xl">
                <h1 class="text-2xl font-bold mb-8 text-center">Add Customer</h1>
                <form id="form" method="post" action="">
                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="text"
                        name="name"
                        placeholder=" "
                        required
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="name" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter name</label>
                        <span class="text-sm text-red-600 hidden" id="error">Name is required</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="email"
                        name="email"
                        placeholder=" "
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="email" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter email address</label>
                        <span class="text-sm text-red-600 hidden" id="error">Email address is required</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="text"
                        name="phone_no"
                        placeholder=" "
                        required
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="phone_no" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter Mobile number</label>
                        <span class="text-sm text-red-600 hidden" id="error">Mobile number is required</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="text"
                        name="address1"
                        placeholder=" "
                        required
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="address1" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter Address 1</label>
                        <span class="text-sm text-red-600 hidden" id="error">Address 1 is required</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="text"
                        name="address2"
                        placeholder=" "
                        required
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="address2" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter Address 2</label>
                        <span class="text-sm text-red-600 hidden" id="error">Address 2 is required</span>
                    </div>

                    <fieldset class="relative z-0 w-full p-px mb-5">
                        <legend class="absolute text-gray-500 transform scale-75 -top-3 origin-0">Choose an option</legend>
                        <div class="block pt-3 pb-2 space-x-4">
                        <label>
                            <input
                            type="radio"
                            name="veg_or_nonveg"
                            value="veg"
                            class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                            />
                            Veg
                        </label>
                        <label>
                            <input
                            type="radio"
                            name="veg_or_nonveg"
                            value="nonveg"
                            class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                            />
                            Non veg
                        </label>
                        </div>
                        <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                    </fieldset>

                    <fieldset class="relative z-0 w-full p-px mb-5">
                        <legend class="absolute text-gray-500 transform scale-75 -top-3 origin-0">Choose an option</legend>
                        <div class="block pt-3 pb-2 space-x-4">
                            <label>
                                <input
                                type="checkbox"
                                name="food_timing[]"
                                value="breakfast"
                                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                                />
                                Breakfast
                            </label>
                            <label>
                                <input
                                type="checkbox"
                                name="food_timing[]"
                                value="lunch"
                                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                                />
                                Lunch
                            </label>
                            <label>
                                <input
                                type="checkbox"
                                name="food_timing[]"
                                value="dinner"
                                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                                />
                                Dinner
                            </label>
                        </div>
                        <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                    </fieldset>

                    <div class="flex flex-row space-x-4">
                        <div class="relative z-0 w-full mb-5">
                            <input
                                type="text"
                                name="start_date"
                                placeholder=" "
                                onclick="this.setAttribute('type', 'date');"
                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                            />
                            <label for="date" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Start Date</label>
                            <span class="text-sm text-red-600 hidden" id="error">Start Date is required</span>
                        </div>
                        <div class="relative z-0 w-full">
                            <input
                                type="text"
                                name="end_date"
                                placeholder=" "
                                onclick="this.setAttribute('type', 'date');"
                                class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                            />
                            <label for="date" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">End Date</label>
                            <span class="text-sm text-red-600 hidden" id="error">End Date is required</span>
                        </div>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <select
                        name="delivery_boy"
                        value=""
                        onclick="this.setAttribute('value', this.value);"
                        class="pt-3 pl-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        >
                            <option value="" selected disabled hidden></option>
                            <?php if($delivery_partner): ?>
                                <?php foreach($delivery_partner as $delivery_partners): ?>
                                    <option class="" value="<?php echo htmlspecialchars($delivery_partners['d_name']); ?>"><?php echo htmlspecialchars($delivery_partners['d_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                
                            <?php endif; ?>
                        </select>
                        <label for="select" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Select Delivery Partner</label>
                        <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <select
                        name="package_type"
                        value=""
                        onclick="this.setAttribute('value', this.value);"
                        class="pt-3 pl-2 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        >
                            <option value="" selected disabled hidden></option>
                            <?php if($package): ?>
                                <?php foreach($package as $packages): ?>
                                    <option class="" value="<?php echo htmlspecialchars($packages['package_type']); ?>"><?php echo htmlspecialchars($packages['package_type']); ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                
                            <?php endif; ?>
                        </select>
                        <label for="select" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Choose Package Type</label>
                        <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <input
                        type="number"
                        name="no_of_package"
                        placeholder=" "
                        class="pt-3 pb-2 pl-5 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <!-- <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400"></div> -->
                        <label for="money" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">No of Package</label>
                        <span class="text-sm text-red-600 hidden" id="error">This field is required</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <textarea name="remarks" id="" cols="30" placeholder="Enter Remarks" rows="2" class="pt-3 pb-2 pl-3 rounded-lg block w-full px-0 mt-0 bg-transparent border-2 appearance-none focus:outline-none focus:ring-0 border-gray-200"></textarea>
                    </div>

                    <button
                        id="button"
                        type="submit"
                        name="add_user"
                        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
                    >
                        Register
                    </button>
                </form>

                <fieldset class="border-t border-slate-300 mt-8">
                    <legend class="mx-auto px-4 text-gray-500 text-lg italic">OR</legend>
                </fieldset>

                <form action="excel_import.php" method="post" enctype="multipart/form-data">
                    <!-- <input type="file" placeholder="import excel" class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"> -->
                    <div class="flex w-full items-center justify-center bg-grey-lighter">
                        <label class="w-64 flex flex-col items-center mt-4 px-3 py-3 bg-white text-pink-500 rounded-lg shadow-lg tracking-wide border border-blue transition-all duration-500 ease-linear cursor-pointer hover:text-pink-700">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span for="file-upload" class="mt-2 text-base leading-normal">IMPORT EXCEL</span>
                            <input id="file-upload" type='file' class="hidden" name="excel_file" required/>
                        </label>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" name="excel_submit" class="px-2 py-1.5 w-60 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none">Import</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <script>
    'use strict'

    document.getElementById('button').addEventListener('click', toggleError)
    const errMessages = document.querySelectorAll('#error')

    // function toggleError() {
    //     // Show error message
    //     errMessages.forEach((el) => {
    //     el.classList.toggle('hidden')
    //     })

    //     // Highlight input and label with red
    //     const allBorders = document.querySelectorAll('.border-gray-200')
    //     const allTexts = document.querySelectorAll('.text-gray-500')
    //     allBorders.forEach((el) => {
    //     el.classList.toggle('border-red-600')
    //     })
    //     allTexts.forEach((el) => {
    //     el.classList.toggle('text-red-600')
    //     })
    // }
    </script>
    <script>
        $('#file-upload').change(function() {
            var i = $(this).prev('span').clone();
            var file = $('#file-upload')[0].files[0].name;
            $(this).prev('span').text(file);
        });
    </script>
    <script src="../assets/sidebar.js"></script>
    <!-- sidenav link -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
</body>
</html>