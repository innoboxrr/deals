<template>
	<div>
		<header-component />
		<router-view />
	</div>
</template>

<script>
import HeaderComponent from "@dealsPages/advertisers-manager/components/partials/HeaderComponent.vue";

export default {
	name: "AdvertisersManagerLayout",
	components: {
		HeaderComponent,
	},
};
</script>
