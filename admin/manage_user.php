<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }
    include '../config/db_connect.php';
    include '../config/functions.php';

    $num = 1;

    $show_delivery_partner = show_delivery_partner();
    $data = mysqli_fetch_all($show_delivery_partner, MYSQLI_ASSOC);

    $show_packages = show_packages();
    $pack_data = mysqli_fetch_all($show_packages, MYSQLI_ASSOC);

    $filt_date = '';
    $formatted_date = '';
    if (isset($_POST['date_filter'])){
        $filt_date = $_POST['date'];
        // echo date('Y-m-d', strtotime($_POST['date']));
        
        $new =  str_replace("/","-","$filt_date");
        $formatted_date = date('Y-m-d', strtotime($new));
    }
    // echo $filt_date;
    
    $_SESSION['formatted_date'] = $formatted_date;
    //  echo $new;
    // echo $filt_date;

    // $sql = 'SELECT * FROM user ORDER BY id DESC';
    if($filt_date == ''){
        $sql = "SELECT * FROM user ORDER BY id DESC";
    }else{
        $sql = "SELECT * FROM user WHERE '$formatted_date' BETWEEN user.start_date AND user.end_date ORDER BY id DESC";
    }
    $res = mysqli_query($conn, $sql);
    $record = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $rows = mysqli_num_rows($res);
    

    //additionalsubscription 
    $sq = "SELECT * FROM additional_subscription WHERE date = '$formatted_date' ORDER BY id DESC";
    $result = mysqli_query($conn, $sq);
    $additional_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // $total_rows = mysqli_num_rows($res);
    // foreach($additional_data as $additional_datas){
    //     $user_id = $additional_datas['id'];

    // }
      //fetching category name
    //   $package_sql = "SELECT * FROM category WHERE category_id = '$category_id'";
    //   $query = mysqli_query($conn, $package_sql);
    //   $package = mysqli_fetch_assoc($query);
    //   $package_id = $package['id'];
    //   $package_type = $package['package_type'];
    

    // if(isset($_POST['chechbox_filter'])){

        // if (isset($_POST["all"])) {
        //     $sql = "SELECT * FROM user ORDER BY id DESC";
        //     $res = mysqli_query($conn, $sql);
        //     $record = mysqli_fetch_all($res, MYSQLI_ASSOC);
        //     $rows = mysqli_num_rows($res);
        // }
        // if (isset($_POST["breakfast"])) {
        //     $arguments[] = "food_timing LIKE '%breakfast%'";
        // }
    
        // if (isset($_POST["lunch"])) {
        //     $arguments[] = "food_timing LIKE '%lunch%'";
        // }
    
        // if (isset($_POST["dinner"])) {
        //     $arguments[] = "food_timing LIKE '%dinner%'";
        // }
    
        // if(!empty($arguments)) {
        //     $str = implode(' or ',$arguments);
        //     // $filt_date >= $startdate) && ($filt_date <= $enddate
        //     // $sql = "SELECT * FROM user WHERE  " . $str . "AND '28-12-2022'>=start_date AND '28-12-2022'<= end_date ORDER BY id DESC";
        //     $sql = "SELECT * FROM user WHERE  " . $str . "AND '$formatted_date' BETWEEN user.start_date AND user.end_date ORDER BY id DESC";
        //     $res = mysqli_query($conn, $sql);
        //     $record = mysqli_fetch_all($res, MYSQLI_ASSOC);
        //     $rows = mysqli_num_rows($res);
        // } else {
        // //Whatever happens when there's none checked.
        // }

    // }


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-slate-100">
    <?php
