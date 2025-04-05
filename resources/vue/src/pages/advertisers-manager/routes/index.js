export default [
	{
		path: 'advertisers-manager',
		name: "DealsAdvertisersManager",
		component: () => import("./../layout/AdvertisersManagerLayout.vue"),
		redirect: { name: "DealsAdvertisersManagerAdvertisers" },
		meta: {
			title: "Advertisers Manager Dashboard",
		},
		children: [
			{
				path: 'advertisers',
				name: "DealsAdvertisersManagerAdvertisers",
				component: () => import("./../views/AdvertisersView.vue"),
			}
		]
	}
];