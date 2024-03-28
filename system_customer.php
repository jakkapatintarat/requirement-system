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
    require 'classes/system.php';
    $system_id = $_GET['system_id'];

    $system = new System();
    $system_data = $system->find_one($system_id);
    ?>
    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-14">
            <!-- <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">ระบบ :</p> -->

            <div class="container mt-5">
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
                            <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add customer</button>
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
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <div class="truncate text-sm font-medium leading-6 text-gray">Michael Foster</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray">2d89f0c82</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-23T11:00">45 minutes ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-gray-500 sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">0841085079</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-23T11:00">45 minutes ago</time>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <button type="button" class="focus:outline-none text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1.5 me-2 mb-2 dark:focus:ring-blue-900">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1.5 me-2 mb-2 dark:focus:ring-red-900">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                        </svg>

                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Lindsay Walton</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">249df660</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-23T09:00">3 hours ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">1m 32s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-23T09:00">3 hours ago</time>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Courtney Henry</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">11464223</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-23T00:00">12 hours ago</time>
                                                        <div class="flex-none rounded-full p-1 text-rose-400 bg-rose-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Error</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">1m 4s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-23T00:00">12 hours ago</time>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Courtney Henry</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">dad28e95</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-21T13:00">2 days ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">2m 15s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-21T13:00">2 days ago</time>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Michael Foster</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">624bc94c</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-18T12:34">5 days ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">1m 12s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-18T12:34">5 days ago</time>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Courtney Henry</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">e111f80e</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-16T15:54">1 week ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">1m 56s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-16T15:54">1 week ago</time>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Michael Foster</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">5e136005</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-16T11:31">1 week ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">3m 45s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-16T11:31">1 week ago</time>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-4 pl-4 pr-8 sm:pl-6 lg:pl-8">
                                                    <div class="flex items-center gap-x-4">
                                                        <img src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-8 w-8 rounded-full bg-gray-800">
                                                        <div class="truncate text-sm font-medium leading-6 text-white">Whitney Francis</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-4 sm:table-cell sm:pr-8">
                                                    <div class="flex gap-x-3">
                                                        <div class="font-mono text-sm leading-6 text-gray-400">5c1fd07f</div>
                                                        <div class="rounded-md bg-gray-700/40 px-2 py-1 text-xs font-medium text-gray-400 ring-1 ring-inset ring-white/10">main</div>
                                                    </div>
                                                </td>
                                                <td class="py-4 pl-0 pr-4 text-sm leading-6 sm:pr-8 lg:pr-20">
                                                    <div class="flex items-center justify-end gap-x-2 sm:justify-start">
                                                        <time class="text-gray-400 sm:hidden" datetime="2023-01-09T08:45">2 weeks ago</time>
                                                        <div class="flex-none rounded-full p-1 text-green-400 bg-green-400/10">
                                                            <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                                        </div>
                                                        <div class="hidden text-white sm:block">Completed</div>
                                                    </div>
                                                </td>
                                                <td class="hidden py-4 pl-0 pr-8 text-sm leading-6 text-gray-400 md:table-cell lg:pr-20">37s</td>
                                                <td class="hidden py-4 pl-0 pr-4 text-right text-sm leading-6 text-gray-400 sm:table-cell sm:pr-6 lg:pr-8">
                                                    <time datetime="2023-01-09T08:45">2 weeks ago</time>
                                                </td>
                                            </tr> -->
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>