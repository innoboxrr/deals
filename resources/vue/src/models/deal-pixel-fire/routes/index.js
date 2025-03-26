import * as middleware from '@router/middleware'

export default [
	{
		path: 'deal-pixel-fire',
		name: "AdminDealPixelFires",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'DealPixelFires',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateDealPixelFire",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear DealPixelFires',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowDealPixelFire",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver DealPixelFires',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditDealPixelFire",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar DealPixelFires',
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