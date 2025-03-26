import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-agreement-cpl-adjustment',
		name: "AdminDealAdvertiserAgreementCplAdjustments",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserAgreementCplAdjustments',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserAgreementCplAdjustment",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserAgreementCplAdjustments',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserAgreementCplAdjustment",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserAgreementCplAdjustments',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserAgreementCplAdjustment",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserAgreementCplAdjustments',
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