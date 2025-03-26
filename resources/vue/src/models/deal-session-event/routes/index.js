import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-session-event',
		name: "AdminDealSessionEvents",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealSessionEvents',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealSessionEvent",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealSessionEvents',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealSessionEvent",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealSessionEvents',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealSessionEvent",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealSessionEvents',
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