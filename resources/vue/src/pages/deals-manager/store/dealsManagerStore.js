import { defineStore } from 'pinia';

export const useDealsManagerStore = defineStore('deals-pages-deals-manager', {
    state: () => ({
        headerTitle: 'Deals Manager',
        dealId: null,
        dealProductId: null,
    }),
    actions: {
        setHeaderTitle(title) {
            this.headerTitle = title;
        },
        setDealId(dealId) {
            this.dealId = dealId;
        },
        setDealProductId(dealProductId) {
            this.dealProductId = dealProductId;
        },
    },
});
