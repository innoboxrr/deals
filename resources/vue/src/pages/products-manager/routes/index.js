export default [
	{
		path: 'products-manager',
		name: "DealsProductsManager",
		component: () => import("./../layout/ProductsManagerLayout.vue"),
		redirect: { name: "DealsProductsManagerDashboard" },
		meta: {
			title: "Deals Manager Dashboard",
		},
		children: [
			{
				path: 'dashboard',
				name: "DealsProductsManagerDashboard",
				component: () => import("./../views/DashboardView.vue"),
			},
			{
				path: 'showcase',
				name: "DealsProductsManagerShowcase",
				component: () => import("./../views/ShowcaseView.vue"),
			},
			{
				path: 'create',
				name: "DealsProductsManagerCreate",
				component: () => import("./../views/CreateView.vue"),
			}
		]
	}
];