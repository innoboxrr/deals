import { redirect } from "innoboxrr-js-libs/libs/http";

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
				path: 'advertiser',
				name: "DealsAdvertisersManagerAdvertiserLayout",
				component: () => import("./../layout/AdvertiserLayout.vue"),
				children: [
					{
						path: 'create',
						name: "DealsAdvertisersManagerAdvertiserCreate",
						component: () => import("./../views/deal-advertiser/CreateView.vue"),
					},
					{
						path: ':advertiserId',
						name: "DealsAdvertisersManagerAdvertiserShow",
						component: () => import("./../views/deal-advertiser/ShowView.vue"),
					},
					{
						path: ':advertiserId/edit',
						name: "DealsAdvertisersManagerAdvertiserEdit",
						component: () => import("./../views/deal-advertiser/EditView.vue"),
					},
					{
						path: ':advertiserId/agreements',
						name: "DealsAdvertisersManagerAgreementLayout",
						redirect: { name: "DealsAdvertisersManagerAgreementIndex" },
						component: () => import("./../layout/AgreementLayout.vue"),
						children: [
							{
								path: 'index',
								name: "DealsAdvertisersManagerAgreementIndex",
								component: () => import("./../views/deal-advertiser-agreement/IndexView.vue"),
							},
							{
								path: 'create',
								name: "DealsAdvertisersManagerAgreementCreate",
								component: () => import("./../views/deal-advertiser-agreement/CreateView.vue"),
							},
							{
								path: ':agreementId',
								name: "DealsAdvertisersManagerAgreementShow",
								component: () => import("./../views/deal-advertiser-agreement/ShowView.vue"),
							},
							{
								path: ':agreementId/edit',
								name: "DealsAdvertisersManagerAgreementEdit",
								component: () => import("./../views/deal-advertiser-agreement/EditView.vue"),
							},
						]
					}
				]
			},
		]
	}
];