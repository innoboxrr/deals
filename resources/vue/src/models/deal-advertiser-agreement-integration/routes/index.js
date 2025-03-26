import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-agreement-integration',
		name: "AdminDealAdvertiserAgreementIntegrations",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserAgreementIntegrations',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserAgreementIntegration",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserAgreementIntegrations',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserAgreementIntegration",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserAgreementIntegrations',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserAgreementIntegration",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserAgreementIntegrations',
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