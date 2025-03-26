import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-performance-snapshot',
		name: "AdminDealPerformanceSnapshots",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealPerformanceSnapshots',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealPerformanceSnapshot",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealPerformanceSnapshots',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealPerformanceSnapshot",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealPerformanceSnapshots',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealPerformanceSnapshot",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealPerformanceSnapshots',
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