import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-router',
		name: "AdminDealRouters",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealRouters',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealRouter",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealRouters',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealRouter",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealRouters',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealRouter",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealRouters',
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