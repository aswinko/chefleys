<?php 
    // include('./db_connect.php');


    function admin_login($username, $password){
        global $conn;

        $sql = "SELECT username, password FROM admin WHERE 
            username = '$username' && password = '$password'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);
        // echo $email;
        if($count > 0){

            $_SESSION['admin'] = $username;
            
            header('Location: ./manage_user.php');
            // echo "Successfully logged in";
        }else {
            echo '<script>alert("Invalid username or password")</script>';
            // $_SESSION['status'] = "Invalid Username or Password!";
            // $_SESSION['status_code'] = "error";
            // header('location: login.php');
        }


    }

    function addUser( $name,
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
    $remarks){

        global $conn;

        $sql = "INSERT INTO user (name, phone_no, email, address1, address2, veg_or_nonveg, food_timing, start_date, end_date, delivery_boy, package_type, package_no, remarks) VALUES
            ('$name', '$phone_no', '$email', '$address1', '$address2', '$veg_or_nonveg', '$food_timing', '$start_date', '$end_date', '$delivery_boy', '$package_type', '$no_of_package', '$remarks')";
        
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Customer added successfully.')</script>";
        }
    }

    function addPackage($package_type){
        global $conn;

        $sql = "INSERT INTO packages (package_type) VALUES ('$package_type')";
        
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Package added successfully.')</script>";
        }
    }

    function addDeliveryPartner($d_name){
        global $conn;

        $sql = "INSERT INTO delivery_partner (d_name) VALUES ('$d_name')";
        
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "<script>alert('Delivery partner added successfully.')</script>";
        }
    }

    function show_packages(){
        global $conn;

        $sql = 'SELECT * FROM packages';
        $query = mysqli_query($conn, $sql);

        return $query;
    }

    function show_delivery_partner(){
        global $conn;

        $sql = 'SELECT * FROM delivery_partner';
        $query = mysqli_query($conn, $sql);

        return $query;
    }

    function getAllDeliveryBoy(){
        global $conn;
        $formatted_date = $_SESSION['formatted_date'];
        if ($formatted_date===''){
            $query = "SELECT * FROM user ORDER BY id DESC";
        }else{
            $query = "SELECT * FROM user WHERE '$formatted_date' BETWEEN user.start_date AND user.end_date ORDER BY id DESC";
        }
        $result = mysqli_query($conn, $query);

        return $result;
    }

    function getDeliveryBoysByCategory($request){
        global $conn;
        $formatted_date = $_SESSION['formatted_date']; 
        if ($formatted_date===''){
            $query = "SELECT * FROM user WHERE delivery_boy = '$request' ORDER BY id DESC";
        }else{
            $query = "SELECT * FROM user WHERE delivery_boy = '$request' AND '$formatted_date' BETWEEN user.start_date AND user.end_date ORDER BY id DESC";
        }
            $result = mysqli_query($conn, $query);

        return $result;
    }

?>