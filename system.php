<?php
include("components/header.php");
?>

<body>
    <?php require_once('logic/auth.php'); ?>
    <?php
    include("components/nav.php");
    include("components/sidebar.php");
    ?>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">Systems management</p>

            <div class="container mt-5">
                <?php
                // จัดการ request ของ system
                require "classes/system.php";
                if (isset($_POST["name"])) {
                    $name = $_POST["name"];
                    $system = new System();
                    if ($system->add_system($name) == true) {
                        echo '<script>
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "บันทึกข้อมูลสำเร็จ",
                            showConfirmButton: false,
                            timer: 1000
                          }).then(() => {
                            window.location.reload;
                        });
                        </script>
                        ';
                    } else {
                        echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "ชื่อระบบมีอยู่แล้ว",
                        showConfirmButton: false,
                        timer: 1000
                      });
                    </script>';
                    }
                }

                if (isset($_GET['deletesystem_id'])) {
                    $system = new System();
                    if ($system->delete_system($_GET['deletesystem_id'])) {
                        echo '<script>
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "ลบข้อมูลสำเร็จ",
                            showConfirmButton: false,
                            timer: 1000
                          }).then(() => {
                            window.location.href = system.php;
                        });
                        </script>
                        ';
                    }
                }

                if (isset($_POST['updatesystem_name'])) {
                    $system_name = $_POST['updatesystem_name'];
                    $system_id = $_POST['updatesystem_id'];
                    $system = new System();

                    if ($system->update_system($system_name, $system_id) == true) {
                        echo '<script>
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "แก้ไขข้อมูลสำเร็จ",
                            showConfirmButton: false,
                            timer: 1000
                          }).then(() => {
                            window.location.reload;
                        });
                        </script>
                        ';
                    } else {
                        echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "ชื่อระบบซ้ำ",
                        showConfirmButton: false,
                        timer: 1000
                      });
                    </script>';
                    }
                }

                // จัดการ request ของ status
                require "classes/status.php";
                $status = new Status();
                $all_status = $status->show();
                // print_r($status->show());

                if (isset($_GET["c_status_name"])) {
                    $data = $_GET["c_status_name"];
                    if ($status->create_status($data) == true) {
                        echo '<script>
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "เพิ่มสถานะสำเร็จ",
                            showConfirmButton: false,
                            timer: 1000
                          });
                        </script>
                        ';
                    } else {
                        echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "ชื่อสถานะซ้ำ",
                        showConfirmButton: false,
                        timer: 1000
                      });
                    </script>';
                    }
                }

                if (isset($_GET['d_status_id'])) {
                    $data = $_GET['d_status_id'];
                    $status->delete_status($data);
                }

                // จัดการ request ของ customer
                require 'classes/customer.php';
                $customer = new Customer();
                $customers = $customer->row_customers();

                ?>
                <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="inline-flex items-center gap-x-2 rounded-md bg-emerald-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Add system
                </button>
                <button type="button" data-modal-target="c_status" data-modal-toggle="c_status" data-popover-target="popover-right" data-popover-placement="right" class="inline-flex items-center gap-x-2 rounded-md bg-emerald-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Add status
                </button>
                <div data-popover id="popover-right" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Status</h3>
                    </div>
                    <div class="px-3 py-2">
                        <?php foreach ($all_status as $status) : ?>
                            <div class="grid grid-cols-2">
                                <?php if ($status['status_id'] != 1 && $status['status_id'] != 2 && $status['status_id'] != 3 && $status['status_id'] != 4) : ?>
                                    <li><?php echo $status['status_name'] ?></li>
                                    <form action="" method="GET">
                                        <input type="text" class="hidden" name="d_status_id" value="<?php echo $status['status_id'] ?>" hidden>
                                        <button type="submit" class="text-xs font-semibold text-white shadow-sm hover:text-red-500">Delete</button>
                                    </form>
                                <?php else : ?>
                                    <li><?php echo $status['status_name'] ?></li>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <hr class="my-3">
                <ul role="list" class="divide-y divide-gray-100">
                    <?php
                    $system_show = new System();
                    foreach ($system_show->show() as $system) {
                    ?>
                        <li class="flex items-center justify-between gap-x-6 py-5">
                            <div class="min-w-0">
                                <div class="flex items-start gap-x-3">
                                    <a href="system_customer.php?system_id=<?php echo $system['system_id'] ?>" class="text-sm font-semibold leading-6 text-gray-900"><?php echo $system['system_name'] ?></a>
                                    <!-- <p class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">Complete</p> -->
                                </div>
                                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                    <p class="whitespace-nowrap">Customers : </p>
                                        <p class="truncate"><?php echo $customers[$system['system_id']] ?> peoples</p>
                                </div>
                            </div>
                            <div class="flex flex-none items-center gap-x-4">
                                <a href="system_customer.php?system_id=<?php echo $system['system_id'] ?>" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">View system</a>
                                <button data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="hidden rounded-md bg-amber-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-amber-600 sm:block">Edit system</button>
                                <form action="" method="GET" id="deleteForm">
                                    <input type="text" hidden value="<?php echo $system['system_id'] ?>" name="deletesystem_id">
                                    <button type="submit" onclick="confirmDelete(event)" class="hidden rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500 sm:block">Delete system</button>
                                </form>
                            </div>
                        </li>

                        <!-- edit modal -->
                        <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit System
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="" method="POST" class="p-4 md:p-5">
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="updatesystem_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" name="updatesystem_name" id="updatesystem_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="New system name" required>
                                                <input type="text" value="<?php echo $system['system_id'] ?>" name="updatesystem_id" id="updatesystem_id" hidden>
                                            </div>
                                        </div>
                                        <button type="submit" class="text-white inline-flex items-center bg-amber-500 hover:bg-ember-700 focus:ring-4 focus:outline-none focus:ring-ember-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-ember-500 dark:hover:bg-ember-600 dark:focus:ring-ember-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                            </svg>
                                            Update System
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </ul>

            </div>
        </div>
    </div>


    <!-- create modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New System
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="system.php" method="POST" class="p-4 md:p-5" id="createsystem">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="System name" required="">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-500 dark:hover:bg-emerald-600 dark:focus:ring-emerald-300">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- create status modal -->
    <div id="c_status" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New Status
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="c_status">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="" method="GET" class="p-4 md:p-5" id="c_status_name">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="c_status_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="c_status_name" id="c_status_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Status name" required>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-500 dark:hover:bg-emerald-600 dark:focus:ring-emerald-300">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new status
                    </button>
                </form>
            </div>
        </div>
    </div>



    <script>
        function confirmDelete(event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteForm").submit();
                }
            });
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>