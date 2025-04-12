import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDeal',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDeal',
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
            id: 'name',
            value: 'Nombre',
            sortable: true,
            html: false,
        },
        {
            id: 'description',
            value: 'Descripción',
            sortable: false,
            html: true,
            parser: (value) => {
                const shortText = value?.length > 70 ? value.substring(0, 70) + '…' : value;
                return `
                    <p class="text-gray-700 dark:text-gray-300 text-sm leading-snug">
                        ${shortText}
                    </p>
                `;
            }
        },
        {
            id: 'status',
            value: 'Estado',
            sortable: true,
            html: true,
            parser: (value) => {
                const statusColors = {
                    draft: 'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                    waiting_for_advertisers: 'bg-yellow-200 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-200',
                    queued: 'bg-blue-200 text-blue-800 dark:bg-blue-700 dark:text-blue-200',
                    active: 'bg-green-200 text-green-800 dark:bg-green-700 dark:text-green-200',
                    paused: 'bg-red-200 text-red-800 dark:bg-red-700 dark:text-red-200',
                    completed: 'bg-gray-300 text-gray-900 dark:bg-gray-600 dark:text-gray-100'
                };
    
                const className = statusColors[value] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
    
                return `<span class="px-2 py-1 rounded text-xs font-medium ${className}">${value.replace(/_/g, ' ')}</span>`;
            }
        },
        {
            id: 'advertisers',
            value: 'Anunciantes',
            sortable: false,
            html: true,
            parser: (_, body) => {
                const { min_advertisers_required, max_advertisers_allowed, current_advertisers_count } = body.payload;
                const max = max_advertisers_allowed === 0 ? '∞' : max_advertisers_allowed;
                return `
                    <span class="text-sm text-gray-800 dark:text-gray-300 font-medium">
                        ${current_advertisers_count}/${min_advertisers_required} / ${max}
                    </span>
                `;
            }
        },
        {
            id: 'cpl',
            value: 'CPL Estimado',
            sortable: true,
            html: true,
            parser: (_, body) => {
                const value = body.payload.cpl_estimated;
                return `
                    <span class="text-sm font-semibold text-indigo-700 dark:text-indigo-400">
                        $${value?.toFixed(2) ?? '0.00'}
                    </span>
                `;
            }
        }
    ];
};

export const dataTableSort = () => {
	return {
		id: 'asc',
        name: 'asc',
        status: 'asc',
        advertisers: 'asc',
        cpl: 'asc',
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
        deal_id: modelId,
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
        deal_id: modelId,
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
        deal_id: data.id,
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
