
<?php
    $active_path = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") +  1);
?>

<span class="absolute sticky z-50 flex justify-end mr-4 text-end right-2 lg:hiddn text-gray-800 text-4xl top-5 cursor-pointer" onclick="Openbar()">
   <!-- <i class="fa-solid fa-bars text-[28px] p-2 bg-white text-gray-700 rounded-md shadow-lg"></i> -->
   <img src="../assets/icons/9057036_menu_right_alt_icon.svg" class="w-10 p-1 bg-white text-gray-700 rounded-md shadow-lg" alt="icon">
</span>
<div class="sidebar z-40 fixed top-0 bottom-0 lg:lef-0 left-[-300px] duration-1000 p-2 w-[250px] overflow-y-auto text-center bg-white shadow h-screen">
   <div class="text-gray-700 text-xl">
      <div class="p-2.5 mt-1 flex items-center rounded-md">
         <!-- <i class="bi bi-app-indicator px-2 py-1 rounded-md"></i> -->
         <img src="../assets/icons/bekartlogo.svg" alt="logo" class="px-2 py-1 rounded-md w-14">
         <h1 class="text-[18px] ml-3 text-xl text-purple-700 font-bold">Chefleys</h1>
         <!-- <i class="bi bi-x bg-slate-200 ml-16 text-4xl font-bold cursor-pointer lg:hidden" onclick="Openbar()"></i> -->
      </div>
      <hr class="my-2 text-gray-600">

      <div>

         <a href="./index.php">
            <div class="p-2.5 mt-2 flex items-center px-4 cursor-pointer overflow-hidden text-ellipsis whitespace-nowrap rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out <?= $active_path == "index.php" ? 'bg-blue-600 bg-blue-50' : '' ?>">
               <img class="w-6 hover:text-blue-600" src="../assets/icons/home.svg" alt="" style="filter: invert(72%) sepia(9%) saturate(361%) hue-rotate(179deg) brightness(90%) contrast(86%);">
               <span class="text-[15px] ml-4 text-gray-700">Dashboard</span>
            </div>
         </a>


         <div class="relative pt-1" id="sidenavSecEx3">
            <a class="flex items-center p-2.5 text-sm py-4 px-4 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out cursor-pointer <?= $active_path == "manage_user.php" || $active_path == "add_user.php" ? 'text-blue-600 bg-blue-50' : '' ?>" data-bs-toggle="collapse" data-bs-target="#collapseSidenavSecEx3" aria-expanded="false" aria-controls="collapseSidenavSecEx3">
               <img class="w-6" src="../assets/icons/piggy-bank.svg" alt="" style="filter: invert(72%) sepia(9%) saturate(361%) hue-rotate(179deg) brightness(90%) contrast(86%);">
               <span class="ml-4">User Management</span>
               <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 ml-auto" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                  <path fill="currentColor" d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
               </svg>
            </a>
            <div class="relative accordion-collapse collapse pt-1" id="collapseSidenavSecEx3" aria-labelledby="sidenavSecEx3" data-bs-parent="#sidenavSecExample">
               <span class="relative pt-1">
                  <a href="./add_user.php" class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out <?= $active_path == "add_user.php" ? 'text-blue-600 bg-blue-50' : '' ?>">Add user</a>
               </span>
               <span class="relative pt-1">
                  <a href="./manage_user.php" class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out <?= $active_path == "mange_user.php" ? 'text-blue-600 bg-blue-50' : '' ?>">Manage user</a>
               </span>
            </div>
         </div>

         <a href="./add_package.php">
            <div class="p-2.5 mt-2 flex items-center px-4 cursor-pointer overflow-hidden text-ellipsis whitespace-nowrap rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out <?= $active_path == "add_package.php" ? 'bg-blue-600 bg-blue-50' : '' ?>">
               <img class="w-6 hover:text-blue-600" src="../assets/icons/home.svg" alt="" style="filter: invert(72%) sepia(9%) saturate(361%) hue-rotate(179deg) brightness(90%) contrast(86%);">
               <span class="text-[15px] ml-4 text-gray-700">Add Package</span>
            </div>
         </a>

         <a href="./add_delivery_partner.php">
            <div class="p-2.5 mt-2 flex items-center px-4 cursor-pointer overflow-hidden text-ellipsis whitespace-nowrap rounded-lg hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out <?= $active_path == "add_delivery_partner.php" ? 'bg-blue-600 bg-blue-50' : '' ?>">
               <img class="w-6 hover:text-blue-600" src="../assets/icons/home.svg" alt="" style="filter: invert(72%) sepia(9%) saturate(361%) hue-rotate(179deg) brightness(90%) contrast(86%);">
               <span class="text-[15px] ml-4 text-gray-700">Add Delivery Partner</span>
            </div>
         </a>

         <a href="./logout.php" class="">
            <div class="p-2.5 mt-6 flex items-center px-4 cursor-pointer overflow-hidden text-ellipsis whitespace-nowrap rounded-lg hover:text-blue-600 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out <?= $active_path == "add_delivery_partner.php" ? 'bg-blue-600 bg-blue-50' : '' ?>">
               <img class="w-6 hover:text-blue-600" src="../assets/icons/home.svg" alt="" style="filter: invert(72%) sepia(9%) saturate(361%) hue-rotate(179deg) brightness(90%) contrast(86%);">
               <span class="text-[16px] ml-4 text-gray-700 font-semibold">Logout</span>
            </div>
         </a>

      </div>
   </div>
</div>