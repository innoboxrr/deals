export default [
	{
		path: 'deals-manager',
		name: "DealsManager",
		component: () => import("./../layout/DealsManagerLayout.vue"),
		redirect: { name: "DealsManagerDashboard" },
		meta: {
			title: "Deals Manager Dashboard",
		},
		children: [
			{
				path: 'dashboard',
				name: "DealsManagerDashboard",
				component: () => import("./../views/DashboardView.vue"),
			},
			{
				path: 'deal',
				name: "DealsManagerDeal",
				component: () => import("./../layout/DealLayout.vue"),
				children: [
					{
						path: 'create',
						name: "DealsManagerDealCreate",
						component: () => import("./../views/deal/CreateView.vue"),
						meta: {
							title: "Create Deal",
						},
					},
					{
						path: ':dealId',
						name: "DealsManagerDealDetails",
						component: () => import("./../views/deal/ShowView.vue"),
						meta: {
							title: "Deal Details",
						},
					},
					{
						path: ':dealId/edit',
						name: "DealsManagerDealEdit",
						component: () => import("./../views/deal/EditView.vue"),
						meta: {
							title: "Edit Deal",
						},
					},
					{
						path: ':dealId/deal-product/create',
						name: "DealsManagerDealProductCreate",
						component: () => import("./../views/deal-product/CreateView.vue"),
						meta: {
							title: "Create DealProduct",
						},
					},
					{
						path: ':dealId/deal-product/:dealProductId',
						name: "DealsManagerDealProductDetails",
						component: () => import("./../views/deal-product/ShowView.vue"),
						meta: {
							title: "DealProduct Details",
						},
					},
					{
						path: ':dealId/deal-product/:dealProductId/edit',
						name: "DealsManagerDealProductEdit",
						component: () => import("./../views/deal-product/EditView.vue"),
						meta: {
							title: "Edit DealProduct",
						},
					}
				]
			},
		]
	}
];