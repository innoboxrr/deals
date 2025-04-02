import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_ad_performance_snapshot.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealAdPerformanceSnapshot',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdPerformanceSnapshot',
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
			id: 'deal_ad_id',
			value: 'Anuncio',
			sortable: true,
			html: true,
			parser: (value) => `<span class="text-xs text-indigo-600 dark:text-indigo-300">#${value}</span>`,
		},
		{
			id: 'from_date',
			value: 'Desde',
			sortable: true,
			html: true,
			parser: (value) => {
				const d = new Date(value);
				return `<span class="text-sm text-gray-800 dark:text-gray-200">${d.toLocaleDateString()}</span>`;
			},
		},
		{
			id: 'to_date',
			value: 'Hasta',
			sortable: true,
			html: true,
			parser: (value) => {
				const d = new Date(value);
				return `<span class="text-sm text-gray-800 dark:text-gray-200">${d.toLocaleDateString()}</span>`;
			},
		},
		{
			id: 'impressions',
			value: 'Imp.',
			sortable: true,
			html: false,
		},
		{
			id: 'clicks',
			value: 'Clicks',
			sortable: true,
			html: false,
		},
		{
			id: 'leads',
			value: 'Leads',
			sortable: true,
			html: false,
		},
		{
			id: 'spend',
			value: 'Gasto',
			sortable: true,
			html: true,
			parser: (value) => `$${parseFloat(value).toFixed(2)}`,
		},
		{
			id: 'cpl',
			value: 'CPL',
			sortable: false,
			html: true,
			parser: (value, body) => {
				const cpl = body.leads > 0 ? (body.spend / body.leads).toFixed(2) : '—';
				return `<span class="inline-block px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded dark:bg-emerald-900 dark:text-emerald-200">$${cpl}</span>`;
			},
		},
	];
};



export const dataTableSort = () => {
	return {
		id: 'asc',
//DATA_TABLE_SORT//
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
        deal_ad_performance_snapshot_id: modelId,
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
        deal_ad_performance_snapshot_id: modelId,
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
        deal_ad_performance_snapshot_id: data.id,
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
