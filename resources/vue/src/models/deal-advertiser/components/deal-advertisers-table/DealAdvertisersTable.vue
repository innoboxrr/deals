<template>
    <section>
        <div class="px-4 mx-auto">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 sm:rounded-lg border">
                <div class="px-4 divide-y dark:divide-gray-700">
                    <div class="flex flex-col py-3 space-y-3 md:flex-row md:items-center md:justify-between md:space-y-0 md:space-x-4">
                        <div class="flex items-center flex-1 space-x-4">
                            <h5>
                                <span class="text-gray-500">
                                    Total de anunciantes:
                                </span>
                                <span class="dark:text-white">
                                    99
                                </span>
                            </h5>
                            <h5>
                                <span class="text-gray-500">
                                    Active agreements:
                                </span>
                                <span class="dark:text-white">
                                    8
                                </span>
                            </h5>
                        </div>
                        <div class="flex flex-col items-start flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                            <button 
                                type="button" 
                                class="inline-flex items-center justify-center flex-shrink-0 px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-filter"></i>
                                Table settings
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div 
                                        class="flex items-center">
                                        <input 
                                            id="checkbox-all" 
                                            type="checkbox" 
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3">User</th>
                                <th scope="col" class="px-4 py-3">email</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Spend</th>
                                <th scope="col" class="px-4 py-3">Rating</th>
                                <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Login</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template 
                                v-for="x in 5" 
                                :key="x">
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            <input 
                                                id="checkbox-table-search-1" 
                                                type="checkbox" 
                                                onclick="event.stopPropagation()" 
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-1" class="sr-only">
                                                checkbox
                                            </label>
                                        </div>
                                    </td>
                                    <th scope="row" 
                                        class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center">
                                            <img 
                                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-10.png" 
                                                alt="iMac Front Image" 
                                                class="w-auto h-8 mr-3 rounded-full">
                                            Jese Leos
                                        </div>
                                    </th>
                                    <td class="px-4 py-2">
                                        <div class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            jose@correo.com
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 mr-2 bg-red-500 border rounded-full"></div>
                                            Inactive
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2 text-gray-400" aria-hidden="true">
                                                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                                            </svg>
                                            1.6M
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center">
                                            <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i>
                                            4.7%
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        20 Nov 2022
                                    </td>
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button 
                                            :id="`dropdown-button-${x}`" 
                                            type="button" :data-dropdown-toggle="`dropdown-0-${x}`" class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                                            <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-ellipsis"></i>
                                        </button>
                                        <div :id="`dropdown-0-${x}`" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="`dropdown-button-${x}`">
                                                <li>
                                                    <a 
                                                        href="#" 
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        Show
                                                    </a>
                                                </li>
                                                <li>
                                                    <a 
                                                        href="#" 
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        Edit
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a 
                                                    href="#" 
                                                    class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template> 
                        </tbody>
                    </table>
                </div>
                <nav 
                    class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" 
                    aria-label="Table navigation">
                    <div class="flex items-center space-x-3">
                        <label 
                            for="rows" 
                            class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            Rows per page
                        </label>
                        <select 
                            id="rows" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1.5 pl-3.5 pr-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected="" value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="all">All</option>
                        </select>
                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                            of
                            <span class="font-semibold text-gray-900 dark:text-white">100</span>
                        </div>
                    </div>
                    <ul class="inline-flex items-stretch -space-x-px rounded-md shadow-sm">
                        <li>
                            <a 
                                href="#" 
                                class="flex text-sm w-20 items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Previous
                            </a>
                        </li>
                        <li>
                            <a 
                                href="#" 
                                class="flex text-sm w-20 items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</template>