import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_advertiser_agreement_invoice.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealAdvertiserAgreementInvoice',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdvertiserAgreementInvoice',
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
				const color = {
					pending: 'yellow',
					paid: 'green',
					cancelled: 'red',
				}[value?.toLowerCase()] || 'gray';
				return `<span class="px-2 py-1 text-xs font-semibold text-${color}-800 bg-${color}-100 rounded dark:bg-${color}-900 dark:text-${color}-300">${value}</span>`;
			},
		},

		{
			id: 'from_date',
			value: 'Desde',
			sortable: true,
			html: true,
			parser: (value) =>
				`<span class="text-sm text-gray-700 dark:text-gray-300">${new Date(value).toLocaleDateString()}</span>`,
		},

		{
			id: 'to_date',
			value: 'Hasta',
			sortable: true,
			html: true,
			parser: (value) =>
				`<span class="text-sm text-gray-700 dark:text-gray-300">${new Date(value).toLocaleDateString()}</span>`,
		},

		{
			id: 'total',
			value: 'Total',
			sortable: true,
			html: true,
			parser: (value) =>
				`<span class="font-semibold text-gray-800 dark:text-gray-200">$${parseFloat(value).toFixed(2)}</span>`,
		},

		{
			id: 'management_fee',
			value: 'Fee',
			sortable: false,
			html: true,
			parser: (value) =>
				`<span class="text-xs text-gray-600 dark:text-gray-400">$${parseFloat(value).toFixed(2)}</span>`,
		},

		{
			id: 'ad_spend',
			value: 'Ad Spend',
			sortable: false,
			html: true,
			parser: (value) =>
				`<span class="text-xs text-blue-700 dark:text-blue-300">$${parseFloat(value).toFixed(2)}</span>`,
		},

		{
			id: 'tax',
			value: 'Impuesto',
			sortable: false,
			html: true,
			parser: (value) =>
				`<span class="text-xs text-purple-700 dark:text-purple-300">$${parseFloat(value).toFixed(2)}</span>`,
		},
	];
};

export const dataTableSort = () => {
	return {
		id: 'asc',
        status: 'asc',
        from_date: 'asc',
        to_date: 'asc',
        total: 'asc',
        management_fee: 'asc',
        ad_spend: 'asc',
        tax: 'asc',
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
        deal_advertiser_agreement_invoice_id: modelId,
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
        deal_advertiser_agreement_invoice_id: modelId,
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
        deal_advertiser_agreement_invoice_id: data.id,
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
