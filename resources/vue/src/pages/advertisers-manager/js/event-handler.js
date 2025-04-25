import { eventHandler as createBaseEventHandler } from '@dealsUtils/event-handler.js';
import { deleteModel as deleteAdvertiserModel } from '@dealsModels/deal-advertiser'

// Advertisers Manager Event Handlers

const createAdvertiser = (context) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAdvertiserCreate',
    });
}

const showAdvertiser = (context, { advertiserId = null }) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAdvertiserShow',
        params: { advertiserId },
    });
};

const editAdvertiser = (context, { advertiserId = null }) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAdvertiserEdit',
        params: { advertiserId },
    });
};

const showAdvertiserAgreements = (context, { advertiserId = null }) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAgreementIndex',
        params: { advertiserId },
    });
};

const deleteAdvertiser = async (context, { advertiserId = null }, callback) => {
    await deleteAdvertiserModel({ id: advertiserId });
    callback?.();
    context.alert('delete')
};

// Advertisers Bulk Event Handlers

const suspendAdvertisers = async (context, { selectedAdvertisers = [] }, callback) => {
    console.log('suspendAdvertisers', selectedAdvertisers);
    callback?.();
}

const activateAdvertisers = async (context, { selectedAdvertisers = [] }, callback) => {
    console.log('suspendAdvertisers', selectedAdvertisers);
    callback?.();
}

const exportAdvertisers = async (context, { selectedAdvertisers = [] }, callback) => {
    console.log('suspendAdvertisers', selectedAdvertisers);
    callback?.();
}

const deleteAdvertisers = async (context, { selectedAdvertisers = [] }, callback) => {
    console.log('suspendAdvertisers', selectedAdvertisers);
    callback?.();
}

// Agreements Event Handlers

const createAgreement = (context, { advertiserId = null }) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAgreementCreate',
        params: { advertiserId },
    });
};

const showAgreement = (context, { advertiserId = null, agreementId = null }) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAgreementShow',
        params: { advertiserId, agreementId },
    });
};

const editAgreement = (context, { advertiserId = null, agreementId = null }) => {
    context.$router.push({
        name: 'DealsAdvertisersManagerAgreementEdit',
        params: { advertiserId, agreementId },
    });
};

const deleteAgreement = (context, { agreementId = null }) => {
    console.log('🗑️ deleteAgreement', agreementId);
};

// Bulk Agreement Event Handlers

const pauseAgreements = async (context, { selectedAgreements = [] }, callback) => {
    console.log('pauseAgreements', selectedAgreements);
    callback?.();
}

const resumeAgreements = async (context, { selectedAgreements = [] }, callback) => {
    console.log('resumeAgreements', selectedAgreements);
    callback?.();
}

const deleteAgreements = async (context, { selectedAgreements = [] }, callback) => {
    console.log('deleteAgreements', selectedAgreements);
    callback?.();
}

const exportAgreements = async (context, { selectedAgreements = [] }, callback) => {
    console.log('exportAgreements', selectedAgreements);
    callback?.();
}


const advertiserHandlers = {
    createAdvertiser,
    showAdvertiser,
    editAdvertiser,
    showAdvertiserAgreements,
    deleteAdvertiser,
};

const bulkAdvertiserHandlers = {
    suspendAdvertisers,
    activateAdvertisers,
    exportAdvertisers,
    deleteAdvertisers,
};

const agreementHandlers = {
    createAgreement,
    showAgreement,
    editAgreement,
    deleteAgreement,
};

const bulkAgreementHandlers = {
    pauseAgreements,
    resumeAgreements,
    deleteAgreements,
    exportAgreements,
};


export const eventHandler = createBaseEventHandler({
    ...advertiserHandlers,
    ...bulkAdvertiserHandlers,
    ...agreementHandlers,
    ...bulkAgreementHandlers,
});

