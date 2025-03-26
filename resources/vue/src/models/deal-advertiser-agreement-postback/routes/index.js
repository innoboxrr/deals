import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-agreement-postback',
		name: "AdminDealAdvertiserAgreementPostbacks",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserAgreementPostbacks',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserAgreementPostback",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserAgreementPostbacks',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserAgreementPostback",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserAgreementPostbacks',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserAgreementPostback",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserAgreementPostbacks',
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