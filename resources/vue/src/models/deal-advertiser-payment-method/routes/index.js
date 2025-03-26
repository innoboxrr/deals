import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-payment-method',
		name: "AdminDealAdvertiserPaymentMethods",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserPaymentMethods',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserPaymentMethod",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserPaymentMethods',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserPaymentMethod",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserPaymentMethods',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserPaymentMethod",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserPaymentMethods',
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