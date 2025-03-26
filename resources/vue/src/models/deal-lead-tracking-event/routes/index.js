import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-lead-tracking-event',
		name: "AdminDealLeadTrackingEvents",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealLeadTrackingEvents',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealLeadTrackingEvent",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealLeadTrackingEvents',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealLeadTrackingEvent",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealLeadTrackingEvents',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealLeadTrackingEvent",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealLeadTrackingEvents',
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