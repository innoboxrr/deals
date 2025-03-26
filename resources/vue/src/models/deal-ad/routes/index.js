import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-ad',
		name: "AdminDealAds",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAds',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAd",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAds',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAd",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAds',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAd",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAds',
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