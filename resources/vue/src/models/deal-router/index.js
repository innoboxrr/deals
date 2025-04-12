import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_router.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealRouter',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealRouter',
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
			id: 'last_run',
			value: 'Última Ejecución',
			sortable: true,
			html: true,
			parser: (value) => {
				if (!value) return `<span class="text-gray-400 italic">Nunca</span>`;
				return `<span class="text-sm text-gray-700 dark:text-gray-300">${new Date(value).toLocaleString()}</span>`;
			},
		},
		{
			id: 'queue',
			value: 'Cola',
			sortable: true,
			html: true,
			parser: (value) => {
				return `<span class="px-2 py-1 text-xs font-medium text-orange-800 bg-orange-100 rounded dark:bg-orange-900 dark:text-orange-300">${value}</span>`;
			},
		},
		{
			id: 'deal_id',
			value: 'Deal',
			sortable: true,
			html: true,
			parser: (value) => {
				return `<span class="px-2 py-1 text-xs font-medium text-cyan-800 bg-cyan-100 rounded dark:bg-cyan-900 dark:text-cyan-300">${value}</span>`;
			},
		},
	];
};


export const dataTableSort = () => {
	return {
		id: 'asc',
        last_run: 'desc',
        queue: 'asc',
        deal_id: 'asc',
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
        deal_router_id: modelId,
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
        deal_router_id: modelId,
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
        deal_router_id: data.id,
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
