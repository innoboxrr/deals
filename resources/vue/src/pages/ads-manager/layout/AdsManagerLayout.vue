<template>
    <div class="min-h-screen">
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
        
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4 bg-white">

            <!-- Columna Platforms -->
            <div v-if="selectedDeal" class="border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <template v-if="selectedPlatform">
                        <router-link :to="{ name: 'DealsAdsManagerAdsPlatformView', params: { dealId: selectedDeal.id, platformId: selectedPlatform.id } }">
                            <h2 class="text-md font-bold text-gray-600 cursor-pointer">
                                {{ __deals('Platforms') }}
                            </h2>
                        </router-link>
                    </template>
                    <template v-else>
                        <h2 class="text-md font-bold text-gray-600">
                            {{ __deals('Platforms') }}
                        </h2>
                    </template>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                                <span class="sr-only">Open options</span>
                                <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <div class="py-1">
                                    <!-- Create Platform -->
                                    <MenuItem v-slot="{ active }">
                                        <router-link
                                            :to="{ 
                                                name: 'DealsAdsManagerAdsPlatformCreate',
                                                params: { 
                                                    dealId: selectedDeal.id 
                                                }
                                            }"
                                            :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                            {{ __deals('Create Platform') }}
                                        </router-link>
                                    </MenuItem>
                                    <!-- Edit Platform -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedPlatform">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsPlatformEdit', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id
                                                    } 
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Edit Platform') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Edit Platform') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                    <!-- Delete Platform -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedPlatform">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsPlatformDelete', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id 
                                                    }
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Delete Platform') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Delete Platform') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <Menu as="div" class="relative inline-block text-left w-full">
                    <div>
                        <MenuButton class="inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <span v-if="selectedPlatform">{{ selectedPlatform.name }}</span>
                            <span v-else>Selecciona una Plataforma</span>
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
                        <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="py-1">
                                <MenuItem 
                                    v-for="platform in platforms" 
                                    :key="platform.id" 
                                    v-slot="{ active, close }">
                                    <a 
                                        href="#"
                                        @click.prevent="platformId = platform.id; close();"
                                        :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                        {{ platform.name }}
                                    </a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>

            <!-- Columna Campaigns -->
            <div v-if="selectedPlatform" class="border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <template v-if="selectedCampaign">
                        <router-link :to="{ name: 'DealsAdsManagerAdsCampaignView', params: { dealId: selectedDeal.id, platformId: selectedPlatform.id, campaignId: selectedCampaign.id } }">
                            <h2 class="text-md font-bold text-gray-600 cursor-pointer">
                                {{ __deals('Campaigns') }}
                            </h2>
                        </router-link>
                    </template>
                    <template v-else>
                        <h2 class="text-md font-bold text-gray-600">
                            {{ __deals('Campaigns') }}
                        </h2>
                    </template>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                                <span class="sr-only">Open options</span>
                                <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <div class="py-1">
                                    <!-- Create Campaign -->
                                    <MenuItem v-slot="{ active }">
                                        <router-link
                                            :to="{ 
                                                name: 'DealsAdsManagerAdsCampaignCreate',
                                                params: { 
                                                    dealId: selectedDeal.id, 
                                                    platformId: selectedPlatform.id 
                                                }
                                            }"
                                            :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                            {{ __deals('Create Campaign') }}
                                        </router-link>
                                    </MenuItem>
                                    <!-- Edit Campaign -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedCampaign">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsCampaignEdit', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id,
                                                        campaignId: selectedCampaign.id
                                                    }
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Edit Campaign') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Edit Campaign') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                    <!-- Delete Campaign -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedCampaign">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsCampaignDelete', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id,
                                                        campaignId: selectedCampaign.id 
                                                    }
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Delete Campaign') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Delete Campaign') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <Menu as="div" class="relative inline-block text-left w-full">
                    <div>
                        <MenuButton class="inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <span v-if="selectedCampaign">{{ selectedCampaign.name }}</span>
                            <span v-else>Selecciona una Campaña</span>
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
                        <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="py-1">
                                <MenuItem 
                                    v-for="campaign in campaigns" 
                                    :key="campaign.id" 
                                    v-slot="{ active, close }">
                                    <a 
                                        href="#"
                                        @click.prevent="campaignId = campaign.id; close();"
                                        :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                        {{ campaign.name }}
                                    </a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>

            <!-- Columna Ad Groups -->
            <div v-if="selectedCampaign" class="border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <template v-if="selectedAdGroup">
                        <router-link :to="{ name: 'DealsAdsManagerAdsAdGroupView', params: { dealId: selectedDeal.id, platformId: selectedPlatform.id, campaignId: selectedCampaign.id, adGroupId: selectedAdGroup.id } }">
                            <h2 class="text-md font-bold text-gray-600 cursor-pointer">
                                {{ __deals('Ad Groups') }}
                            </h2>
                        </router-link>
                    </template>
                    <template v-else>
                        <h2 class="text-md font-bold text-gray-600">
                            {{ __deals('Ad Groups') }}
                        </h2>
                    </template>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                                <span class="sr-only">Open options</span>
                                <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <div class="py-1">
                                    <!-- Create Ad Group -->
                                    <MenuItem v-slot="{ active }">
                                        <router-link
                                            :to="{ 
                                                name: 'DealsAdsManagerAdsAdGroupCreate',
                                                params: { 
                                                    dealId: selectedDeal.id, 
                                                    platformId: selectedPlatform.id,
                                                    campaignId: selectedCampaign.id 
                                                }
                                            }"
                                            :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                            {{ __deals('Create Ad Group') }}
                                        </router-link>
                                    </MenuItem>
                                    <!-- Edit Ad Group -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedAdGroup">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsAdGroupEdit', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id,
                                                        campaignId: selectedCampaign.id,
                                                        adGroupId: selectedAdGroup.id 
                                                    }
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Edit Ad Group') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Edit Ad Group') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                    <!-- Delete Ad Group -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedAdGroup">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsAdGroupDelete', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id,
                                                        campaignId: selectedCampaign.id,
                                                        adGroupId: selectedAdGroup.id 
                                                    }
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Delete Ad Group') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Delete Ad Group') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <Menu as="div" class="relative inline-block text-left w-full">
                    <div>
                        <MenuButton class="inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <span v-if="selectedAdGroup">{{ selectedAdGroup.name }}</span>
                            <span v-else>Selecciona un Ad Group</span>
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
                        <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="py-1">
                                <MenuItem 
                                    v-for="group in groups" 
                                    :key="group.id" 
                                    v-slot="{ active,close }">
                                    <a 
                                        href="#"
                                        @click.prevent="groupId = group.id; close();"
                                        :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                        {{ group.name }}
                                    </a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>

            <!-- Columna Ads -->
            <div v-if="selectedAdGroup" class="border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <template v-if="selectedAd">
                        <router-link :to="{ name: 'DealsAdsManagerAdsAdView', params: { dealId: selectedDeal.id, platformId: selectedPlatform.id, campaignId: selectedCampaign.id, adGroupId: selectedAdGroup.id, adId: selectedAd.id } }">
                            <h2 class="text-md font-bold text-gray-600 cursor-pointer">
                                {{ __deals('Ads') }}
                            </h2>
                        </router-link>
                    </template>
                    <template v-else>
                        <h2 class="text-md font-bold text-gray-600">
                            {{ __deals('Ads') }}
                        </h2>
                    </template>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton class="flex items-center rounded-full text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                                <span class="sr-only">Open options</span>
                                <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                <div class="py-1">
                                    <!-- Create Ad -->
                                    <MenuItem v-slot="{ active }">
                                        <router-link
                                            :to="{ 
                                                name: 'DealsAdsManagerAdsAdCreate',
                                                params: { 
                                                    dealId: selectedDeal.id, 
                                                    platformId: selectedPlatform.id,
                                                    campaignId: selectedCampaign.id,
                                                    adGroupId: selectedAdGroup.id 
                                                }
                                            }"
                                            :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                            {{ __deals('Create Ad') }}
                                        </router-link>
                                    </MenuItem>
                                    <!-- Edit Ad -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedAd">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsAdEdit', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id,
                                                        campaignId: selectedCampaign.id,
                                                        adGroupId: selectedAdGroup.id,
                                                        adId: selectedAd.id 
                                                    }
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Edit Ad') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Edit Ad') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                    <!-- Delete Ad -->
                                    <MenuItem v-slot="{ active }">
                                        <template v-if="selectedAd">
                                            <router-link
                                                :to="{ 
                                                    name: 'DealsAdsManagerAdsAdDelete', 
                                                    params: { 
                                                        dealId: selectedDeal.id,
                                                        platformId: selectedPlatform.id,
                                                        campaignId: selectedCampaign.id,
                                                        adGroupId: selectedAdGroup.id,
                                                        adId: selectedAd.id 
                                                    } 
                                                }"
                                                :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                                {{ __deals('Delete Ad') }}
                                            </router-link>
                                        </template>
                                        <template v-else>
                                            <span :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm', 'opacity-50 cursor-not-allowed' ]">
                                                {{ __deals('Delete Ad') }}
                                            </span>
                                        </template>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <Menu as="div" class="relative inline-block text-left w-full">
                    <div>
                        <MenuButton class="inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <span v-if="selectedAd">{{ selectedAd.name }}</span>
                            <span v-else>Selecciona un Ad</span>
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
                        <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="py-1">
                                <MenuItem 
                                    v-for="ad in ads" 
                                    :key="ad.id" 
                                    v-slot="{ active, close }">
                                    <a 
                                        href="#"
                                        @click.prevent="adId = ad.id; close();"
                                        :class="[ active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm' ]">
                                        {{ ad.name }}
                                    </a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>

        </section>

        <!-- Views -->
        <section v-if="selectedDeal" class="border-t border-gray-200">
            <router-view />
        </section>
        <section 
            v-else 
            class="p-4 border-t border-gray-200">
            <div class="animate-pulse flex flex-col items-center justify-center w-full h-64 bg-gray-100 rounded-md">
                <div class="h-6 bg-gray-300 rounded w-1/3 mb-2"></div>
                <div class="h-4 bg-gray-300 rounded w-1/4"></div>
                <p class="mt-4 text-gray-500">No hay Deal seleccionado</p>
                <div class="h-4 bg-gray-300 rounded w-1/4"></div>
                <div class="h-6 bg-gray-300 rounded w-1/3 mb-2"></div>
            </div>
        </section>
    </div>
