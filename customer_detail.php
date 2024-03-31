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
            <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">รายละเอียดลูกค้า</p>

            <div class="container mt-5">

                <?php
                // จัดการ request ดึงข้อมูลจาก customer_id
                require 'classes/customer.php';
                $customer = new Customer();
                $customer_id = $_GET['customer_id'];
                $c_detail = $customer->customer_detail($customer_id);
                // print_r($customer->customer_detail($customer_id));



                ?>

                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">ชื่อลูกค้า</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $c_detail['customer_name'] ?></dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">สถานะ</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <?php if ($c_detail['status_id'] == 1) : ?>
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-600/20"><?php echo $c_detail['status_name'] ?></span>
                                    <?php elseif ($c_detail['status_id'] == 2) : ?>
                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20"><?php echo $c_detail['status_name'] ?></span>
                                    <?php elseif ($c_detail['status_id'] == 3) : ?>
                                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20"><?php echo $c_detail['status_name'] ?></span>
                                    <?php elseif ($c_detail['status_id'] == 4) : ?>
                                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20"><?php echo $c_detail['status_name'] ?></span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center rounded-md bg-violet-50 px-2 py-1 text-xs font-medium text-violet-700 ring-1 ring-inset ring-violet-600/20"><?php echo $c_detail['status_name'] ?></span>
                                    <?php endif; ?>
                                </dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">เบอร์โทรศัพท์</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">0841085079</dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">วันที่รับ</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><time datetime="<?php echo $c_detail['start_at'] ?>"><?php echo date('d-m-Y', strtotime($c_detail['start_at'])) ?></time></dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">Requirement</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $c_detail['customer_requirement'] ?></dd>
                            </div>
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-900">วันที่ส่งมอบ</dt>
                                <?php if ($c_detail['end_at'] != NULL) : ?>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><time datetime="<?php echo $c_detail['end_at'] ?>"><?php echo date('d-m-Y', strtotime($c_detail['end_at'])) ?></time></dd>
                                <?php else : ?>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">ยังไม่สำเร็จ</dd>
                                <?php endif; ?>
                            </div>
                        </dl>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>