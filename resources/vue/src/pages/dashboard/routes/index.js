export default [
	{
		path: 'dashboard',
		name: "DealsDashboard",
		component: () => import("./../layout/DashboardLayout.vue"),
		redirect: { name: "DealsDashboardHome" },
		meta: {
			title: "Deals Dashboard",
		},
		children: [
			{
				path: 'home',
				name: "DealsDashboardHome",
				component: () => import("./../views/HomeView.vue"),
			}
		]
	}
];