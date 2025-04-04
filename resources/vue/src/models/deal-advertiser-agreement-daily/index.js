import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_advertiser_agreement_daily.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealAdvertiserAgreementDaily',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdvertiserAgreementDaily',
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
			id: 'date',
			value: 'Fecha',
			sortable: true,
			html: true,
			parser: (value) => `<span class="text-sm text-gray-800 dark:text-gray-200">${new Date(value).toLocaleDateString()}</span>`,
		},

		{
			id: 'start_hour',
			value: 'Inicio',
			sortable: false,
			html: true,
			parser: (value) => `<span class="text-xs text-gray-600">${value}:00</span>`,
		},

		{
			id: 'end_hour',
			value: 'Fin',
			sortable: false,
			html: true,
			parser: (value) => `<span class="text-xs text-gray-600">${value}:00</span>`,
		},

		{
			id: 'cpl',
			value: 'CPL',
			sortable: true,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'budget',
			value: 'Presupuesto',
			sortable: true,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'spent',
			value: 'Gastado',
			sortable: true,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},

		{
			id: 'progress',
			value: 'Progreso (%)',
			sortable: false,
			html: true,
			parser: (value) => {
				const percent = parseFloat(value).toFixed(1);
				const color = percent >= 100 ? 'red' : percent >= 80 ? 'orange' : 'green';
				return `<span class="px-2 py-1 text-xs font-semibold text-${color}-800 bg-${color}-100 rounded dark:bg-${color}-900 dark:text-${color}-300">${percent}%</span>`;
			},
		},

		{
			id: 'leads_assigned',
			value: 'Leads Asignados',
			sortable: true,
			html: false,
		},
	];
};

export const dataTableSort = () => {
	return {
		id: 'asc',
        date: 'asc',
        start_hour: 'asc',
        end_hour: 'asc',
        cpl: 'asc',
        budget: 'asc',
        spent: 'asc',
        progress: 'asc',
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
        deal_advertiser_agreement_daily_id: modelId,
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
        deal_advertiser_agreement_daily_id: modelId,
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
        deal_advertiser_agreement_daily_id: data.id,
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
