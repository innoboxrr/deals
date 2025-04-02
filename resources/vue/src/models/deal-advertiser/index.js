import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.deals.deal_advertiser.'; // Reemplaza con la ruta adecuada

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
			callback: 'createDealAdvertiser',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateDealAdvertiser',
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
            id: 'agent_name',
            value: 'Agente',
            sortable: false,
            html: true,
            parser: (_, body) => {
                const user = body.agent?.user;
                if (!user) return `<span class="text-sm text-gray-500">Sin asignar</span>`;
                return `
                    <div class="flex items-center space-x-2">
                        <img src="${user.avatar || 'https://via.placeholder.com/32'}" alt="${user.name}" class="w-6 h-6 rounded-full object-cover" />
                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">${user.name}</span>
                    </div>
                `;
            }
        },
        {
            id: 'contact',
            value: 'Contacto',
            sortable: false,
            html: true,
            parser: (_, body) => {
                const user = body.agent?.user || {};
                return `
                    <div class="text-sm leading-snug text-gray-700 dark:text-gray-300 space-y-0.5">
                        <p><strong>Email:</strong> ${user.email || '—'}</p>
                        <p><strong>Tel:</strong> ${user.phone || '—'}</p>
                        <p><strong>WhatsApp:</strong> ${user.whatsapp || '—'}</p>
                    </div>
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
                    pending: 'bg-yellow-200 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100',
                    active: 'bg-green-200 text-green-800 dark:bg-green-700 dark:text-green-200',
                    rejected: 'bg-red-200 text-red-800 dark:bg-red-700 dark:text-red-100',
                    inactive: 'bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-200'
                };
                const className = statusColors[value] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                return `<span class="px-2 py-1 rounded text-xs font-medium ${className}">${value}</span>`;
            }
        },
        {
            id: 'notes',
            value: 'Notas',
            sortable: false,
            html: true,
            parser: (_, body) => {
                const notes = body.payload?.notes || '';
                const short = notes.length > 30 ? notes.slice(0, 30) + '…' : notes;
                return `<p class="text-xs text-gray-600 dark:text-gray-300 leading-snug">${short}</p>`;
            }
        }
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
        deal_advertiser_id: modelId,
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
        deal_advertiser_id: modelId,
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
        deal_advertiser_id: data.id,
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
