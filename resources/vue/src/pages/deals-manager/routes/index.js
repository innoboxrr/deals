export default [
	{
		path: 'deals-manager',
		name: "DealsManager",
		component: () => import("./../layout/DealsManagerLayout.vue"),
		redirect: { name: "DealsManagerDeals" },
		meta: {
			title: "Deals Manager Dashboard",
		},
		children: [
			{
				path: 'deals',
				name: "DealsManagerDeals",
				component: () => import("./../views/DealsView.vue"),
			}
		]
	}
];