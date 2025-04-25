import { defineStore } from 'pinia'
import { __deals } from './../utils/translate.js'
import { 
    HomeIcon,
    CubeIcon,
    MegaphoneIcon,
    BriefcaseIcon,
    UserGroupIcon,
    ShareIcon,
    BuildingStorefrontIcon,
    DocumentTextIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline'

export const useGlobalStore = defineStore('deals-global', {
    state: () => ({
        sidebarOpen: false,
        navigation: [
            { name: __deals('Dashboard'), route: { name: 'DealsDashboard' }, icon: HomeIcon, current: true },
            { name: __deals('Deals'), route: { name: 'DealsManager' }, icon: BriefcaseIcon, current: false },
            { name: __deals('Advertisers'), route: { name: 'DealsAdvertisersManager' }, icon: BuildingStorefrontIcon, current: false },
            // { name: __deals('Routing'), route: { name: 'DealsDashboard' }, icon: ShareIcon, current: false },
            // { name: __deals('Agreements'), route: { name: 'DealsAgreementsManager' }, icon: DocumentTextIcon, current: false },
            { name: __deals('Ads'), route: { name: 'DealsAdsManager' }, icon: MegaphoneIcon, current: false },
            // { name: __deals('Affiliates'), route: { name: 'DealsDashboard' }, icon: UsersIcon, current: false },
            { name: __deals('Leads'), route: { name: 'DealsLeadsManager' }, icon: UserGroupIcon, current: false },
            { name: __deals('Products'), route: { name: 'DealsProductsManager' }, icon: CubeIcon, current: false },
        ],
        dealsList: [
            /*
            {
                id: 1,
                name: 'Deals 1 ',
                description: 'Deals description',
                status: 'active',
                route: { name: 'DealsDashboard' },
                createdAt: '2023-01-23T11:00',
                updatedAt: '2023-01-23T11:00',
            },
            {
                id: 2,
                name: 'Deals 2',
                description: 'Deals 2 description',
                status: 'inactive',
                route: { name: 'DealsDashboard' },
                createdAt: '2023-01-23T11:00',
                updatedAt: '2023-01-23T11:00',
            },
            */
        ],
        activityItems: [
            /*
            {
                user: {
                    name: 'Michael Foster',
                    imageUrl: 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                },
                action: 'Renovó el dominio example.com',
                date: 'Hace 1h',
                dateTime: '2023-01-23T11:00',
            },
            */
        ],
    }),
    actions: {
        setCurrentRoute(routeName) {
            this.navigation.forEach(item => {
                item.current = item.route.name === routeName;
            });
        },
    },
})
