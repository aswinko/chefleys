<?php 
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }
    include('../config/db_connect.php');

    if(isset($_POST['action'])){
        $query = "SELECT * FROM user ";

        // if(isset($_POST['date_filter']) && !empty($_POST['date_filter'])){
        //     $query = "AND";
        // }

        // if(isset($_POST['checkbox'])){
        //     $check_filter = implode("','", $_POST['checkbox']);
        //     $query .= "AND food_timing IN('".$check_filter."')";
        // }

        if(isset($_POST['selectBox']) && !empty($_POST['selectBox'])){
            $query .= "delivery_boy IN('".$_POST['selectBox']."')";
        }

        $res = mysqli_query($conn, $query);
        $data = mysqli_fetch_all($res);
        $total_row = mysqli_num_rows($res);

        if($total_row > 0){
            foreach($data as $records){
                $output .= '<tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap">
                    <div class="pl-3">
                        <div class="text-base font-semibold">'.$records['name'].'</div>
                        <div class="font-normal text-gray-500">'.$records['email'].'</div>
                        <div class="font-normal text-gray-500">'.$records['phone_no'].'</div>
                    </div>  
                </th>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">'.$records['address1'].'</div>
                    <div class="font-normal text-gray-500">'.$records['address2'].'</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">'.$records['veg_or_nonveg'].'</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">'.$records['food_timing'].'</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">Start date - '.$records['start_date'].'</div>
                    <div class="font-normal text-gray-500">End date - '.$records['end_date'].'</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">'.$records['delivery_boy'].'</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">'.$records['package_type'].'</div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-normal text-gray-500">'.$records['remarks'].'</div>
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
            </tr>';
            }
        }else {
            $output = "<h3 class=''>No records found</h3>";
        }
        echo $output;
    }
?>