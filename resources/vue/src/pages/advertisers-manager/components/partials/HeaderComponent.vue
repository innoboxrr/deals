<template>
    <section class="flex items-center bg-gray-50 dark:bg-gray-900">
		<div class="w-full">
			<div class="relative dark:bg-gray-800 border-b">
				<div class="px-4 divide-y dark:divide-gray-700">
					<div class="flex items-center justify-between py-3">
						<div class="flex items-center flex-1 space-x-2">
							<h5 class="font-semibold dark:text-white">
								{{ headerTitle }}
							</h5>
						</div>
						<div class="flex items-center gap-4 justify-between sm:justify-end">
							<Menu as="div" class="relative inline-block text-left">
								<div>
									<MenuButton class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
										<span class="hidden sm:inline">
											{{ __deals("Global Actions") }}
										</span>
										<span class="sm:hidden">
											{{ __deals("Actions") }}
										</span>
										<ChevronDownIcon
											class="-mr-1 h-5 w-5 text-gray-400"
											aria-hidden="true" />
									</MenuButton>
								</div>
								<transition
									enter-active-class="transition ease-out duration-100"
									enter-from-class="transform opacity-0 scale-95"
									enter-to-class="transform opacity-100 scale-100"
									leave-active-class="transition ease-in duration-75"
									leave-from-class="transform opacity-100 scale-100"
									leave-to-class="transform opacity-0 scale-95">
									<MenuItems class="z-[9999] absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
										<div class="py-1">
											<MenuItem v-slot="{ active, close }">
												<a
													href="#"
													@click.prevent="
														close();
														$router.push({ name: 'DealsAdvertisersManager' });
													"
													:class="[
														active
															? 'bg-gray-100 text-gray-900'
															: 'text-gray-700',
														'block px-4 py-2 text-sm',
													]">
													<i class="fa-solid fa-user-group mr-2"></i>
													{{ __deals("Advertisers") }}
												</a>
											</MenuItem>
											<MenuItem v-slot="{ active, close }">
												<a
													href="#"
													@click.prevent="
														close();
														$router.push({ name: 'DealsAdvertisersManagerAdvertiserCreate' });
													"
													:class="[
														active
															? 'bg-gray-100 text-gray-900'
															: 'text-gray-700',
														'block px-4 py-2 text-sm',
													]">
													<i class="fa-solid fa-plus mr-2"></i>
													{{ __deals("Create Advertiser") }}
												</a>
											</MenuItem>
											<MenuItem 
												v-if="dealAdvertiserId"
												v-slot="{ active, close }">
												<a
													href="#"
													@click.prevent="
														close();
														$router.push({ 
															name: 'DealsAdvertisersManagerAdvertiserEdit',
															params: { 
																advertiserId: dealAdvertiserId 
															}
														});
													"
													:class="[
														active
															? 'bg-gray-100 text-gray-900'
															: 'text-gray-700',
														'block px-4 py-2 text-sm',
													]">
													<i class="fa-solid fa-pen-to-square mr-2"></i>
													{{ __deals("Edit Advertiser") }}
												</a>
											</MenuItem>
											<MenuItem 
												v-if="dealAdvertiserId"
												v-slot="{ active, close }">
												<a
													href="#"
													@click.prevent="
														close();
														$router.push({ 
															name: 'DealsAdvertisersManagerAdvertiserShow',
															params: { 
																advertiserId: dealAdvertiserId 
															}
														});
													"
													:class="[
														active
															? 'bg-gray-100 text-gray-900'
															: 'text-gray-700',
														'block px-4 py-2 text-sm',
													]">
													<i class="fa-solid fa-eye mr-2"></i>
													{{ __deals("Show Advertiser") }}
												</a>
											</MenuItem>
										</div>
									</MenuItems>
								</transition>
							</Menu>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</template>

<script>
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { useAdvertisersManagerStore } from "@dealsPages/advertisers-manager/store/advertisersManagerStore.js";

export default {
	name: "HeaderComponent",
	components: {
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		ChevronDownIcon,
	},
	setup() {
		const advertisersManagerStore = useAdvertisersManagerStore();
		return {
			advertisersManagerStore,
		};
	},
	computed: {
		headerTitle() {
			return this.advertisersManagerStore.headerTitle;
		},
		dealAdvertiserId() {
			return this.advertisersManagerStore.dealAdvertiserId;
		}
	},
};
</script>
