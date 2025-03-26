import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-gateway',
		name: "AdminDealGateways",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealGateways',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealGateway",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealGateways',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealGateway",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealGateways',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealGateway",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealGateways',
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