<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chefleys</title>
    <script src="https://cdn.tailwindcss.com"></script>

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
        <div class="min-h-screen bg-gray-100 p-0 sm:p-12">
            <div class="mx-auto max-w-md px-6 py-12 bg-white border-0 shadow-lg sm:rounded-3xl">
                <h1 class="text-2xl font-bold mb-8">Registration</h1>
                <form id="form" novalidate>
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
                        type="password"
                        name="password"
                        placeholder=" "
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        />
                        <label for="password" class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500">Enter password</label>
                        <span class="text-sm text-red-600 hidden" id="error">Password is required</span>
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
                            name="radio"
                            value="veg"
                            class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                            />
                            Veg
                        </label>
                        <label>
                            <input
                            type="radio"
                            name="radio"
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
                                name="meals"
                                value="breakfast"
                                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                                />
                                Breakfast
                            </label>
                            <label>
                                <input
                                type="checkbox"
                                name="meals"
                                value="lunch"
                                class="mr-2 text-black border-2 border-gray-300 focus:border-gray-300 focus:ring-black"
                                />
                                Lunch
                            </label>
                            <label>
                                <input
                                type="checkbox"
                                name="meals"
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
                        name="select"
                        value=""
                        onclick="this.setAttribute('value', this.value);"
                        class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
                        >
                        <option value="" selected disabled hidden></option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                        <option value="5">Option 5</option>
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
                        <span class="text-sm text-red-600 hidden" id="error">Amount is required</span>
                    </div>

                    <div class="relative z-0 w-full mb-5">
                        <textarea name="remarks" id="" cols="30" placeholder="Enter Remarks" rows="2" class="pt-3 pb-2 pl-3 rounded-lg block w-full px-0 mt-0 bg-transparent border-2 appearance-none focus:outline-none focus:ring-0 border-gray-200"></textarea>
                    </div>

                    <button
                        id="button"
                        type="button"
                        class="w-full px-6 py-3 mt-3 text-lg text-white transition-all duration-150 ease-linear rounded-lg shadow outline-none bg-pink-500 hover:bg-pink-600 hover:shadow-lg focus:outline-none"
                    >
                        Register
                    </button>
                </form>
            </div>
        </div>

    </section>
    <script>
    'use strict'

    document.getElementById('button').addEventListener('click', toggleError)
    const errMessages = document.querySelectorAll('#error')

    function toggleError() {
        // Show error message
        errMessages.forEach((el) => {
        el.classList.toggle('hidden')
        })

        // Highlight input and label with red
        const allBorders = document.querySelectorAll('.border-gray-200')
        const allTexts = document.querySelectorAll('.text-gray-500')
        allBorders.forEach((el) => {
        el.classList.toggle('border-red-600')
        })
        allTexts.forEach((el) => {
        el.classList.toggle('text-red-600')
        })
    }
    </script>
</body>
</html>