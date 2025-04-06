export default [
	{
		path: 'advertisers-manager',
		name: "DealsAdvertisersManager",
		component: () => import("./../layout/AdvertisersManagerLayout.vue"),
		redirect: { name: "DealsAdvertisersManagerDashboard" },
		meta: {
			title: "Advertisers Manager Dashboard",
		},
		children: [
			{
				path: 'dashboard',
				name: "DealsAdvertisersManagerDashboard",
				component: () => import("./../views/DashboardView.vue"),
			},
			{
				path: 'create',
				name: "DealsAdvertisersManagerCreate",
				component: () => import("./../views/CreateView.vue"),
			},
			{
				path: ':advertiserId',
				name: "DealsAdvertisersManagerAdvertiser",
				component: () => import("./../views/AdvertiserView.vue"),
				children: [
					{
						path: 'edit',
						name: "DealsAdvertisersManagerEdit",
						component: () => import("./../views/EditView.vue"),
					}
				]
			},
		]
	}
];