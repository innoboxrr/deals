import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-alert',
		name: "AdminDealAlerts",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAlerts',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAlert",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAlerts',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAlert",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAlerts',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAlert",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAlerts',
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