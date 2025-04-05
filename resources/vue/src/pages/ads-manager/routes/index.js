// Rutas para el modelo Ad
const adRoutes = [
    {
        path: 'ad/:adId',
        name: 'DealsAdsManagerAdsAdView',
        component: () => import("./../views/AdView.vue")
    },
    {
        path: 'ad/create',
        name: 'DealsAdsManagerAdsAdCreate',
        component: () => import("./../views/AdCreateView.vue")
    },
    {
        path: 'ad/:adId/edit',
        name: 'DealsAdsManagerAdsAdEdit',
        component: () => import("./../views/AdEditView.vue")
    },
    {
        path: 'ad/:adId/delete',
        name: 'DealsAdsManagerAdsAdDelete',
        component: () => import("./../views/AdDeleteConfirmView.vue")
    }
];

// Rutas para el modelo Ad Group
const adGroupRoutes = [
    {
        path: 'ad-group/:adGroupId',
        name: 'DealsAdsManagerAdsAdGroupView',
        component: () => import("./../views/AdGroupView.vue"),
        children: adRoutes
    },
    {
        path: 'ad-group/create',
        name: 'DealsAdsManagerAdsAdGroupCreate',
        component: () => import("./../views/AdGroupCreateView.vue")
    },
    {
        path: 'ad-group/:adGroupId/edit',
        name: 'DealsAdsManagerAdsAdGroupEdit',
        component: () => import("./../views/AdGroupEditView.vue")
    },
    {
        path: 'ad-group/:adGroupId/delete',
        name: 'DealsAdsManagerAdsAdGroupDelete',
        component: () => import("./../views/AdGroupDeleteConfirmView.vue")
    }
];

// Rutas para el modelo Campaign
const campaignRoutes = [
    {
        path: 'campaign/:campaignId',
        name: 'DealsAdsManagerAdsCampaignView',
        component: () => import("./../views/CampaignView.vue"),
        children: adGroupRoutes
    },
    {
        path: 'campaign/create',
        name: 'DealsAdsManagerAdsCampaignCreate',
        component: () => import("./../views/CampaignCreateView.vue")
    },
    {
        path: 'campaign/:campaignId/edit',
        name: 'DealsAdsManagerAdsCampaignEdit',
        component: () => import("./../views/CampaignEditView.vue")
    },
    {
        path: 'campaign/:campaignId/delete',
        name: 'DealsAdsManagerAdsCampaignDelete',
        component: () => import("./../views/CampaignDeleteConfirmView.vue")
    }
];

// Rutas para el modelo Platform
const platformRoutes = [
    {
        path: 'platform/:platformId',
        name: 'DealsAdsManagerAdsPlatformView',
        component: () => import("./../views/PlatformView.vue"),
        children: campaignRoutes
    },
    {
        path: 'platform/create',
        name: 'DealsAdsManagerAdsPlatformCreate',
        component: () => import("./../views/PlatformCreateView.vue")
    },
    {
        path: 'platform/:platformId/edit',
        name: 'DealsAdsManagerAdsPlatformEdit',
        component: () => import("./../views/PlatformEditView.vue")
    },
    {
        path: 'platform/:platformId/delete',
        name: 'DealsAdsManagerAdsPlatformDelete',
        component: () => import("./../views/PlatformDeleteConfirmView.vue")
    }
];

// Rutas para el modelo Deal
const dealRoutes = [
    {
        path: 'deal/:dealId',
        name: 'DealsAdsManagerAdsDealView',
        component: () => import("./../views/DealView.vue"),
        children: platformRoutes
    },
];

export default [
    {
        path: 'ads-manager',
        name: "DealsAdsManager",
        component: () => import("./../layout/AdsManagerLayout.vue"),
        redirect: { name: "DealsAdsManagerAds" },
        meta: {
            title: "Ads Manager Dashboard",
        },
        children: [
            {
                path: 'ads',
                name: "DealsAdsManagerAds",
                component: () => import("./../views/AdsView.vue"),
                children: dealRoutes 
            }
        ]
    }
];
