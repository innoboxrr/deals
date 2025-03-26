import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-product',
		name: "AdminDealProducts",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealProducts',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealProduct",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealProducts',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealProduct",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealProducts',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealProduct",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealProducts',
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