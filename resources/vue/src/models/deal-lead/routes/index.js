import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-lead',
		name: "AdminDealLeads",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealLeads',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealLead",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealLeads',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealLead",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealLeads',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealLead",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealLeads',
							middleware: [
								middleware.auth
							]
						}
					},
				]
			},
		]
	},
]