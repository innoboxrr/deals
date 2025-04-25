import { defineStore } from 'pinia';

export const useAdvertisersManagerStore = defineStore('deals-pages-advertisers-manager', {
    state: () => ({
        headerTitle: 'Advertisers Manager',
        dealAdvertiser: null,
        dealAdvertiserId: null,

        agreement: null,
        agreementId: null,
    }),
    actions: {
        setHeaderTitle(title) {
            this.headerTitle = title;
        },
        setDealAdvertiser(advertiser) {
            this.dealAdvertiser = advertiser;
            this.dealAdvertiserId = advertiser?.id;
        },
        setDealAdvertiserId(advertiserId) {
            this.dealAdvertiserId = advertiserId;
        },
        setAgreement(agreement) {
            this.agreement = agreement;
            this.agreementId = agreement?.id;
        },
        setAgreementId(agreementId) {
            this.agreementId = agreementId;
        },
        resetProps() {
            this.dealAdvertiser = null;
            this.dealAdvertiserId = null;
            this.agreement = null;
            this.agreementId = null;
        }
    },
});
