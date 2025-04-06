<template>
    <div>
        <section class="flex items-center bg-gray-50 dark:bg-gray-900">
            <div class="w-full">
                <div class="relative dark:bg-gray-800 border-b">
                    <div class="px-4 divide-y dark:divide-gray-700">
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center flex-1 space-x-2">
                                <h5 class="font-semibold dark:text-white">
                                    Dashboard de anunciantes
                                </h5>
                            </div>
                            <div class="flex items-center gap-4 justify-between sm:justify-end">
                                
                                <!-- Selector de Deal -->
                                <div class="flex items-center">
                                    <label for="deal-select" class="mr-2 text-sm font-medium text-gray-700">
                                        Deal:
                                    </label>
                                    <select
                                        id="deal-select"
                                        v-model="dealId"
                                        class="block w-48 rounded-md border-gray-300 bg-white py-2 px-3 text-sm focus:outline-none">
                                        <option disabled value="">-- Selecciona un Deal --</option>
                                        <option 
                                            v-for="deal in deals" 
                                            :key="deal.id" 
                                            :value="deal.id">
                                            {{ deal.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Métricas del Deal seleccionado -->
                                <Menu as="div" class="relative inline-block text-left">
                                    <div>
                                        <MenuButton class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            <span class="hidden sm:inline">Acciones Globales</span>
                                            <span class="sm:hidden">Acciones</span>
                                            <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </MenuButton>
                                    </div>
                                    <transition
                                        enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                        <MenuItems class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                            <div class="py-1">
                                                <MenuItem v-slot="{ active }">
                                                    <a
                                                        href="#"
                                                        @click.prevent="viewReports"
                                                        :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                        Ver Reportes
                                                    </a>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="px-4 mt-4 mb-2 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-users"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Anunciantes activos
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    45
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400 sm:text-base">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 7%
                    </span>
                    vs last month
                </p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-chart-line"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Management revenue
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    $82.1k
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400 sm:text-base">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 8.8%
                    </span>
                    vs last month
                </p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <svg
                    class="mb-2 h-6 w-6 text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 17.3a5 5 0 0 0 2.6 1.7c2.2.6 4.5-.5 5-2.3.4-2-1.3-4-3.6-4.5-2.3-.6-4-2.7-3.5-4.5.5-1.9 2.7-3 5-2.3 1 .2 1.8.8 2.5 1.6m-3.9 12v2m0-18v2.2"
                    />
                </svg>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Inversión publicitaria
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    $54.3k
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-red-600 dark:text-red-500">
                        <i class="h-3 w-3 mr-2 text-red-500 fa-solid fa-arrow-down"></i> 2.5%
                    </span>
                    vs last month
                </p>
            </div>
            <div class="rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
                <i class="mb-2 h-6 w-6 text-gray-400 fa-solid fa-dollar-sign"></i>
                <h3 class="text-gray-500 dark:text-gray-400">
                    Comisión publicitaria
                </h3>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">
                    $2.3k
                </span>
                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400 sm:text-base">
                    <span class="mr-1.5 flex items-center text-sm font-medium text-green-500 dark:text-green-400">
                        <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i> 5.6%
                    </span>
                    vs last month
                </p>
            </div>
        </div>

        <div class="flex flex-col p-2">
            <div class="w-full mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex w-full px-2">
                        <DonutChart />
                    </div>
                    <div class="flex w-full px-2">
                        <LineChart />
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex w-full px-2">
                        <ColumnChart />
                    </div>
                    <div class="flex w-full px-2">
                        <BarChart />
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de anunciantes -->
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

        <div class="py-4"></div>

        <!-- Tabla de acuerdos -->
        <section class="mb-4">
            <div class="px-4 mx-auto">
                <div class="bg-white dark:bg-gray-800 relative border sm:rounded-lg">
                    <div class="border-b dark:border-gray-700 mx-4">
                        <div class="flex items-center justify-between space-x-4 pt-3">
                            <div class="flex-1 flex items-center space-x-3">
                                <h5 class="dark:text-white font-semibold">
                                    {{ __deals('Advertisers agreements') }}
                                </h5>
                            </div>
                        </div>
                        <div class="flex flex-col-reverse md:flex-row items-center justify-between md:space-x-4 py-3">
                            <div class="w-full flex flex-col space-y-3 md:space-y-0 md:flex-row md:items-center">
                                <form class="w-full md:max-w-sm flex-1 md:mr-4">
                                    <label 
                                        for="default-search" 
                                        class="text-sm font-medium text-gray-900 sr-only dark:text-white">
                                        Search
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="h-5 w-5 pt-1 text-gray-400 fa-solid fa-magnifying-glass"></i>
                                        </div>
                                        <input 
                                            type="search" 
                                            id="default-search" 
                                            class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            placeholder="Search..." 
                                            required="">
                                        <button 
                                            type="submit" 
                                            class="text-white absolute right-0 bottom-0 top-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 rounded-lg">
                                            Search
                                        </button>
                                    </div>
                                </form>
                                <div class="flex items-center space-x-4 ml-4 justify-end">
                                    <div>
                                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" type="button" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-filter"></i>
                                            Filter
                                            <i class="h-5 w-5 pt-1 ml-2 text-gray-400 fa-solid fa-caret-down"></i>
                                        </button>
                                        <div 
                                            id="filterDropdown" 
                                            class="z-10 hidden p-3 bg-white rounded-lg shadow w-56 dark:bg-gray-700">
                                            <h6 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                By status
                                            </h6>
                                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        In progress
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" checked="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        In review
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        Completed
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        Canceled
                                                    </label>
                                                </li>
                                            </ul>
                                            <h6 class="mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">By number of users</h6>
                                            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" checked="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        5-10 peoples
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        10+ peoples
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="flex items-center text-sm font-medium text-gray-900 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md px-1.5 py-1 w-full">
                                                        <input type="checkbox" value="" class="w-4 h-4 mr-2 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        More than 10 peoples
                                                    </label>
                                                </li>
                                            </ul>
                                            <a href="#" class="flex items-center text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline mt-4 ml-1.5">Apply to all projects</a>
                                        </div>
                                    </div>
                                    <div>
                                        <button 
                                            id="configurationDropdownButton" 
                                            data-dropdown-toggle="configurationDropdown" 
                                            type="button" 
                                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <i class="h-5 w-5 pt-1 mr-2 text-gray-900 fa-solid fa-cog"></i>
                                            Configurations
                                        </button>
                                        <div 
                                            id="configurationDropdown" 
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="configurationDropdownButton">
                                                <li>
                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">By Category</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">By Brand</a>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button 
                                            type="button" 
                                            class="w-full md:w-auto flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 sm:px-4 sm:py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <i class="h-5 w-5 pt-1 mr-2 text-white fa-solid fa-plus"></i>
                                            {{ __deals('New') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 pb-3 flex flex-wrap">
                        <div class="hidden md:flex items-center text-sm font-medium text-gray-900 dark:text-white mr-4 mt-3">
                            Show only:
                        </div>
                        <div class="flex flex-wrap">
                            <div class="flex items-center mt-3 mr-4">
                                <input 
                                    id="all-tasks" 
                                    type="radio" 
                                    value="" 
                                    name="show-only" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label 
                                    for="all-tasks" 
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    All
                                </label>
                            </div>
                            <div class="flex items-center mr-4 mt-3">
                                <input 
                                    id="completed" 
                                    type="radio" 
                                    value="" 
                                    name="show-only" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label 
                                    for="completed" 
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Completed tasks
                                </label>
                            </div>
                            <div class="flex items-center mr-4 mt-3">
                                <input 
                                    id="in-progress" 
                                    type="radio"
                                    value="" 
                                    name="show-only" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label 
                                    for="in-progress" 
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Tasks in progress
                                </label>
                            </div>
                            <div class="flex items-center mr-4 mt-3">
                                <input 
                                    id="in-review" 
                                    type="radio" 
                                    value="" 
                                    name="show-only" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label 
                                    for="in-review" 
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Tasks in review
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input 
                                                id="checkbox-all" 
                                                type="checkbox" 
                                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label 
                                                for="checkbox-all" 
                                                class="sr-only">
                                                checkbox
                                            </label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Agreement
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Progress
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Gasto
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Leads
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        CPL
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        CPM
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        ROI
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Due Date
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody data-accordion="table-column">
                                <template v-for="x in 10" :key="x">
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 w-4">
                                            <div class="flex items-center">
                                                <input 
                                                    id="checkbox-table-search-1" 
                                                    type="checkbox" 
                                                    onclick="event.stopPropagation()" 
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label 
                                                    for="checkbox-table-search-1" 
                                                    class="sr-only">
                                                    checkbox
                                                </label>
                                            </div>
                                        </td>
                                        <th 
                                            class="px-4 py-2 font-medium text-blue-800 whitespace-nowrap dark:text-white"
                                            @click="setVisibleRow(x)">
                                            <p class="mb-1 cursor-pointer">
                                                Upload feed and Reels in Instagram 
                                                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-caret-down  justify-end"></i>
                                            </p>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                In progress
                                            </span>
                                        </th>
                                        <td class="px-4 py-2 font-medium whitespace-nowrap cursor-pointer">
                                            <div class="flex justify-end mb-1">
                                                <span 
                                                    uk-tooltip="Importe gastado"
                                                    class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                                    75%
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 75%"></div>
                                            </div>
                                            <div class="mt-2 flex justify-between">
                                                <div 
                                                    class="flex items-center" 
                                                    uk-tooltip="6,458 leads generados">
                                                    <i class="fa-solid fa-check text-green-500 text-xs"></i>
                                                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                                                        6.7K
                                                    </span>
                                                </div>
                                                <div 
                                                    class="flex items-center ml-2" 
                                                    uk-tooltip="Leads duplicados">
                                                    <i class="fa-solid fa-user-slash text-gray-500 text-xs"></i>
                                                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                                                        32
                                                    </span>
                                                </div>
                                                <div 
                                                    class="flex items-center ml-2" 
                                                    uk-tooltip="Leads en cola de espera">
                                                    <i class="fa-solid fa-clock text-yellow-500 text-xs"></i>
                                                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                                                        456
                                                    </span>
                                                </div>
                                                <div 
                                                    class="flex items-center ml-2"
                                                    uk-tooltip="Leads rechazados por reglas de negocio">
                                                    <i class="fa-solid fa-times text-red-500 text-xs"></i>
                                                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                                                        200
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="px-2 py-1 border dark:border-gray-600 bg-white dark:bg-gray-700 rounded-lg text-xs font-medium inline-flex items-center">
                                                <button class="bg-red-500 hover:bg-red-700 text-white p-1 rounded-md mr-3">
                                                    <i class="h-3 w-3 fa-solid fa-minus"></i>
                                                </button>
                                                <span class="text-green-500">48</span>/1750$
                                                <button class="bg-green-500 hover:bg-green-700 text-white p-1 rounded-md ml-3">
                                                    <i class="h-3 w-3 fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <th 
                                            scope="row" 
                                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            1754
                                        </th>
                                        <th 
                                            scope="row" 
                                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            $84 
                                        </th>
                                        <th 
                                            scope="row" 
                                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            $84 
                                        </th>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center">
                                                <i class="h-3 w-3 mr-2 text-green-500 fa-solid fa-arrow-up"></i>
                                                4.7%
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900 dark:text-white text-xs">
                                            23 Nov 2022
                                        </td>
                                        <td class="px-4 py-2">
                                            <button 
                                                :id="`dropdown-button-${x}`" 
                                                type="button" 
                                                :data-dropdown-toggle="`dropdown-${x}`" 
                                                class="inline-flex items-center p-1 text-sm font-medium text-center text-gray-500 hover:text-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
                                                <i class="h-5 w-5 pt-1 text-gray-900 fa-solid fa-ellipsis"></i>
                                            </button>
                                            <div 
                                                :id="`dropdown-${x}`" 
                                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul 
                                                    class="py-1 text-sm text-gray-700 dark:text-gray-200" 
                                                    :aria-labelledby="`dropdown-button-${x}`">
                                                    <li>
                                                        <a 
                                                            href="#" 
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Show
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a 
                                                            href="#" 
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="py-1">
                                                    <a 
                                                        href="#" 
                                                        class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr 
                                        v-if="visibleRow == x" 
                                        class="flex-1 overflow-x-auto w-full" 
                                        id="table-column-body-0" 
                                        aria-labelledby="table-column-header-0">
                                        <td class="border-b dark:border-gray-700" colspan="10">
                                            <div class="bg-gray-50 p-6">
                                                <header class="mb-4">
                                                    <h1 class="text-3xl font-bold text-gray-900">
                                                        Dashboard de Agreement
                                                    </h1>
                                                    <p class="mt-2 text-gray-600">
                                                        Revisa el rendimiento del agreement y conoce el desempeño del anunciante, inversión, ganancia e indicadores de leads.
                                                    </p>
                                                </header>
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                                    
                                                    <div class="bg-white shadow rounded-lg p-6">
                                                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                                                            Anunciante
                                                        </h2>
                                                        <div class="flex items-center">
                                                            <img 
                                                                src="https://via.placeholder.com/150" 
                                                                alt="Anunciante" 
                                                                class="w-16 h-16 rounded-full mr-4" />
                                                            <div>
                                                                <h3 class="text-lg font-bold text-gray-800">
                                                                    Anunciante Ejemplo
                                                                </h3>
                                                                <p class="text-sm text-gray-500">
                                                                    Ejemplo Corp
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4 text-sm text-gray-600">
                                                            <p>
                                                                <i class="fa-solid fa-phone text-gray-500 mr-2"></i>
                                                                +1 234 567 890
                                                            </p>
                                                            <p>
                                                                <i class="fa-solid fa-envelope text-gray-500 mr-2"></i>
                                                                contacto@ejemplo.com
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="bg-white shadow rounded-lg p-6">
                                                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                                                            Métricas del Deal
                                                        </h2>
                                                        <div class="grid grid-cols-2 gap-4">
                                                            <div class="flex flex-col">
                                                                <span class="text-xs text-gray-500">Clicks</span>
                                                                <span class="text-2xl font-bold text-indigo-600">1,234</span>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <span class="text-xs text-gray-500">Conversiones</span>
                                                                <span class="text-2xl font-bold text-green-600">567</span>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <span class="text-xs text-gray-500">CPL</span>
                                                                <span class="text-2xl font-bold text-red-600">$84</span>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <span class="text-xs text-gray-500">ROI</span>
                                                                <span class="text-2xl font-bold text-blue-600">120%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bg-white shadow rounded-lg p-6">
                                                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Progreso de Leads</h2>
                                                        <!-- Barra de progreso -->
                                                        <div class="mb-4">
                                                            <div class="flex justify-between mb-1">
                                                                <!-- Usamos íconos de FontAwesome -->
                                                                <i class="fa-solid fa-check text-green-500 text-base" title="Convertidos"></i>
                                                                <i class="fa-solid fa-clock text-yellow-500 text-base" title="En Proceso"></i>
                                                                <i class="fa-solid fa-times text-red-500 text-base" title="Rechazados"></i>
                                                            </div>
                                                            <div class="relative h-2 bg-gray-200 rounded-full">
                                                                <div class="absolute top-0 left-0 h-2 bg-green-500 rounded-full" style="width: 75%"></div>
                                                            </div>
                                                        </div>
                                                        <!-- Distribución de leads -->
                                                        <div class="flex justify-around">
                                                            <div class="flex flex-col items-center">
                                                                <i class="fa-solid fa-check text-green-500 text-lg"></i>
                                                                <span class="text-xs text-gray-500">50</span>
                                                            </div>
                                                            <div class="flex flex-col items-center">
                                                                <i class="fa-solid fa-clock text-yellow-500 text-lg"></i>
                                                                <span class="text-xs text-gray-500">30</span>
                                                            </div>
                                                            <div class="flex flex-col items-center">
                                                                <i class="fa-solid fa-times text-red-500 text-lg"></i>
                                                                <span class="text-xs text-gray-500">20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Reporte Detallado del Agreement -->
                                                <div class="mt-8 bg-white shadow rounded-lg p-6">
                                                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                                                        Reporte Detallado del Agreement
                                                    </h2>
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                        <div class="bg-gray-50 p-4 rounded-lg">
                                                            <h3 class="text-lg font-medium text-gray-800 mb-2">
                                                                Inversión Publicitaria
                                                            </h3>
                                                            <p class="text-2xl font-bold text-gray-900">
                                                                $3,500
                                                            </p>
                                                        </div>
                                                        <div class="bg-gray-50 p-4 rounded-lg">
                                                            <h3 class="text-lg font-medium text-gray-800 mb-2">
                                                                Ganancia por Inversión
                                                            </h3>
                                                            <p class="text-2xl font-bold text-gray-900">
                                                                $5,000
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Showing
                            <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                            of
                            <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                        </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <li>
                                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                            </li>
                            <li>
                                <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { indexModel as indexDealModel, showModel as showDealModel } from '@dealsModels/deal'
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import {
        ChevronDownIcon,
    } from '@heroicons/vue/20/solid'
    import DonutChart from '@dealsComponents/charts/DonutChart.vue';
    import LineChart from '@dealsComponents/charts/LineChart.vue';
    import ColumnChart from '@dealsComponents/charts/ColumnChart.vue';
    import BarChart from '@dealsComponents/charts/BarChart.vue';

    export default {
        name: "dealDashboardSection",
        components: {
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            ChevronDownIcon,
            DonutChart,
            LineChart,
            ColumnChart,
            BarChart,
        },
        data() {
            return {
                dealId: 1,
                deals: [
                    { id: 0, name: 'All' },
                    { id: 1, name: 'Deal 1' },
                    { id: 2, name: 'Deal 2' },
                    { id: 3, name: 'Deal 3' },
                ],
            };
        },
    };
</script>