</template>

<script>
import { indexModel as indexDealModel, showModel as showDealModel } from '@dealsModels/deal'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import {
    ChevronDownIcon,
    EllipsisVerticalIcon,
    PencilSquareIcon,
    DocumentDuplicateIcon,
    ArchiveBoxIcon,
    ArrowRightCircleIcon,
    UserPlusIcon,
    HeartIcon,
    TrashIcon
} from '@heroicons/vue/20/solid'

export default {
    name: "AdsManagerDashboard",
    components: {
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        ChevronDownIcon,
        EllipsisVerticalIcon,
        PencilSquareIcon,
        DocumentDuplicateIcon,
        ArchiveBoxIcon,
        ArrowRightCircleIcon,
        UserPlusIcon,
        HeartIcon,
        TrashIcon
    },
    data() {
        return {
            // Los Deals se muestran solo en el select del header
            testDeals: [
                { id: 1, name: "Deal Inmobiliario", platforms: [
                    { id: 11, name: "Facebook", campaigns: [
                        { id: 111, name: "Campaña Inmuebles FB", adGroups: [
                            { id: 1111, name: "Ad Group 1", ads: [
                                { id: 11111, name: "Ad 1" },
                                { id: 11112, name: "Ad 2" }
                            ] },
                            { id: 1112, name: "Ad Group 2", ads: [
                                { id: 11121, name: "Ad 3" }
                            ] }
                        ] },
                        { id: 112, name: "Campaña Inmuebles FB 2", adGroups: [
                            { id: 1121, name: "Ad Group 3", ads: [
                                { id: 11211, name: "Ad 4" }
                            ] }
                        ] }
                    ] },
                    { id: 12, name: "Google", campaigns: [
                        { id: 121, name: "Campaña Inmuebles Google", adGroups: [
                            { id: 1211, name: "Ad Group 4", ads: [
                                { id: 12111, name: "Ad 5" }
                            ] }
                        ] }
                    ] }
                ] },
                { id: 2, name: "Deal Afiliados Amazon", platforms: [
                    { id: 21, name: "Amazon", campaigns: [
                        { id: 211, name: "Campaña Afiliados", adGroups: [
                            { id: 2111, name: "Ad Group A", ads: [
                                { id: 21111, name: "Ad A" }
                            ] }
                        ] }
                    ] }
                ] },
                { id: 3, name: "Deal Cursos Online", platforms: [
                    { id: 31, name: "Facebook", campaigns: [
                        { id: 311, name: "Campaña Cursos 1", adGroups: [
                            { id: 3111, name: "Ad Group Cursos A", ads: [
                                { id: 31111, name: "Ad Cursos 1" },
                                { id: 31112, name: "Ad Cursos 2" }
                            ] }
                        ] }
                    ] }
                ] }
            ],
            deals: [],
            selectedDeal: null,
            dealId: '',

            ////////////
            platforms: [],
            selectedPlatform: null,
            platformId: '',

            campaigns: [],
            selectedCampaign: null,
            campaignId: '',

            groups: [],
            selectedAdGroup: null,
            groupId: '',

            ads: [],
            selectedAd: null,
            adId: '',
            
        }
    },
    async mounted() {
        await this.init();
    },
    watch: {
        dealId(newValue, oldValue) {
            if (newValue && newValue !== oldValue) this.fetchDeal();
        },
        platformId(newValue, oldValue) {
            if (newValue !== oldValue) this.fetchPlatform();
        },
        campaignId(newValue, oldValue) {
            if (newValue !== oldValue) this.fetchCampaign();
        },
        groupId(newValue, oldValue) {
            if (newValue !== oldValue) this.fetchAdGroup();
        },
        adId(newValue, oldValue) {
            if (newValue !== oldValue) this.fetchAd();
        },
    },
    methods: {
        async init() {
            await this.fetchDeals();
            await this.intFromUrlParams();
        },
        async fetchDeals() {
            try {
                const response = await indexDealModel({
                    paginate: 0,
                    status: 'active',
                    orderBy: 'created_at',
                });
                // this.deals = response; // Descomentar esta línea en producción
                this.deals = this.testDeals; // Para pruebas, eliminar esta línea en producción
            } catch (error) {
                console.error("Error fetching deals:", error);
            }
        },
        async intFromUrlParams() {
            this.dealId = this.$route.params.dealId || this.getFirstDealId();
            if (this.dealId) {
                await this.fetchDeal();
            }
            this.platformId = this.$route.params.platformId || null;
            if (this.platformId) {
                await this.fetchPlatform();
            }
            this.campaignId = this.$route.params.campaignId || null;
            if (this.campaignId) {
                await this.fetchCampaign();
            }
            this.groupId = this.$route.params.adGroupId || null;
            if (this.groupId) {
                await this.fetchAdGroup();
            }
            this.adId = this.$route.params.adId || null;
            if (this.adId) {
                await this.fetchAd();
            }
        },
        getFirstDealId() {
            if (this.deals.length > 0) {
                return this.deals[0].id;
            }
            return null;
        },
        async fetchDeal(){
            try {
                if(!this.dealId) return;
                /*
                const response = await showDealModel(this.dealId, ['platforms']);
                this.selectedDeal = response;
                */
                
                // test
                
                this.selectedDeal = this.deals.find(deal => deal.id === parseInt(this.dealId));
                if (this.selectedDeal) this.selectDeal(this.selectedDeal);
            } catch (error) {
                console.error("Error fetching deal:", error);
            }
        },
        async selectDeal(deal) {
            this.selectedDeal = deal;
            this.selectedPlatform = null;
            this.selectedCampaign = null;
            this.selectedAdGroup = null;
            this.selectedAd = null;
            this.platforms = this.selectedDeal.platforms;
            this.$router.push({ 
                name: 'DealsAdsManagerAdsDealView', 
                params: { 
                    dealId: deal.id 
                } 
            });
        },
        async fetchPlatform() {
            try {
                if(!this.selectedDeal) return;
                // Versión de producción:
                // const response = await platformModel.fetchPlatform(this.selectedPlatform.id);
                // this.selectedPlatform = response;
                
                // Versión de prueba:
                
                this.platforms = this.selectedDeal.platforms;
                this.selectedPlatform = this.platforms.find(
                    p => p.id === parseInt(this.platformId)
                );
                if (this.selectedPlatform) this.selectPlatform(this.selectedPlatform);
            } catch (error) {
                console.error("Error fetching platform:", error);
            }
        },
        selectPlatform(platform) {
            this.selectedPlatform = platform;
            this.selectedCampaign = null;
            this.selectedAdGroup = null;
            this.selectedAd = null;
            this.campaigns = this.selectedPlatform.campaigns;
            this.$router.push({ 
                name: 'DealsAdsManagerAdsPlatformView', 
                params: { 
                    dealId: this.dealId, 
                    platformId: platform.id 
                } 
            });
        },
        async fetchCampaign() {
            try {
                if(!this.selectedPlatform) return;
                // Versión de producción:
                // const response = await campaignModel.fetchCampaign(this.selectedCampaign.id);
                // this.selectedCampaign = response;
                
                // Versión de prueba:
                
                this.campaigns = this.selectedPlatform.campaigns;
                this.selectedCampaign = this.campaigns.find(
                    c => c.id === parseInt(this.campaignId)
                );
                if (this.selectedCampaign) this.selectCampaign(this.selectedCampaign);
            } catch (error) {
                console.error("Error fetching campaign:", error);
            }
        },
        selectCampaign(campaign) {
            this.selectedCampaign = campaign;
            this.selectedAdGroup = null;
            this.selectedAd = null;
            this.groups = this.selectedCampaign.adGroups;
            this.$router.push({ 
                name: 'DealsAdsManagerAdsCampaignView', 
                params: { 
                    dealId: this.dealId, 
                    platformId: this.selectedPlatform.id, 
                    campaignId: campaign.id 
                } 
            });
        },
        async fetchAdGroup() {
            try {
                if(!this.selectedCampaign) return;
                // Versión de producción:
                // const response = await adGroupModel.fetchAdGroup(this.selectedAdGroup.id);
                // this.selectedAdGroup = response;
                
                // Versión de prueba:
                this.groups = this.selectedCampaign.adGroups;
                this.selectedAdGroup = this.groups.find(
                    g => g.id === parseInt(this.groupId)
                );
                if (this.selectedAdGroup) this.selectAdGroup(this.selectedAdGroup);
            } catch (error) {
                console.error("Error fetching ad group:", error);
            }
        },
        selectAdGroup(group) {
            this.selectedAdGroup = group;
            this.selectedAd = null;
            this.ads = this.selectedAdGroup.ads;
            this.$router.push({ 
                name: 'DealsAdsManagerAdsAdGroupView', 
                params: { 
                    dealId: this.dealId, 
                    platformId: this.selectedPlatform.id, 
                    campaignId: this.selectedCampaign.id, 
                    adGroupId: group.id 
                } 
            });
        },
        async fetchAd() {
            try {
                if(!this.selectedAdGroup) return;
                // Versión de producción:
                // const response = await adModel.fetchAd(this.selectedAd.id);
                // this.selectedAd = response;
                
                // Versión de prueba:
                this.ads = this.selectedAdGroup.ads;
                this.selectedAd = this.ads.find(
                    a => a.id === parseInt(this.adId)
                );
                if (this.selectedAd) this.selectAd(this.selectedAd);
            } catch (error) {
                console.error("Error fetching ad:", error);
            }
        },
        selectAd(ad) {
            this.selectedAd = ad;
            this.$router.push({ 
                name: 'DealsAdsManagerAdsAdView', 
                params: { 
                    dealId: this.dealId, 
                    platformId: this.selectedPlatform.id, 
                    campaignId: this.selectedCampaign.id, 
                    adGroupId: this.selectedAdGroup.id, 
                    adId: ad.id 
                } 
            });
        },
        viewReports() {
            this.$router.push({ name: 'DealsAdsManagerAdsReports', params: { dealId: this.dealId } });
        },
    }
}
</script>

<style scoped>
    /* Para pantallas grandes: 4 columnas, medianas: 2 columnas y en móviles: 1 columna */
    @media (min-width: 1024px) {
        main {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }
    @media (min-width: 768px) and (max-width: 1023px) {
        main {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 767px) {
        main {
            grid-template-columns: 1fr;
        }
    }
</style>