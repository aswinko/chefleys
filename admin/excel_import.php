<?php 
    session_start();

    include('../config/db_connect.php');

    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    if(isset($_POST['excel_submit'])){
        $filename = $_FILES['excel_file']['name'];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

        $allowed_ext = ['xls', 'csv', 'xlsx'];

        if(in_array($file_ext, $allowed_ext)){
            $inputFileNamePath = $_FILES['excel_file']['tmp_name'];

            /** Load $inputFileName to a Spreadsheet object **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $count = '0';
            foreach($data as $row){

                if($count > 0){

                    $name = $row['1'];
                    $phone_no = $row['2'];
                    $email = $row['3'];
                    $address1 = $row['4'];
                    $address2 = $row['5'];
                    $veg_or_nonveg = $row['6'];
                    $food_timing = $row['7'];
                    $start_date = $row['8'];
                    $end_date = $row['9'];
                    $delivery_boy = $row['10'];
                    $package_type = $row['11'];
                    $package_no = $row['12'];
                    $remarks = $row['13'];  
    
                        $sql = "SELECT * FROM user WHERE name = '$name' AND phone_no = '$phone_no'";
                        $res = mysqli_query($conn, $sql);
                        $check_records = mysqli_num_rows($res);
    
                        if($check_records > 0){
                            echo "";
                        }else{
                            $insert_query = "INSERT INTO user (name, phone_no, email, address1, address2, veg_or_nonveg, 
                                food_timing, start_date, end_date, delivery_boy, package_type, package_no, remarks) 
                                VALUES ('$name', '$phone_no', '$email', '$address1', '$address2', '$veg_or_nonveg', 
                                '$food_timing', '$start_date', '$end_date', '$delivery_boy', '$package_type', '$package_no', '$remarks')";
                                
                            $result = mysqli_query($conn, $insert_query);
    
                            $msg=true;
                        }
                    // if($result){
    
                    // }else{
                    //     echo mysqli_error($conn);
                    // }
                }else{
                    $count = '1';
                }
            }
            if(isset($msg)){
                $_SESSION['success_message'] = "Data imported successfully.";
                // echo "successfull.";
                header("Location: ./add_user.php");
                exit(0);
            }else{
                $_SESSION['error_message'] = "Failed to import file records!";
                // echo "failed to import";
                header("Location: ./add_user.php");
                exit(0);
            }
            
        }else{
            $_SESSION['error_message'] = "Invalid file type!";
            // echo "invalid";
            header("Location: ./add_user.php");
            exit(0);
        }
    }

?>