import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-assignment',
		name: "AdminDealAssignments",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAssignments',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAssignment",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAssignments',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAssignment",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAssignments',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAssignment",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAssignments',
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