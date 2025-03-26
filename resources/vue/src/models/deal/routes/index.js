import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal',
		name: "AdminDeals",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'Deals',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDeal",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear Deals',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDeal",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver Deals',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDeal",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar Deals',
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