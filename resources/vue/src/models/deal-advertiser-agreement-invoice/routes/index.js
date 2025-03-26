import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-agreement-invoice',
		name: "AdminDealAdvertiserAgreementInvoices",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserAgreementInvoices',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserAgreementInvoice",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserAgreementInvoices',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserAgreementInvoice",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserAgreementInvoices',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserAgreementInvoice",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserAgreementInvoices',
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