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
				name: "DealsAdvertisersManagerShow",
				component: () => import("./../views/ShowView.vue"),
			},
			{
				path: ':advertiserId/edit',
				name: "DealsAdvertisersManagerEdit",
				component: () => import("./../views/EditView.vue"),
			},
		]
	}
];