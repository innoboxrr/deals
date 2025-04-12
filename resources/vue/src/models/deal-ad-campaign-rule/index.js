import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_ad_campaign_rule.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealAdCampaignRule',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdCampaignRule',
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
			id: 'deal_ad_campaign_id',
			value: 'Campaña',
			sortable: true,
			html: true,
			parser: (value) => `<span class="text-sm font-medium text-indigo-700 dark:text-indigo-300">#${value}</span>`,
		},
		{
			id: 'condition_type',
			value: 'Condición',
			sortable: true,
			html: true,
			parser: (value) => {
				const labels = {
					'cost_per_lead_greater_than': 'CPL >',
					'conversion_rate_lower_than': 'CR <'
				};
				return `<span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded dark:bg-yellow-900 dark:text-yellow-200">${labels[value] || value}</span>`;
			},
		},
		{
			id: 'value',
			value: 'Valor',
			sortable: true,
			html: true,
			parser: (value) => `<span class="text-sm text-gray-700 dark:text-gray-300 font-semibold">${value}</span>`,
		},
		{
			id: 'action',
			value: 'Acción',
			sortable: false,
			html: true,
			parser: (value) => {
				const actions = {
					'pause': '⏸️ Pausar',
					'notify': '🔔 Notificar',
					'increase_budget': '💰 Aumentar presupuesto',
				};
				return `<span class="inline-flex items-center text-xs font-semibold bg-slate-200 text-slate-800 px-2 py-1 rounded dark:bg-slate-700 dark:text-slate-100">${actions[value] || value}</span>`;
			},
		},
	];
};


export const dataTableSort = () => {
	return {
		id: 'asc',
        deal_ad_campaign_id: 'asc',
        condition_type: 'asc',
        value: 'asc',
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
        deal_ad_campaign_rule_id: modelId,
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
        deal_ad_campaign_rule_id: modelId,
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
        deal_ad_campaign_rule_id: data.id,
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
