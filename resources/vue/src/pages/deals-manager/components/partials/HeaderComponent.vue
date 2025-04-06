<template>
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
                                    v-model="value"
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

                            <!-- Global actions -->
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
                                                <router-link
                                                    :to="{
                                                        name: 'DealsManagerDealCreate'
                                                    }"
                                                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    <i class="fa-solid fa-plus mr-2"></i>
                                                    {{ __deals('New deal') }}
                                                </router-link>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="#"
                                                    @click.prevent="viewStatistics"
                                                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Ver Estadísticas
                                                </a>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="#"
                                                    @click.prevent="viewSettings"
                                                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Configuración del Deal
                                                </a>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="#"
                                                    @click.prevent="viewHistory"
                                                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Historial de Cambios
                                                </a>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="#"
                                                    @click.prevent="viewSettings"
                                                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Crear de Anunciante
                                                </a>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="#"
                                                    @click.prevent="viewSettings"
                                                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                                    Crear Producto
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
</template>

<script>
    import { ChevronDownIcon } from '@heroicons/vue/20/solid'
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    
    export default {
        name: 'HeaderComponent',
        components: {
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            ChevronDownIcon,
        },
        props: {
            modelValue: {
                type: [String, Number],
                default: ''
            },
            deals: {
                type: Array,
                default: () => []
            }
        },
        computed: {
            value: {
                get() {
                    return this.modelValue;
                },
                set(value) {
                    this.$emit('update:modelValue', value);
                }
            },
        },
    }
</script>