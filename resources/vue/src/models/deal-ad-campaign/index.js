import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_ad_campaign.'; // Reemplaza con la ruta adecuada

export const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Reemplaza con el token adecuado

export let filters = {}

export const setFilters = (newFilters = {}) => {
	filters = {
		...filters,
		...newFilters,
	}
	return filters;
};

export const getFilters = () => {
	return filters;
};

export const resetFilters = () => {
	filters = {};
	return filters;
};

export const crudActions = () => {

	return [
		{
			id: 'create',
			name: 'Create',
			callback: 'createDealAdCampaign',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdCampaign',
					params: {}
				}
			}
		},
		{
			id: 'export',
			name: 'Export',
			callback: 'exportModel',
			icon: 'fa-download',
			route: false,
			policy: false,
			params: {}
		}
	];
};

export const dataTableHead = () => {
	return [
		{
			id: 'id',
			value: 'ID',
			sortable: true,
			html: false,
		},
		{
			id: 'name',
			value: 'Nombre de la campaña',
			sortable: true,
			html: true,
			parser: (value) => {
				return `<span class="font-semibold text-blue-700 dark:text-blue-300">${value}</span>`;
			},
		},
		{
			id: 'deal_ad_platform',
			value: 'Plataforma',
			sortable: true,
			html: true,
			parser: (value) => {
				return `<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded dark:bg-green-900 dark:text-green-200">${value}</span>`;
			},
		},
	];
};


export const dataTableSort = () => {
	return {
		id: 'asc',
        name: 'asc',
        description: 'asc',
        deal_ad_platform: 'asc',
	};
};

export const getPolicies = (modelId = null) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'policies'), {
        _token: CSRF_TOKEN,
        id: modelId,
    }, {}, 3, 1500);
};

export const getPolicy = (policy, modelId = null) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'policy'), {
        _token: CSRF_TOKEN,
        policy: policy,
        id: modelId,
    }, {}, 3, 1500);
};

export const showModel = (modelId, loadRelations = [], loadCounts = [], data = {}) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'show'), {
        _token: CSRF_TOKEN,
        deal_ad_campaign_id: modelId,
        load_relations: loadRelations,
        load_counts: loadCounts,
        ...data,
    }, {}, 3, 1500);
};

export const indexModel = (filters = {}) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'index'), {
        _token: CSRF_TOKEN,
        ...filters,
    }, {}, 3, 1500);
};

export const createModel = (data) => {
    return makeHttpRequest('post', route(API_ROUTE_PREFIX + 'create'), {
        _token: CSRF_TOKEN,
        ...data,
    }, {}, 1, 1500);
};

export const updateModel = (modelId, data) => {
    return makeHttpRequest('put', route(API_ROUTE_PREFIX + 'update'), {
        _token: CSRF_TOKEN,
        ...data,
        deal_ad_campaign_id: modelId,
    }, {}, 1, 1500);
};

export const deleteModel = (data) => {
    const confirmOptions = {
        title: 'Confirm operation',
        text: 'Are you sure you want to delete this item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: t('Yes, delete'),
    };
    return makeHttpRequest('post', route(API_ROUTE_PREFIX + 'delete'), {
        _token: CSRF_TOKEN,
        _method: 'DELETE',
        deal_ad_campaign_id: data.id,
    }, {}, 0, 1500, confirmOptions);
};

export const exportModel = (data) => {
    const confirmOptions = {
        title: 'Confirm operation',
        text: 'Are you sure you want to export this item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: t('Yes, continue'),
    };
    return makeHttpRequest('post', route(API_ROUTE_PREFIX + 'export'), {
        _token: CSRF_TOKEN,
        ...data,
    }, {}, 3, 1500, confirmOptions);
};
