import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-agreement-daily',
		name: "AdminDealAdvertiserAgreementDailies",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserAgreementDailies',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserAgreementDaily",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserAgreementDailies',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserAgreementDaily",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserAgreementDailies',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserAgreementDaily",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserAgreementDailies',
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