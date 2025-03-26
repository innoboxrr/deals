import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser-agreement-constraint',
		name: "AdminDealAdvertiserAgreementConstraints",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertiserAgreementConstraints',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiserAgreementConstraint",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertiserAgreementConstraints',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiserAgreementConstraint",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertiserAgreementConstraints',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiserAgreementConstraint",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertiserAgreementConstraints',
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