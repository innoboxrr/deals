import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-ad-campaign',
		name: "AdminDealAdCampaigns",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdCampaigns',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdCampaign",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdCampaigns',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdCampaign",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdCampaigns',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdCampaign",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdCampaigns',
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