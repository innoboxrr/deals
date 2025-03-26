import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-router-execution',
		name: "AdminDealRouterExecutions",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealRouterExecutions',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealRouterExecution",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealRouterExecutions',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealRouterExecution",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealRouterExecutions',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealRouterExecution",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealRouterExecutions',
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