include('./sidebar.php');
?>
    <div class="container mx-auto px-4">
        <h2 class="mb-4 text-2xl text-gray-600 font-bold">Manage Users</h2>
        <div class="flex justify-between flex-wrap items-center px-4 py-4 bg-white ">
            <div class="flex flex-wrap">
                <form id="form-date" action="" method="post">
                    <div class="flex items-center justify-center block mb-4 lg:mb-0">
                        <div class="datepicker relative form-floating mb-3 w-full" data-mdb-toggle-button="false">
                            <input type="text"
                            name="date"
                            value="<?php echo $filt_date; ?>"
                            class="date date_fil form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            placeholder="Select a date" data-mdb-toggle="datepicker" />
                            <input type="hidden" value="<?php echo $filt_date; ?>" id="date_fil">
                            <label for="floatingInput" class="text-gray-700">Select a date</label>
                        </div>
                        <button type="submit" name="date_filter" class="text-white ml-4 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center mb-2">Filter</button>
                    </div>
                </form>
                <form id="form" action="" method="post">
                    <div class="flex flex-row mx-1 md:mx-6 mb-4 mt-4 lg:mb-0 flex-wrap">
                        <div class="flex items-center p-2 rounded hover:bg-gray-100">
                            <input id="filter-checkbox-example-0" type="radio" value="all" name="food_timing" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" <?=(isset($_POST['all'])?' checked':'')?>>
                            <label for="filter-checkbox-example-0" class="ml-2 w-full text-sm font-medium text-gray-900 rounded">All</label>
                        </div>
    
                        <div class="flex items-center p-2 rounded hover:bg-gray-100">
                            <input id="filter-checkbox-example-1" type="radio" value="breakfast" name="food_timing" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" <?=(isset($_POST['breakfast'])?' checked':'')?>>
                            <label for="filter-checkbox-example-1" class="ml-2 w-full text-sm font-medium text-gray-900 rounded">Breakfast</label>
                        </div>
        
                        <div class="flex items-center p-2 rounded hover:bg-gray-100">
                            <input id="filter-checkbox-example-2" type="radio" value="lunch" name="food_timing" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" <?=(isset($_POST['lunch'])?' checked':'')?>>
                            <label for="filter-checkbox-example-2" class="ml-2 w-full text-sm font-medium text-gray-900 rounded">Lunch</label>
                        </div>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100">
                            <input id="filter-checkbox-example-3" type="radio" value="dinner" name="food_timing" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" <?=(isset($_POST['dinner'])?' checked':'')?>>
                            <label for="filter-checkbox-example-3" class="ml-2 w-full text-sm font-medium text-gray-900 rounded">Dinner</label>
                        </div>
                        <!-- <button type="submit" name="chechbox_filter" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center mb-2">Filter</button> -->
                    </div>
                </form>

                <form action="" method="post" class="mb-4 lg:mb-0">
                    <select name="fetchval" id="fetchval" class="mb-4 md:mb-0 mt-4 inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm pl-4 pr-10 py-1.5">
                        <?php if($data): ?>
                            <option value="">Select Delivery Partner</option>
                            <?php foreach($data as $datas): ?>

                                <option value="<?php echo htmlspecialchars($datas['d_name']); ?>"><?php echo htmlspecialchars($datas['d_name']); ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value=""></option>
                        <?php endif; ?>
                    </select>

                </form>
            </div>
            
            <div class="mb-4 lg:mb-0">
                <a href="./add_user_current_list.php" class="relative inline-flex items-center justify-center p-4 px-6 py-2 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-blue-500 rounded-full shadow-md group">
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-blue-500 group-hover:translate-x-0 ease">
                        <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg> -->
                        <img src="../assets/icons/plus.svg" alt="icon" class="w-6 h-6" style="filter:  brightness(0) invert(1);">
                    </span>
                    <span class="absolute flex items-center justify-center w-full h-full text-blue-500 transition-all duration-300 transform group-hover:translate-x-full ease">Add user</span>
                    <span class="relative invisible">Add user</span>
                </a>
            </div>
            <div class="mb-4 lg:mb-0">
                <a href="" class="relative inline-flex items-center justify-center p-4 px-6 py-2 overflow-hidden font-medium text-white transition duration-300 ease-out border-2 border-blue-500 bg-blue-400 rounded-full shadow-md group">
                    Download
                </a>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mb-4 md:mb-0">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search-users" class="block p-2 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for users">
            </div>
        </div>
        <div class="main-container overflow-x-auto relative shadow-md rounded-lg">
            <div class="flex flex-wrap justify-between items-center px-4 pb-6 pt-4 bg-gray-50 border border-rose-200 font-semibold text-[1.2rem]">
                <div class="flex flex-wrap">
                <?php 
                    $total_package = 0;
                     foreach($pack_data as $pack_datas){
                        $pack = $pack_datas['package_type'];
                        if($filt_date == ''){
                            $query_pack = "SELECT * FROM user WHERE package_type = '$pack'";
                            $sqll = "SELECT * FROM additional_subscription WHERE package_type = '$pack' AND  date = '$formatted_date'";
                        }else{
                            $sqll = "SELECT * FROM additional_subscription WHERE package_type = '$pack' AND  date = '$formatted_date'";
                            $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND '$formatted_date' BETWEEN user.start_date AND user.end_date";
                        }
                        $res_pack = mysqli_query($conn, $query_pack);
                        $pack_count = mysqli_num_rows($res_pack);
    
                        $res_pack_sub = mysqli_query($conn, $sqll);
                        $pack_count1 = mysqli_num_rows($res_pack_sub);
                        // echo $pack_count+$pack_count1;
                        $sumof_mainlist_and_sublist = $pack_count+$pack_count1;
                        // echo $tot; 
    
                        $pack_row = "<p class='mx-2'>Total ". $pack_datas['package_type']." :  $sumof_mainlist_and_sublist</p>";
                        echo $pack_row;
                        $total_package += $sumof_mainlist_and_sublist; 
                    } 
                ?>
                </div>
                <div class="flex flex-wrap">
                    <p class="mx-2 font-bold">Total Packages : <?php echo $total_package; ?></p>
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="py-6 px-8">
                            Name
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Address
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Veg/non-veg
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Food timing
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Start_date-End_date
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Delivery boy
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Package type
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Remarks
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Status
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Active/InActive
                        </th>
                        <th scope="col" class="py-6 px-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php if ($record): ?>
                        <?php foreach ($record as $records): ?>
                            

                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold"><?php echo $records['name']; ?></div>
                                        <div class="font-normal text-gray-500"><?php echo $records['email']; ?></div>
                                        <div class="font-normal text-gray-500"><?php echo $records['phone_no']; ?></div>
                                    </div>  
                                </th>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500"><?php echo $records['address1']; ?></div>
                                    <div class="font-normal text-gray-500"><?php echo $records['address2']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500"><?php echo $records['veg_or_nonveg']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500"><?php echo $records['food_timing']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500">Start date - <?php echo $records['start_date']; ?></div>
                                    <div class="font-normal text-gray-500">End date - <?php echo $records['end_date']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500"><?php echo $records['delivery_boy']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500"><?php echo $records['package_type']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-normal text-gray-500"><?php echo $records['remarks']; ?></div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div> Active
                                    </div>
                                        <!-- <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> Offline
                                    </div> -->
                                </td>
                                <td class="py-4 px-6">
                                    <!-- toggle -->
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer input-switch">
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                                        <!-- <span class="info-text ml-3 text-[10px] font-medium text-gray-900 dark:text-gray-300"></span> -->
                                    </label>

                                </td>
                                <td class="py-4 px-6">
                                    <!-- Modal toggle -->
                                    <a href="#" type="button" data-modal-toggle="editUserModal" class="font-medium text-blue-600 hover:underline">Edit user</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                    <?php endif; ?>


                    <?php if ($additional_data): ?>
                        <?php
                            
                        ?>
                        <?php foreach ($additional_data as $additional_datas): ?>
                            <?php 
                                $user_id = $additional_datas['user_id'];
                                $sql = "SELECT * FROM user WHERE id = '$user_id'";
                                $res = mysqli_query($conn, $sql);
                                $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
                                
                            ?>
                            <?php foreach($rows as $row): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                                        <div class="pl-3">
                                            <div class="rounded-full bg-green-600 px-2 w-fit text-[10px] text-white font-semibold">Added</div>
                                            <div class="text-base font-semibold"><?php echo $row['name']; ?></div>
                                            <div class="font-normal text-gray-500"><?php echo $row['email']; ?></div>
                                            <div class="font-normal text-gray-500"><?php echo $row['phone_no']; ?></div>
                                        </div>  
                                    </th>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $row['address1']; ?></div>
                                        <div class="font-normal text-gray-500"><?php echo $row['address2']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $row['veg_or_nonveg']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $row['food_timing']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500 text-[12px] lg:text-sm">Added date - <?php echo $formatted_date; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $row['delivery_boy']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $additional_datas['package_type']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-normal text-gray-500"><?php echo $row['remarks']; ?></div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div> Active
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <!-- Modal toggle -->
                                        <a href="#" type="button" data-modal-toggle="editUserModal" class="font-medium text-blue-600 hover:underline">Edit user</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    <?php else: ?>

                    <?php endif; ?>
                </tbody>
            </table>
            <!-- Edit user modal -->
            <div id="editUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center p-4 w-full md:inset-0 h-modal md:h-full">
                <div class="relative w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <form method="post" action="" class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-4 rounded-t border-b">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Edit user
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editUserModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                    <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Bonnie" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                    <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Green" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                                    <input type="number" name="phone-number" id="phone-number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="e.g. +(12)3456 789" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="address1" class="block mb-2 text-sm font-medium text-gray-900">Address1</label>
                                    <input type="text" name="address1" id="address1" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Development" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="address2" class="block mb-2 text-sm font-medium text-gray-900">Address2</label>
                                    <input type="text" name="address2" id="address2" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="123456" required="">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="money" class="block mb-2 text-sm font-medium text-gray-900">No of Package</label>
                                    <input
                                    type="number"
                                    name="no_of_package"
                                    placeholder="No of packages"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                    />
                                    <!-- <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400"></div> -->
                                    <span class="text-sm text-red-600 hidden" id="error">This field is required</span>
                                </div>

                                <fieldset class="col-span-6 sm:col-span-3">
                                    <legend class="block mb-2 text-sm font-medium text-gray-900">Choose an option</legend>
                                    <div class="block pt-3 pb-2 space-x-">
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

                                <fieldset class="col-span-6 sm:col-span-3">
                                <legend class="block mb-2 text-sm font-medium text-gray-900">Choose an option</legend>
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

                            <div class="col-span-6 sm:col-span-3">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                                <input
                                    type="text"
                                    name="start_date"
                                    placeholder="mm/dd/yyyy"
                                    onclick="this.setAttribute('type', 'date');"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                />
                                <span class="text-sm text-red-600 hidden" id="error">Start Date is required</span>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                                <input
                                    type="text"
                                    name="end_date"
                                    placeholder="mm/dd/yyyy"
                                    onclick="this.setAttribute('type', 'date');"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                />
                                <span class="text-sm text-red-600 hidden" id="error">End Date is required</span>
                            </div>



                            <div class="col-span-6 sm:col-span-3">
                                <label for="select" class="block mb-2 text-sm font-medium text-gray-900">Select Delivery Partner</label>
                                <select
                                name="delivery_boy"
                                value=""
                                onclick="this.setAttribute('value', this.value);"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                >
                                    <option value="" selected disabled>Choose any of these</option>
                                    <!-- <option value="">Select a Category</option> -->
                                    <!-- <?php if($records): ?>
                                        <?php foreach($records as $record): ?>
                                            <option value="<?php echo htmlspecialchars($record['id']); ?>" <?=$package_id == $record['id'] ? 'selected' : '' ?> ><?php echo htmlspecialchars($record['package_type']); ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">no Packages</option>
                                    <?php endif; ?> -->
                                </select>
                                <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="select" class="block mb-2 text-sm font-medium text-gray-900">Choose Package Type</label>
                                <select
                                name="package_type"
                                value=""
                                onclick="this.setAttribute('value', this.value);"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                >
                                <option value="" selected disabled>Choose any of these</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                                <option value="5">Option 5</option>
                                </select>
                                <span class="text-sm text-red-600 hidden" id="error">Option has to be selected</span>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <textarea name="remarks" id="" cols="30" placeholder="Enter Remarks" rows="2" class="pshadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"></textarea>
                            </div>

                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save all</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> 
    <script src="../assets/sidebar.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
     <!-- sidenav link -->
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script type="text/javascript">  
        $(function(){
        $('.date').on('change',function(){
            $('#form-date').submit();
            });
        });
    </script>
    <!-- <script type="text/javascript">  
        $(function(){
        $('.checkbox').on('change',function(){
            $('#form').submit();
            });
        });
    </script> -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval").on('change', function(){
                var value = $(this).val();
                // alert(value);
                $.ajax({
                    url:"fetch.php",
                    type:"POST",
                    data:'request=' + value,
                    beforeSend:function(){
                        $(".main-container").html("<span>Loading....</span>");
                    },
                    success:function(data){
                        $(".main-container").html(data);
                    }
                })
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".checkbox").on('change', function(){
                var value = $(this).val();
                // alert(value);
                $.ajax({
                    url:"fetch.php",
                    type:"POST",
                    data:'checkbox_request=' + value,
                    beforeSend:function(){
                        $(".main-container").html("<span>Loading....</span>");
                    },
                    success:function(data){
                        $(".main-container").html(data);
                    }
                })
            });
        })
    </script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            filter_data();
            function filter_data(){
                var action = 'fetch_data';
                var date_filter = $('#date_filter').val();
                var checkbox = get_filter('checkbox');
                var selectBox = $('#fetchval').val();

                $.ajax({
                    url:"fetch_data.php",
                    method:"POST",
                    data:{action:action, date_filter:date_filter, checkbox:checkbox, selectBox:selectBox},
                    success:function(data){
                        $('.main-container').html(data);
                    }
                });
            }

            function get_filter(class_name){
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.checkbox').click(function(){
                filter_data();
            })
        });

    </script> -->
</body>
</html>