import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_advertiser_agreement.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealAdvertiserAgreement',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdvertiserAgreement',
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
		{ id: 'id', value: 'ID', sortable: true },

		{
			id: 'status',
			value: 'Estado',
			sortable: true,
			html: true,
			parser: (value) => {
				const colorMap = {
					draft: 'gray',
					active: 'green',
					paused: 'orange',
					pending_payment: 'yellow',
					cancelled: 'red',
					completed: 'blue',
				};
				const color = colorMap[value] || 'gray';
				return `<span class="px-2 py-1 text-xs font-semibold text-${color}-800 bg-${color}-100 rounded dark:bg-${color}-900 dark:text-${color}-300">${value}</span>`;
			},
		},

		{
			id: 'budget',
			value: 'Presupuesto',
			sortable: true,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'net_budget',
			value: 'Presupuesto Neto',
			sortable: false,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'budget_spent',
			value: 'Gastado',
			sortable: false,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'actual_cpl',
			value: 'CPL Actual',
			sortable: false,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'start_date',
			value: 'Inicio',
			sortable: true,
			html: true,
			parser: (value) => `<span class="text-xs">${new Date(value).toLocaleDateString()}</span>`,
		},

		{
			id: 'end_date',
			value: 'Fin',
			sortable: true,
			html: true,
			parser: (value) => `<span class="text-xs">${new Date(value).toLocaleDateString()}</span>`,
		},

		{
			id: 'leads_assigned',
			value: 'Leads',
			sortable: true,
			html: false,
		},
	];
};

export const dataTableSort = () => {
	return {
		id: 'asc',
        status: 'asc',
        budget: 'asc',
        net_budget: 'asc',
        budget_spent: 'asc',
        actual_cpl: 'asc',
        start_date: 'asc',
        end_date: 'asc',
        leads_assigned: 'asc',
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
        deal_advertiser_agreement_id: modelId,
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
        deal_advertiser_agreement_id: modelId,
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
        deal_advertiser_agreement_id: data.id,
    }, {}, 3, 1500, confirmOptions);
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
