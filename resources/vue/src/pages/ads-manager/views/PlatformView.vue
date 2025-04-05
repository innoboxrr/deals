<template>
    <div>
        <div v-if="isDetailView" class="min-h-screen space-y-8 bg-gray-50">
            <!-- Header -->
            <header class="pb-4 border-b border-gray-300 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Google Platform Overview</h1>
                    <p class="text-sm text-gray-600 mt-1">Revisa el desempeño general de la integración con Google (Ads, Analytics, Leads, etc).</p>
                </div>

                <!-- Dropdown de acciones -->
                <Menu as="div" class="relative inline-block text-left mt-4 md:mt-0">
                    <div>
                        <MenuButton
                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
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
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <MenuItems
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        @click.prevent="viewReports"
                                        :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                        Ver Reportes
                                    </a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        @click.prevent="syncNow"
                                        :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                        Sincronizar Ahora
                                    </a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a
                                        href="#"
                                        @click.prevent="disconnectIntegration"
                                        :class="[active ? 'bg-red-100 text-red-800' : 'text-red-600', 'block px-4 py-2 text-sm']">
                                        Desconectar Integración
                                    </a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </header>

            <!-- Estado de la Conexión -->
            <section class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Estado de Conexión</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Cuenta Conectada:</p>
                        <p class="text-lg font-bold text-gray-800">{{ googleAccount.email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Última Sincronización:</p>
                        <p class="text-lg font-bold text-gray-800">{{ googleAccount.lastSync }}</p>
                    </div>
                </div>
            </section>

            <!-- Métricas Agregadas -->
            <section class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Métricas Agregadas</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center bg-gray-50 rounded p-4">
                        <p class="text-3xl font-bold text-indigo-600">{{ metrics.totalClicks }}</p>
                        <p class="text-sm text-gray-600">Clics</p>
                    </div>
                    <div class="text-center bg-gray-50 rounded p-4">
                        <p class="text-3xl font-bold text-green-600">{{ metrics.conversions }}</p>
                        <p class="text-sm text-gray-600">Conversiones</p>
                    </div>
                    <div class="text-center bg-gray-50 rounded p-4">
                        <p class="text-3xl font-bold text-yellow-600">{{ metrics.ctr }}%</p>
                        <p class="text-sm text-gray-600">CTR Promedio</p>
                    </div>
                    <div class="text-center bg-gray-50 rounded p-4">
                        <p class="text-3xl font-bold text-red-600">${{ metrics.spend }}</p>
                        <p class="text-sm text-gray-600">Gasto Total</p>
                    </div>
                </div>
            </section>

            <!-- Campañas activas -->
            <section class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Campañas Activas</h2>
                <ul class="space-y-2">
                    <li v-for="campaign in activeCampaigns" :key="campaign.id" class="bg-gray-50 p-4 rounded">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-bold text-gray-800">{{ campaign.name }}</p>
                                <p class="text-sm text-gray-500">Tipo: {{ campaign.type }} • Estado: {{ campaign.status }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Gasto:</p>
                                <p class="text-lg font-bold text-red-600">${{ campaign.spend }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>

            <!-- Leads captados desde Google -->
            <section class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Leads Captados desde Google</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Campaña</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="lead in googleLeads" :key="lead.id">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ lead.name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ lead.email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ lead.date }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ lead.campaign }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
        <router-view />
    </div>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
export default {
    name: 'PlatformGoogleView',
    components: {
        Menu,
        MenuButton,
        MenuItems,
        MenuItem,
        ChevronDownIcon
    },
    data() {
        return {
            googleAccount: {
                email: 'ads@empresa.com',
                lastSync: '2025-04-04 09:42'
            },
            metrics: {
                totalClicks: 4123,
                conversions: 823,
                ctr: 4.2,
                spend: 12134.56
            },
            activeCampaigns: [
                { id: 1, name: 'Campaña Auto Seguros', type: 'Search', status: 'Activa', spend: 3200.00 },
                { id: 2, name: 'Curso VueJS Pro', type: 'Display', status: 'Activa', spend: 1800.00 }
            ],
            googleLeads: [
                { id: 1, name: 'Laura Gutiérrez', email: 'laura@gmail.com', date: '2025-04-03', campaign: 'Campaña Auto Seguros' },
                { id: 2, name: 'Oscar Torres', email: 'oscar@hotmail.com', date: '2025-04-03', campaign: 'Curso VueJS Pro' }
            ]
        }
    },
    computed: {
        isDetailView() {
            // Muestra la vista detallada solo si la ruta es 'DealsAdsManagerAdsDealView'
            return this.$route.name === 'DealsAdsManagerAdsPlatformView'
        }
    },
}
</script>
