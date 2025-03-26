import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-ad-performance-snapshot',
		name: "AdminDealAdPerformanceSnapshots",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdPerformanceSnapshots',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdPerformanceSnapshot",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdPerformanceSnapshots',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdPerformanceSnapshot",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdPerformanceSnapshots',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdPerformanceSnapshot",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdPerformanceSnapshots',
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