<template>
    <div v-if="dataLoaded" class="bg-gray-50 p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Resumen del Deal</h1>
            <p class="mt-2 text-gray-600">Información general y rendimiento del acuerdo configurado.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Tipo de campaña -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Configuración</h2>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><strong>Tipo:</strong> {{ deal.payload?.type }}</li>
                    <li><strong>Objetivo:</strong> {{ deal.payload?.objective }}</li>
                    <li><strong>Acceso:</strong> {{ deal.payload?.access_type }}</li>
                    <li><strong>Inicio:</strong> {{ formatDate(deal.payload?.start_date) }}</li>
                    <li><strong>Dispositivos:</strong> {{ getArray(deal.payload?.segmentation?.devices).join(', ') }}</li>
                    <li><strong>Plataformas:</strong> {{ getArray(deal.payload?.segmentation?.platforms).join(', ') }}</li>
                </ul>
            </div>

            <!-- Métricas -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Métricas esperadas</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">CTR mínimo</span>
                        <span class="text-2xl font-bold text-indigo-600">{{ deal.payload?.automation_thresholds?.min_ctr }}%</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">CPA máx.</span>
                        <span class="text-2xl font-bold text-red-600">${{ deal.payload?.automation_thresholds?.max_cpa }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">CPL máx.</span>
                        <span class="text-2xl font-bold text-red-600">${{ deal.payload?.automation_thresholds?.max_cpl }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">ROI esperado</span>
                        <span class="text-2xl font-bold text-green-600">{{ deal.payload?.hypothesis?.roi }}%</span>
                    </div>
                </div>
            </div>

            <!-- Progreso -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Progreso de Leads</h2>
                <div class="mb-4">
                    <div class="flex justify-between mb-1">
                        <i class="fa-solid fa-check text-green-500 text-base" title="Generados"></i>
                        <i class="fa-solid fa-user-slash text-gray-500 text-base" title="Rechazados"></i>
                        <i class="fa-solid fa-times text-red-500 text-base" title="No válidos"></i>
                    </div>
                    <div class="relative h-2 bg-gray-200 rounded-full">
                        <div class="absolute top-0 left-0 h-2 bg-blue-600 rounded-full" :style="`width: ${deal.payload?.last_performance_snapshot?.leads_generated || 0}%`"></div>
                    </div>
                </div>
                <div class="flex justify-around text-sm text-gray-600">
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-check text-green-500"></i>
                        {{ deal.payload?.last_performance_snapshot?.leads_generated || 0 }}
                    </div>
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-user-slash text-gray-500"></i>
                        {{ deal.payload?.last_performance_snapshot?.leads_rejected || 0 }}
                    </div>
                    <div class="flex flex-col items-center">
                        <i class="fa-solid fa-times text-red-500"></i>
                        {{ deal.payload?.last_performance_snapshot?.leads_assigned || 0 }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Segmentación</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm text-gray-600">
                <div><strong>Edad:</strong> {{ deal.payload?.segmentation?.min_age }} - {{ deal.payload?.segmentation?.max_age }}</div>
                <div><strong>Géneros:</strong> {{ getArray(deal.payload?.segmentation?.genders).join(', ') }}</div>
                <div><strong>Intereses:</strong> {{ getArray(deal.payload?.segmentation?.interests).join(', ') }}</div>
                <div><strong>Comportamientos:</strong> {{ getArray(deal.payload?.segmentation?.behaviors).join(', ') }}</div>
                <div><strong>Idiomas:</strong> {{ getArray(deal.payload?.segmentation?.languages).join(', ') }}</div>
                <div><strong>Ubicaciones:</strong> {{ getArray(deal.payload?.segmentation?.locations).join(', ') }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import { showModel } from '@dealsModels/deal'

export default {
    props: {
        deal: {
            type: Object,
            required: false,
        },
        dealId: {
            type: [Number, String],
            required: false
        }
    },
    data() {
        return {
            dataLoaded: false,
        }
    },
    created() {
        if (!this.deal && !this.dealId) {
            console.error("Se debe proporcionar 'deal' o 'dealId'.");
        }
    },
    mounted() {
        if (!this.deal && this.dealId) {
            this.fetchDeal();
        } else {
            this.dataLoaded = true;
        }
    },
    methods: {
        async fetchDeal() {
            const res = await showModel(this.dealId);
            this.deal = res;
            this.dataLoaded = true;
        },
        getArray(val) {
            try {
                return JSON.parse(val || '[]');
            } catch {
                return [];
            }
        },
        formatDate(date) {
            if (!date) return '-';
            const d = new Date(date);
            return d.toLocaleDateString('es-MX', { year: 'numeric', month: 'short', day: 'numeric' });
        }
    }
}
</script>