<?php 
    session_start();
    usleep(300000);
    if(!isset($_SESSION['admin'])){
        header("Location: ./login.php"); 
    }

    include('../config/db_connect.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);
    }
?>

<!-- Modal body -->
<div class="p-6 space-y-6">
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-3">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
            <input type="text" value="<?php echo $data['name']; ?>" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Bonnie" required="">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input type="email" value="<?php echo $data['email']; ?>" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Green" required="">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
            <input type="number" value="<?php echo $data['phone_no']; ?>" name="phone-number" id="phone-number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="e.g. +(12)3456 789" required="">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label for="address1" class="block mb-2 text-sm font-medium text-gray-900">Address1</label>
            <input type="text" value="<?php echo $data['address1']; ?>" name="address1" id="address1" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Development" required="">
        </div>
        <div class="col-span-6 sm:col-span-3">
            <label for="address2" class="block mb-2 text-sm font-medium text-gray-900">Address2</label>
            <input type="text" value="<?php echo $data['address2']; ?>" name="address2" id="address2" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="123456" required="">
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="money" class="block mb-2 text-sm font-medium text-gray-900">No of Package</label>
            <input
            type="number"
            name="no_of_package"
            placeholder="No of packages"
            value="<?php echo $data['package_no']; ?>"
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
            value="<?php echo $data['start_date']; ?>"
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
            value="<?php echo $data['end_date']; ?>"
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
        <textarea name="remarks" id="" cols="30" placeholder="Enter Remarks" rows="2" class="pshadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"><?php echo $data['veg_or_nonveg']; ?></textarea>
    </div>

    </div>
</div>