import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-ad-platform',
		name: "AdminDealAdPlatforms",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealAdPlatforms',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealAdPlatform",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealAdPlatforms',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealAdPlatform",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealAdPlatforms',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealAdPlatform",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealAdPlatforms',
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