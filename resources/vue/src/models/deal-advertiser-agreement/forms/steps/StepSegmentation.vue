<template>
    <div class="space-y-6">

        <!-- AGE & GENDER -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.age = !collapsed.age">
                <span class="text-sm font-semibold">Age & Gender</span>
                <i :class="['fa-solid', collapsed.age ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.age" class="p-4 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<text-input-component
							:custom-class="inputClass"
							type="number"
							name="min_age"
							label="Minimum age"
							validators="integer"
							v-model="localAgreement.payload.segmentation.min_age" />
					</div>
					<div>
						<text-input-component
							:custom-class="inputClass"
							type="number"
							name="max_age"
							label="Maximum age"
							validators="integer"
							v-model="localAgreement.payload.segmentation.max_age" />
					</div>
                </div>

                <select-input-component
					class="uk-margin-remove"
                    :custom-class="inputClass"
                    name="genders"
                    label="Genders"
                    multiple
                    v-model="localAgreement.payload.segmentation.genders">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select-input-component>
            </div>
        </div>

        <!-- PLATFORM & DEVICE -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.platform = !collapsed.platform">
                <span class="text-sm font-semibold">Platforms & Devices</span>
                <i :class="['fa-solid', collapsed.platform ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.platform" class="p-4 space-y-4">
                <select-input-component
                    :custom-class="inputClass"
                    name="platforms"
                    label="Platforms"
                    multiple
                    v-model="localAgreement.payload.segmentation.platforms">
                    <option value="facebook">Facebook</option>
                    <option value="google">Google</option>
                    <option value="instagram">Instagram</option>
                    <option value="tiktok">TikTok</option>
                    <option value="youtube">YouTube</option>
                </select-input-component>

                <select-input-component
                    :custom-class="inputClass"
                    name="devices"
                    label="Devices"
                    multiple
                    v-model="localAgreement.payload.segmentation.devices">
                    <option value="mobile">Mobile</option>
                    <option value="desktop">Desktop</option>
                    <option value="tablet">Tablet</option>
                </select-input-component>
            </div>
        </div>

        <!-- LOCATION & INTERESTS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.location = !collapsed.location">
                <span class="text-sm font-semibold">Location & Interests</span>
                <i :class="['fa-solid', collapsed.location ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.location" class="p-4 space-y-4">
                <tags-input-component
                    :custom-class="inputClass"
                    name="interests"
                    label="Interests"
                    placeholder="E.g. tech, health, travel"
                    v-model="localAgreement.payload.segmentation.interests" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="states"
                    label="Included States"
                    placeholder="E.g. California, Bogotá"
                    v-model="localAgreement.payload.segmentation.states" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="excluded_states"
                    label="Excluded States"
                    placeholder="E.g. Texas, Veracruz"
                    v-model="localAgreement.payload.segmentation.excluded_states" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="counties"
                    label="Included Counties"
                    placeholder="E.g. Orange County"
                    v-model="localAgreement.payload.segmentation.counties" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="excluded_counties"
                    label="Excluded Counties"
                    placeholder="E.g. Kings County"
                    v-model="localAgreement.payload.segmentation.excluded_counties" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="postal_codes"
                    label="Included Postal Codes"
                    placeholder="E.g. 90210, 10001"
                    v-model="localAgreement.payload.segmentation.postal_codes" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="excluded_postal_codes"
                    label="Excluded Postal Codes"
                    placeholder="E.g. 30301, 33101"
                    v-model="localAgreement.payload.segmentation.excluded_postal_codes" />
            </div>
        </div>

        <!-- ADVANCED FILTERS -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.advanced = !collapsed.advanced">
                <span class="text-sm font-semibold">Advanced Filters</span>
                <i :class="['fa-solid', collapsed.advanced ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.advanced" class="p-4 space-y-4">
                <tags-input-component
                    :custom-class="inputClass"
                    name="included_domains"
                    label="Included Email Domains"
                    placeholder="E.g. gmail.com, company.com"
                    v-model="localAgreement.payload.segmentation.included_domains" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="excluded_domains"
                    label="Excluded Email Domains"
                    placeholder="E.g. hotmail.com"
                    v-model="localAgreement.payload.segmentation.excluded_domains" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="phone_start"
                    label="Phone Starts With"
                    placeholder="E.g. +52, 55"
                    v-model="localAgreement.payload.segmentation.phone_start" />

                <tags-input-component
                    :custom-class="inputClass"
                    name="phone_end"
                    label="Phone Ends With"
                    placeholder="E.g. 9999"
                    v-model="localAgreement.payload.segmentation.phone_end" />
            </div>
        </div>
    </div>
</template>

<script>
import {
    TextInputComponent,
    SelectInputComponent,
    TagsInputComponent
} from 'innoboxrr-form-elements'

export default {
    name: 'StepSegmentation',
    components: {
        TextInputComponent,
        SelectInputComponent,
        TagsInputComponent
    },
    props: {
        modelValue: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            collapsed: {
                age: false,
                platform: true,
                location: true,
                advanced: true
            }
        }
    },
    computed: {
        localAgreement: {
            get() {
                return this.modelValue
            },
            set(val) {
                this.$emit('update:modelValue', val)
            }
        }
    },
    watch: {
        localAgreement: {
            handler(val) {
                const seg = val.payload?.segmentation
                const valid = !!(
                    seg?.min_age || seg?.max_age || seg?.genders?.length ||
                    seg?.platforms?.length || seg?.devices?.length || seg?.interests?.length ||
                    seg?.states?.length || seg?.excluded_states?.length ||
                    seg?.counties?.length || seg?.excluded_counties?.length ||
                    seg?.postal_codes?.length || seg?.excluded_postal_codes?.length ||
                    seg?.included_domains?.length || seg?.excluded_domains?.length ||
                    seg?.phone_start?.length || seg?.phone_end?.length
                )
                this.$emit('validated', valid)
            },
            deep: true,
            immediate: true
        }
    }
}
</script>