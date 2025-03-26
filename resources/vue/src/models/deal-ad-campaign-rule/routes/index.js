import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-ad-campaign-rule',
		name: "AdminDealAdCampaignRules",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdCampaignRules',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdCampaignRule",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdCampaignRules',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdCampaignRule",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdCampaignRules',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdCampaignRule",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdCampaignRules',
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