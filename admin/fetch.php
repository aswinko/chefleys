<?php 
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }

    // sleep(1);
    usleep(500000);
    include('../config/db_connect.php');
    include('../config/functions.php');
    
    $show_packages = show_packages();
    $pack_data = mysqli_fetch_all($show_packages, MYSQLI_ASSOC);
    if(isset($_POST['request'])){
        
        $request = $_POST['request'];
        $formatted_date = $_SESSION['formatted_date'];
        if($request == ""){
            $result = getAllDeliveryBoy(); 
            $count = mysqli_num_rows($result);
            $sq = "SELECT * FROM additional_subscription WHERE date = '$formatted_date' ORDER BY id DESC";
         }else{
            $result = getDeliveryBoysByCategory($request);
            $count = mysqli_num_rows($result);

            //additionalsubscription 
            $sq = "SELECT * FROM additional_subscription WHERE date = '$formatted_date' ORDER BY id DESC";
        }
        $quering = mysqli_query($conn, $sq);
        $additional_data = mysqli_fetch_all($quering, MYSQLI_ASSOC);

?>


            <div class="flex flex-wrap justify-between items-center px-4 pb-6 pt-4 bg-gray-50 border border-rose-200 font-semibold text-[1.2rem]">
                <div class="flex flex-wrap">
                    <?php 
                        $total_package = 0;
                        foreach($pack_data as $pack_datas){
                            $pack = $pack_datas['package_type'];
                            if($request == ''){
                                $formatted_date = $_SESSION['formatted_date'];
                                if ($formatted_date===''){
                                    // $query = "SELECT * FROM user ORDER BY id DESC";
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND status = '1' ORDER BY id DESC";
                                }else{
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND '$formatted_date' BETWEEN user.start_date AND user.end_date AND status = '1' ORDER BY id DESC";
                                }
                                $sqll = "SELECT * FROM additional_subscription WHERE package_type = '$pack' AND  date = '$formatted_date'";
                            }else{
                                if ($formatted_date===''){
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND delivery_boy = '$request' AND status = '1' ORDER BY id DESC";
                                }else{
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND delivery_boy = '$request' AND '$formatted_date' BETWEEN user.start_date AND user.end_date AND status = '1' ORDER BY id DESC";
                                }
                                $sqll = "SELECT * FROM additional_subscription WHERE package_type = '$pack' AND delivery_boy = '$request' AND  date = '$formatted_date'";
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
            <div class="overflow-x-auto relative">

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <?php if($count){ ?>
                            <tr>
                                <th scope="col" class="py-3 px-8">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Address
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Veg/non-veg
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Food timing
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Start date - End date
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Delivery boy
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Package type
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Remarks
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Active/Inactive
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        <?php 
                            }else{
                                // echo "Sorry no records found!";
                            } 
                        ?>
                    </thead>
                    <tbody>
                        <?php while($records=mysqli_fetch_assoc($result)){ ?>
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
                                    <!-- toggle -->
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input id="toggle-check" type="checkbox" value="" class="sr-only peer input-switch" <?php $records['status'] == '1' ? print 'checked' : '' ?> onclick="toggleStatus(<?php echo $records['id'] ?>); return check();" >
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all bg-red-500 peer-checked:bg-green-600"></div>
                                        <!-- <span class="info-text ml-3 text-[10px] font-medium text-gray-900 dark:text-gray-300"></span> -->
                                    </label>

                                </td>
                                <td class="py-4 px-6">
                                    <!-- Modal toggle -->
                                    <a href="#" type="button" data-modal-toggle="editUserModal" class="font-medium text-blue-600 hover:underline">Edit user</a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php foreach($additional_data as $additional_datas){ ?>
                            <?php 
                                $user_id = $additional_datas['user_id'];
                                if($request == ''){
                                    $sql = "SELECT * FROM user WHERE id = '$user_id'";
                                }else{
                                    $sql = "SELECT * FROM user WHERE id = '$user_id' AND delivery_boy = '$request'";
                                }
                                $res = mysqli_query($conn, $sql);
                                $loop = mysqli_fetch_all($res, MYSQLI_ASSOC);
                            ?>
                            <?php foreach($loop as $row): ?>
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
                                        <div class="font-normal text-gray-500"><?php echo $row['package_type']; ?></div>
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
                        <?php } ?>
                    </tbody>
                </table>
            </div>
<?php } ?>

<?php
    if(isset($_POST['checkbox_request'])){
        
        $checkbox_request = $_POST['checkbox_request'];
        $formatted_date = $_SESSION['formatted_date']; 

        if ($checkbox_request == 'all') {
            if ($formatted_date===''){
                $sql = "SELECT * FROM user ORDER BY id DESC";
            }else{
                $sql = "SELECT * FROM user WHERE '$formatted_date' BETWEEN user.start_date AND user.end_date ORDER BY id DESC";
            }
            $res = mysqli_query($conn, $sql);
            $record = mysqli_fetch_all($res, MYSQLI_ASSOC);
            $rows = mysqli_num_rows($res);

            //additionalsubscription 
            $sq = "SELECT * FROM additional_subscription WHERE date = '$formatted_date' ORDER BY id DESC";
            $quering = mysqli_query($conn, $sq);
            $additional_data = mysqli_fetch_all($quering, MYSQLI_ASSOC);
        }
        if ($checkbox_request=="breakfast") {
            $arguments[] = "food_timing LIKE '%breakfast%'";
        }
    
        if ($checkbox_request=="lunch") {
            $arguments[] = "food_timing LIKE '%lunch%'";
        }
    
        if ($checkbox_request=="dinner") {
            $arguments[] = "food_timing LIKE '%dinner%'";
        }
    
        if(!empty($arguments)) {
            $str = implode(' or ',$arguments);
            if ($formatted_date===''){
                $sql = "SELECT * FROM user WHERE  " . $str . " ORDER BY id DESC";
            }else{
                $sql = "SELECT * FROM user WHERE  " . $str . "AND '$formatted_date' BETWEEN user.start_date AND user.end_date ORDER BY id DESC";

            }
            $query = mysqli_query($conn, $sql);
            $res = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $rows = mysqli_num_rows($query);

            //additionalsubscription 
            $sq = "SELECT * FROM additional_subscription WHERE date = '$formatted_date' ORDER BY id DESC";
            $quering = mysqli_query($conn, $sq);
            $additional_data = mysqli_fetch_all($quering, MYSQLI_ASSOC);
            // $total_rows = mysqli_num_rows($res);
        } else {
        //Whatever happens when there's none checked.
        }

?>
            <div class="flex flex-wrap justify-between items-center px-4 pb-6 pt-4 bg-gray-50 border border-rose-200 font-semibold text-[1.2rem]">
                <div class="flex flex-wrap">
                    <?php 
                        $total_package = 0;
                        foreach($pack_data as $pack_datas){
                            $pack = $pack_datas['package_type'];
                            if($checkbox_request == 'all'){
                                $formatted_date = $_SESSION['formatted_date'];
                                if ($formatted_date===''){
                                    // $query = "SELECT * FROM user ORDER BY id DESC";
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND status = '1' ORDER BY id DESC";
                                }else{
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND '$formatted_date' BETWEEN user.start_date AND user.end_date AND status = '1' ORDER BY id DESC";
                                }
                                $sqll = "SELECT * FROM additional_subscription WHERE package_type = '$pack' AND  date = '$formatted_date'";
                            }else{
                                if ($formatted_date===''){
                                    $query_pack = "SELECT * FROM user WHERE package_type = '$pack' AND " . $str . " AND status =' 1' ORDER BY id DESC";
                                }else{
                                    $query_pack = "SELECT * FROM user WHERE  package_type = '$pack' AND " . $str . "AND '$formatted_date' BETWEEN user.start_date AND user.end_date AND status = '1' ORDER BY id DESC";
                                }
                                $sqll = "SELECT * FROM additional_subscription WHERE package_type = '$pack' AND ". $str . " AND  date = '$formatted_date'";
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
            <div class="overflow-x-auto relative">

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <?php if($rows){ ?>
                            <tr>
                                <th scope="col" class="py-3 px-8">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Address
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Veg/non-veg
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Food timing
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Start date - End date
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Delivery boy
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Package type
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Remarks
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Active/Inactive
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        <?php 
                            }else{
                                // echo "Sorry no records found!";
                            } 
                        ?>
                    </thead>
                    <tbody>
                        <?php foreach($res as $records){ ?>
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
                                    <!-- toggle -->
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input id="toggle-check" type="checkbox" value="" class="sr-only peer input-switch" <?php $records['status'] == '1' ? print 'checked' : '' ?> onclick="toggleStatus(<?php echo $records['id'] ?>); return check();" >
                                        <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all bg-red-500 peer-checked:bg-green-600"></div>
                                        <!-- <span class="info-text ml-3 text-[10px] font-medium text-gray-900 dark:text-gray-300"></span> -->
                                    </label>

                                </td>
                                <td class="py-4 px-6">
                                    <!-- Modal toggle -->
                                    <a href="#" type="button" data-modal-toggle="editUserModal" class="font-medium text-blue-600 hover:underline">Edit user</a>
                                </td>
                            </tr>
                        <?php } ?>
    
                        <?php foreach($additional_data as $additional_datas){ ?>
                            <?php 
                                $user_id = $additional_datas['user_id'];
                                if ($checkbox_request == 'all') {
                                    $sql = "SELECT * FROM user WHERE id = '$user_id'";
                                }else{
                                    $sql = "SELECT * FROM user WHERE id = '$user_id' AND  $str";
                                }
                                $res = mysqli_query($conn, $sql);
                                $loop = mysqli_fetch_all($res, MYSQLI_ASSOC);
                            ?>
                            <?php foreach($loop as $row): ?>
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
                                        <div class="font-normal text-gray-500"><?php echo $row['package_type']; ?></div>
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
                        <?php } ?>
                    </tbody>
                </table>
            </div>
<?php } ?>


<?php
    
    if(isset($_POST['tId'])){
        $tId = $_POST['tId'];
        $sql = "SELECT * FROM user WHERE id = '$tId'";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        $status = $data['status'];

        if($status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        $update = "UPDATE user SET status = '$status' WHERE id = '$tId'";
        $res = mysqli_query($conn, $update);
        if($res){
            echo $status;
        }
    }

?>

<script type="text/javascript">
        function toggleStatus(id){
            var id = id;
            $.ajax({
                url:"fetch.php",
                type:"POST",
                data:{tId:id},
                success:function(result){
                    if(result=='1'){

                    }else{

                    }
                }
            });
        }
</script>
<script>
    function check() {
        
        if(document.getElementById("toggle-check").checked == true)
        {
            // window.location.href="./manage_user.php";
            setTimeout(function(){ 
                window.location.reload();
            }, 600);
            // window.location.reload();
        }else{
            setTimeout(function(){ 
                window.location.reload();
            }, 600);

        }
        // location.reload();
        // $("#package_count").load("package_count.php");
    }
</script>