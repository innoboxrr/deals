export default [
	{
		path: 'leads-manager',
		name: "DealsLeadsManager",
		component: () => import("./../layout/LeadsManagerLayout.vue"),
		redirect: { name: "DealsLeadsManagerLeads" },
		meta: {
			title: "Leads Manager Dashboard",
		},
		children: [
			{
				path: 'leads',
				name: "DealsLeadsManagerLeads",
				component: () => import("./../views/LeadsView.vue"),
			}
		]
	}
];