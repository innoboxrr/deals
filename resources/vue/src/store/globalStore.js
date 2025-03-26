import { defineStore } from 'pinia'
import { HomeIcon, GlobeAltIcon, ServerIcon, ClockIcon, CreditCardIcon, Cog6ToothIcon } from '@heroicons/vue/24/outline'

export const useGlobalStore = defineStore('deals-global', {
    state: () => ({
        sidebarOpen: false,
        navigation: [
            { name: 'Inicio', route: { name: 'DealsDashboard' }, icon: HomeIcon, current: true },    
        ],
        /*
        dealsList: [
            { id: 1, name: 'example.com', route: { name: 'DealsdealDetail', params: { deal: 'example.com' } }, initial: 'E', current: true },
            { id: 2, name: 'testdeal.net', route: { name: 'DealsdealDetail', params: { deal: 'testdeal.net' } }, initial: 'T', current: false },
            { id: 3, name: 'mywebsite.org', route: { name: 'DealsdealDetail', params: { deal: 'mywebsite.org' } }, initial: 'M', current: false },
        ],
        */
        activityItems: [
            {
                user: {
                    name: 'Michael Foster',
                    imageUrl: 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                },
                action: 'Renovó el dominio example.com',
                date: 'Hace 1h',
                dateTime: '2023-01-23T11:00',
            },
        ],
    }),
    actions: {
        // Aquí puedes agregar acciones si lo requieres
    },
})
