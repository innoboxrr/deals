export default [
	{
		path: 'products-manager',
		name: "DealsProductsManager",
		component: () => import("./../layout/ProductsManagerLayout.vue"),
		redirect: { name: "DealsProductsManagerShowcase" },
		meta: {
			title: "Deals Manager Dashboard",
		},
		children: [
			{
				path: 'showcase',
				name: "DealsProductsManagerShowcase",
				component: () => import("./../views/ShowcaseView.vue"),
			},
		]
	}
];