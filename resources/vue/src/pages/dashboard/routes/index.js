export default [
	{
		path: 'dashboard',
		name: "DealsDashboard",
		component: () => import("./../views/DashboardView.vue"),
		meta: {
			title: "Domain Manager Dashboard",
		},
	}
];