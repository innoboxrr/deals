import { defineStore } from 'pinia';

export const useAdvertisersManagerStore = defineStore('deals-pages-advertisers-manager', {
    state: () => ({
        headerTitle: 'Advertisers Manager',
    }),
    actions: {
        setHeaderTitle(title) {
            this.headerTitle = title;
        },
    },
});
