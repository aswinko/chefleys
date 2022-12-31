<?php 
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }
    include('../config/db_connect.php');

    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $curr_date = date('Y-m-d');

        $in_list_query = "SELECT * FROM user WHERE id = '$user_id'";
        $check_res = mysqli_query($conn, $in_list_query);
        $check_row = mysqli_fetch_array($check_res);
        $start_date = $check_row['start_date'];
        $end_date = $check_row['end_date'];
        $package_type = $check_row['package_type'];
        $food_timing = $check_row['food_timing'];
        $delivery_boy = $check_row['delivery_boy'];
        
        if($curr_date>=$start_date && $curr_date<=$end_date){

            echo "<script>alert('This user already in the main list!')</script>";
            echo "<script >window.open('./add_user_current_list.php', '_self')</script>";
        }else{

            $dup_query = "SELECT * FROM additional_subscription WHERE date = '$curr_date' AND user_id = '$user_id'";
            $q = mysqli_query($conn, $dup_query);
            $duplicate = mysqli_num_rows($q);
            if($duplicate > 0){
                echo "<script>alert('This user already in the sub list!')</script>";
        
                echo "<script >window.open('./add_user_current_list.php', '_self')</script>";
            }else {
                $query = "INSERT INTO additional_subscription (user_id, package_type, delivery_boy, food_timing, date) VALUES ('$user_id', '$package_type', '$delivery_boy', '$food_timing', '$curr_date')";
                $res = mysqli_query($conn, $query);
                if($res){
                    echo "<script>alert('User add successfully')</script>";
        
                    echo "<script >window.open('./add_user_current_list.php', '_self')</script>";
                }else{
                    echo mysqli_error($conn);
                }
            }
        }
        // $check_user = mysqli_num_rows($check_res);

    }
?>