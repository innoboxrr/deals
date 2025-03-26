import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-advertiser',
		name: "AdminDealAdvertisers",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdvertisers',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdvertiser",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdvertisers',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdvertiser",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdvertisers',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdvertiser",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdvertisers',
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