<?php
include("components/header.php");
?>

<body>
    <?php require_once('logic/auth.php'); ?>

    <?php
    include("components/nav.php");
    include("components/sidebar.php");
    ?>
    <?php
    //ดึงข้อมูลของระบบ
    require 'classes/system.php';
    $system_id = $_GET['system_id'];

    $system = new System();
    $system_data = $system->find_one($system_id);

    // จัดการ request ลูกค้า
    require 'classes/customer.php';
    $cus = new Customer();
    $customers = $cus->show($system_id);  // เรียกใช้ func show เพื่อแสดงข้อมูล

    if (isset($_GET['c_name'])) {
        $data = $_GET;
        $cus->create_customer($data);
    }

    if (isset($_GET["del_c_id"])) {
        $data = $_GET;
        $cus->delete_customer($data);
    }

    if (isset($_GET['customer_edit_status'])) {
        $data = $_GET;
        $cus->update_status($data);
    }

    // if (isset($_GET['u_c_name'])) {
    //     $data = $_GET;
    //     $cus->update_customer($data);
    // }

    // แสดง status
    require 'classes/status.php';
    $status = new Status();
    $show_status = $status->show();

    ?>


    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <div class="container mt-5">
                <?php
                //ทดสอบข้อมูล
                if (isset($_GET['u_c_name'])) {
                    $data = $_GET;
                    $cus->update_customer($data);
                }
                ?>
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="flex px-4 text-3xl font-extrabold tracking-tight leading-5 sm:px-6 lg:px-8">
                                <svg class="w-6 h-6 text-gray-800 dark:text-dark me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM6 6a1 1 0 0 1-.707-.293l-1-1a1 1 0 0 1 1.414-1.414l1 1A1 1 0 0 1 6 6Zm-2 4H3a1 1 0 0 1 0-2h1a1 1 0 1 1 0 2Zm14-4a1 1 0 0 1-.707-1.707l1-1a1 1 0 1 1 1.414 1.414l-1 1A1 1 0 0 1 18 6Zm3 4h-1a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                                </svg>
                                <?php echo $system_data['system_name'] ?>
                            </h1>
                            <p class="mt-2 px-10 text-sm text-gray-700">List all customers requirement</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button data-modal-target="create-modal" data-modal-toggle="create-modal" type="button" class="block rounded-md bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">เพิ่มลูกค้า</button>
                        </div>
                    </div>
                    <div class="mt-8 flow-root">
                        <div class="mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                                    <table class="mt-6 w-full whitespace-nowrap text-left ">
                                        <colgroup>
                                            <col class="w-full sm:w-4/12">
                                            <col class="lg:w-4/12">
                                            <col class="lg:w-2/12">
                                            <col class="lg:w-1/12">
                                            <col class="lg:w-1/12">
                                        </colgroup>
                                        <thead class="border-b border-gray/10 text-sm leading-6 text-gray">
                                            <tr>
                                                <th scope="col" class="py-2 pl-4 pr-8 font-semibold sm:pl-6 lg:pl-8">ชื่อลูกค้า</th>
                                                <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold sm:table-cell">Requirement</th>
                                                <th scope="col" class="py-2 pl-0 pr-4 text-right font-semibold sm:pr-8 sm:text-left lg:pr-20">สถานะ</th>
                                                <th scope="col" class="hidden py-2 pl-0 pr-8 font-semibold md:table-cell lg:pr-20">เบอร์โทรศัพท์</th>
                                                <th scope="col" class="hidden py-2 pl-0 pr-4 text-right font-semibold sm:table-cell sm:pr-6 lg:pr-8">วันที่รับ</th>
                                                <th scope="col" class="hidden py-2 pl-0 pr-4 sm:table-cell sm:pr-6 lg:pr-8"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray/5">
                                            <?php foreach ($customers as $customer) : ?>
                                                <tr>
                                                    <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                        <div class="flex items-center gap-x-4">
                                                            <div class="truncate text-sm font-medium leading-6 text-gray"><?php echo $customer['customer_name'] ?></div>
                                                        </div>
                                                    </td>
                                                    <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                        <div class="flex gap-x-3">
                                                            <div class="font-mono text-sm leading-6 text-gray">
                                                                <?php
                                                                if (strlen($customer['customer_requirement']) > 40) {
                                                                    echo substr($customer['customer_requirement'], 0, 40) . '...';
                                                                } else {
                                                                    echo $customer['customer_requirement'];
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                        <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                            <?php if ($customer['status_id'] == 1) { ?>
                                                                <div class="flex-none rounded-full p-1 text-gray-400 bg-gray-400/10">
                                                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                                </div>
                                                            <?php } elseif ($customer['status_id'] == 2) { ?>
                                                                <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                                </div>
                                                            <?php } elseif ($customer['status_id'] == 3) { ?>
                                                                <div class="flex-none rounded-full p-1 text-yellow-400 bg-yellow-400/10">
                                                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                                </div>
                                                            <?php } elseif ($customer['status_id'] == 4) { ?>
                                                                <div class="flex-none rounded-full p-1 text-red-400 bg-red-400/10">
                                                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="flex-none rounded-full p-1 text-violet-400 bg-violet-400/10">
                                                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="hidden text-gray-500 sm:block"><?php echo $customer['status_name'] ?></div>

                                                            <!-- ปุุ่ม แก้ไข สถานะ -->
                                                            <button type="button" data-modal-target="edit-s-modal" data-modal-toggle="edit-s-modal" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-1.5 py-1 me-2 mb-2 dark:focus:ring-yellow-900">
                                                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                                </svg>
                                                            </button>
                                                            <!-- Edit status modal edit-s-modal -->
                                                            <div id="edit-s-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                                แก้ไขสถานะ
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-s-modal">
                                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                                </svg>
                                                                                <span class="sr-only">Close modal</span>
                                                                            </button>
                                                                        </div>
                                                                        <!-- Modal body -->
                                                                        <div class="p-4 md:p-5">
                                                                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">เลือกสถานะเพื่อแก้ไข</p>
                                                                            <ul class="my-4 space-y-3">
                                                                                <?php foreach ($show_status as $status) : ?>
                                                                                    <li>
                                                                                        <?php if ($status['status_id'] == 1) { ?>
                                                                                            <a href="system_customer.php?status_id=<?php echo $status['status_id'] ?>&customer_id=<?php echo $customer['customer_id'] ?>&system_id=<?php echo $system_id ?>&customer_edit_status='1'" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-blue-50 hover:bg-blue-100 group hover:shadow dark:bg-blue-600 dark:hover:bg-blue-500 dark:text-white">
                                                                                                <span class="flex-1 ms-3 whitespace-nowrap"><?php echo $status['status_name'] ?></span>
                                                                                            </a>
                                                                                        <?php } elseif ($status['status_id'] == 2) { ?>
                                                                                            <a href="system_customer.php?status_id=<?php echo $status['status_id'] ?>&customer_id=<?php echo $customer['customer_id'] ?>&system_id=<?php echo $system_id ?>&customer_edit_status='1'" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-green-50 hover:bg-green-100 group hover:shadow dark:bg-green-600 dark:hover:bg-green-500 dark:text-white">
                                                                                                <span class="flex-1 ms-3 whitespace-nowrap"><?php echo $status['status_name'] ?></span>
                                                                                            </a>
                                                                                        <?php } elseif ($status['status_id'] == 3) { ?>
                                                                                            <a href="system_customer.php?status_id=<?php echo $status['status_id'] ?>&customer_id=<?php echo $customer['customer_id'] ?>&system_id=<?php echo $system_id ?>&customer_edit_status='1'" class="flex items-center p-3 text-base font-bold text-yellow-900 rounded-lg bg-yellow-50 hover:bg-yellow-100 group hover:shadow dark:bg-yellow-600 dark:hover:bg-yellow-500 dark:text-white">
                                                                                                <span class="flex-1 ms-3 whitespace-nowrap"><?php echo $status['status_name'] ?></span>
                                                                                            </a>
                                                                                        <?php } elseif ($status['status_id'] == 4) { ?>
                                                                                            <a href="system_customer.php?status_id=<?php echo $status['status_id'] ?>&customer_id=<?php echo $customer['customer_id'] ?>&system_id=<?php echo $system_id ?>&customer_edit_status='1'" class="flex items-center p-3 text-base font-bold text-red-900 rounded-lg bg-red-50 hover:bg-red-100 group hover:shadow dark:bg-red-600 dark:hover:bg-red-500 dark:text-white">
                                                                                                <span class="flex-1 ms-3 whitespace-nowrap"><?php echo $status['status_name'] ?></span>
                                                                                            </a>
                                                                                        <?php } else { ?>
                                                                                            <a href="system_customer.php?status_id=<?php echo $status['status_id'] ?>&customer_id=<?php echo $customer['customer_id'] ?>&system_id=<?php echo $system_id ?>&customer_edit_status='1'" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-violet-50 hover:bg-violet-100 group hover:shadow dark:bg-violet-600 dark:hover:bg-violet-500 dark:text-white">
                                                                                                <span class="flex-1 ms-3 whitespace-nowrap"><?php echo $status['status_name'] ?></span>
                                                                                            </a>
                                                                                        <?php }; ?>
                                                                                    </li>
                                                                                <?php endforeach; ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end status modal -->
                                                        </div>
                                                    </td>
                                                    <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20"><?php echo $customer['customer_tel'] ?></td>
                                                    <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                        <time datetime="<?php echo $customer['start_at'] ?>"><?php echo date('d-m-Y', strtotime($customer['start_at'])) ?></time>
                                                    </td>
                                                    <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                        <a href="customer_detail.php?customer_id=<?php echo $customer['customer_id'] ?>">
                                                            <button type="button" class="focus:outline-none text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1.5 me-2 mb-2 dark:focus:ring-blue-900">
                                                                <svg class="w-6 h- text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                            </button>
                                                        </a>
                                                        <button type="button" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                            </svg>
                                                        </button>
                                                        <form action="" method="GET">
                                                            <input type="text" name="del_c_id" value="<?php echo $customer['customer_id'] ?>" hidden>
                                                            <input type="text" name="del_c_system_id" value="<?php echo $customer['system_id'] ?>" hidden>
                                                            <button type="submit" class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1.5 me-2 mb-2 dark:focus:ring-red-900">
                                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Edit modal -->
                                                <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                    แก้ไขข้อมูลลูกค้า
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5">
                                                                <form action="" method="GET" class="my-4 space-y-3">
                                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                                        <div class="col-span-2">
                                                                            <label for="u_c_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อ</label>
                                                                            <input type="text" name="u_c_name" id="u_c_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $customer['customer_name'] ?>" required>
                                                                        </div>
                                                                        <div class="col-span-2">
                                                                            <label for="u_c_req" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Requirement</label>
                                                                            <div class="mt-2.5">
                                                                                <textarea name="u_c_req" id="u_c_req" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-white bg-gray-600 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6" required><?php echo $customer['customer_requirement'] ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-span-2">
                                                                            <label for="u_c_tel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เบอร์โทรศัพท์</label>
                                                                            <input type="text" name="u_c_tel" id="u_c_tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?php echo $customer['customer_tel'] ?>" required>
                                                                            <input type="text" value="<?php echo $customer['customer_id'] ?>" name="u_c_id" id="u_c_id" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="text-white inline-flex items-center bg-amber-500 hover:bg-ember-700 focus:ring-4 focus:outline-none focus:ring-ember-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-ember-500 dark:hover:bg-ember-600 dark:focus:ring-ember-300">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                                                        </svg>
                                                                        Update Customer
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end edit modal -->
                                            <?php endforeach; ?>




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- create modal -->
    <div id="create-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        เพิ่มลูกค้า
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="" method="GET" class="p-4 md:p-5" id="createsystem">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="c_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อลูกค้า</label>
                            <input type="text" name="c_name" id="c_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="customer name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="c_req" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Requirement</label>
                            <input type="text" name="c_req" id="c_req" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Requirement" required>
                        </div>
                        <div class="col-span-2">
                            <label for="c_tel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เบอร์โทรศัพท์</label>
                            <input type="text" name="c_tel" id="c_tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Requirement" required>
                        </div>
                    </div>
                    <input type="text" name="system_id" id="system_id" value="<?php echo $system_id ?>" hidden>
                    <button type="submit" class="text-white inline-flex items-center bg-emerald-500 hover:bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-500 dark:hover:bg-emerald-600 dark:focus:ring-emerald-300">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        เพิ่มลูกค้า
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>