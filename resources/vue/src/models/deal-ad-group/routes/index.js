import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-ad-group',
		name: "AdminDealAdGroups",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdGroups',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdGroup",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdGroups',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdGroup",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdGroups',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdGroup",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdGroups',
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