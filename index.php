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
            <?php
            require 'classes/dashboard.php';
            require 'classes/status.php';
            require 'classes/system.php';

            $dashboard = new Dashboard();
            $status = new Status();
            $system = new System();

            $customers = $dashboard->get_customer();
            $systems = $dashboard->get_system();
            $show_system = $system->show();
            $show_status = $status->show();
            // print_r($show_system);

            if (isset($_GET['system'])) {
                $system_id = $_GET['system'];
                $status_id = $_GET['status'];
                $c_name = $_GET['c_name'];
            }

            ?>

            <!-- card list -->
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">
                    <ul role="list" class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-2 xl:gap-x-8">
                        <li class="overflow-hidden rounded-xl border border-gray-200">
                            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                                <svg class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                                    <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                                </svg>
                                <div class="text-sm font-medium leading-6 text-gray-900">Systems</div>
                                <div class="relative ml-auto">
                                    <a href="system.php">
                                        <button type="button" class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500" id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                                            <svg class="w-6 h-6 text-gray-600 dark:text-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                                            </svg>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                                <div class="flex justify-between gap-x-4 py-3">
                                    <dt class="text-gray-500">Last create</dt>
                                    <dd class="text-gray-700"><?php echo $systems['system']['system_name'] ?? 'ยังไม่มีข้อมูล' ?></dd>
                                </div>
                                <div class="flex justify-between gap-x-4 py-3">
                                    <dt class="text-gray-500">Amount</dt>
                                    <dd class="flex items-start gap-x-2">
                                        <div class="font-medium text-gray-900"><?php echo $systems['system_count']['count'] ?></div>
                                    </dd>
                                </div>
                            </dl>
                        </li>
                        <li class="overflow-hidden rounded-xl border border-gray-200">
                            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                                <svg class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd" />
                                </svg>
                                <div class="text-sm font-medium leading-6 text-gray-900">Customers</div>
                            </div>
                            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                                <div class="flex justify-between gap-x-4 py-3">
                                    <dt class="text-gray-500">Last create</dt>
                                    <dd class="text-gray-600">ชื่อ: <?php echo $customers['customer']['customer_name'] ?? 'ยังไม่มีข้อมูล' ?></dd>
                                    <dd class="text-gray-600">ระบบ: <?php echo $customers['customer']['system_name'] ?? 'ยังไม่มีข้อมูล' ?></dd>
                                    <?php if (isset($customers['customer']['start_at'])) : ?>
                                        <dd class="text-gray-700"><time datetime="<?php echo $customers['customer']['start_at'] ?>"><?php echo date('j F Y', strtotime($customers['customer']['start_at'])) ?? 'ยังไม่มีข้อมูล' ?></time>
                                        </dd>
                                    <?php else : ?>
                                        <dd class="text-gray-600">วันที่: ยังไม่มีข้อมูล</dd>
                                    <?php endif; ?>
                                </div>
                                <div class="flex justify-between gap-x-4 py-3">
                                    <dt class="text-gray-500">Amount</dt>
                                    <dd class="flex items-start gap-x-2">
                                        <div class="font-medium text-gray-900"><?php echo $customers['customer_count']['count'] ?></div>
                                    </dd>
                                </div>
                            </dl>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end card list -->

            <div class="my-5">
                <hr class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            </div>

            <div class="my-5 mx-auto max-w-7xl px-4 sm:px-6 lg-px-8">
                <div class="sm:flex-auto">
                    <span class="text-sm font-medium text-gray-900">ค้นหาข้อมูลระบบ</span>
                    <form action="" method="GET">
                        <div class="flex flex-col sm:flex-row">
                            <div class="mr-2">
                                <select class="w-full border-gray-300 mr-0 sm:mr-2 mb-2 sm:mb-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="system" id="system">
                                    <option value="" hidden>เลือกระบบ</option>
                                    <?php foreach ($show_system as $item) : ?>
                                        <option value="<?php echo $item['system_id'] ?>">
                                            <?php echo $item['system_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mr-2">
                                <select class="w-full border-gray-300 mr-0 sm:mr-2 mb-2 sm:mb-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="status" id="status">
                                    <option value="" hidden>สถานะ</option>
                                    <?php foreach ($show_status as $item) : ?>
                                        <option value="<?php echo $item['status_id'] ?>">
                                            <?php echo $item['status_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mr-2">
                                <input class="w-full border-gray-300 mr-0 sm:mr-2 mb-2 sm:mb-0 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" id="c_name" name="c_name" value="" placeholder="ค้นหาชื่อลูกค้า">
                            </div>

                            <div class="flex justify-center ">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 uppercase hover:bg-gray-100 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    ค้นหา
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- table -->
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">ภาพรวมระบบ</h1>
                    </div>
                </div>
                <div class="mt-5 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-800">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ชื่อ</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Requirement</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">สถานะ</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">เบอร์โทร</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <?php if (isset($_GET['system'])) : ?>
                                        <?php foreach ($dashboard->filter($system_id, $status_id, $c_name) as $item) : ?>
                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo $item['customer_name'] ?></td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <?php
                                                    if (strlen($item['customer_requirement']) > 20) {
                                                        echo substr($item['customer_requirement'], 0, 20) . '...';
                                                    } else {
                                                        echo $item['customer_requirement'];
                                                    }
                                                    ?>
                                                </td>
                                                <td class="flex items-center justify-end gap-x-2 sm:justify-start whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    <?php if ($item['status_id'] == 1) { ?>
                                                        <div class="flex-none rounded-full p-1 text-gray-400 bg-gray-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                    <?php } elseif ($item['status_id'] == 2) { ?>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                    <?php } elseif ($item['status_id'] == 3) { ?>
                                                        <div class="flex-none rounded-full p-1 text-yellow-400 bg-yellow-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                    <?php } elseif ($item['status_id'] == 4) { ?>
                                                        <div class="flex-none rounded-full p-1 text-red-400 bg-red-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="flex-none rounded-full p-1 text-violet-400 bg-violet-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="hidden text-gray-500 sm:block"><?php echo $item['status_name'] ?></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $item['customer_tel'] ?></td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">รายละเอียด</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end table -->
        </div>



    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>