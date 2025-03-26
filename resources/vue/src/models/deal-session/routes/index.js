import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-session',
		name: "AdminDealSessions",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealSessions',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealSession",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealSessions',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealSession",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealSessions',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealSession",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealSessions',
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