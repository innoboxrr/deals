<template>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <header class="border-b border-gray-200 bg-white px-8 py-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Deal #{{ $route.params.dealId }}
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Gestiona toda la información, producto y métricas relacionadas con este Deal.
                    </p>
                </div>
                <div>
                    <button
                        type="button"
                        @click="togglePause"
                        :class="btnClass">
                        <span v-if="isPaused">
                            <i class="fas fa-play mr-2"></i>
                            Activar 
                        </span>
                        <span v-else>
                            <i class="fas fa-pause mr-2"></i>
                            Detener todo
                        </span>
                    </button>
                </div>
            </div>
        </header>

        <main class="flex-1 p-8 space-y-8">
            <div v-if="isDetailView" class="space-y-8">

                <!-- FILTROS Y CONTROLES PRINCIPALES -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Filtros y Controles
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Filtro por fecha/rango -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="dateRange">Rango de Fechas</label>
                            <input
                                id="dateRange"
                                type="date"
                                v-model="filters.dateRange"
                                class="block w-full border border-gray-300 rounded p-2"
                            />
                        </div>
                        <!-- Filtro por estado de la campaña -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="campaignStatus">Estado de Campaña</label>
                            <select
                                id="campaignStatus"
                                v-model="filters.campaignStatus"
                                class="block w-full border border-gray-300 rounded p-2"
                            >
                                <option value="">Todos</option>
                                <option value="active">Activa</option>
                                <option value="paused">Pausada</option>
                                <option value="completed">Finalizada</option>
                            </select>
                        </div>
                        <!-- Botón de búsqueda o actualización -->
                        <div class="flex items-end">
                            <button
                                @click="applyFilters"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </section>

                <!-- FICHA DEL PRODUCTO -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Ficha del Producto
                    </h2>
                    <div class="flex items-center">
                        <img
                            :src="dealProduct.imageUrl || 'https://via.placeholder.com/100'"
                            alt="Imagen del Producto"
                            class="w-24 h-24 object-cover rounded-md mr-6 border"
                        />
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                {{ dealProduct.name }}
                            </h3>
                            <p class="text-gray-500">
                                {{ dealProduct.category }}
                            </p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-700">
                        {{ dealProduct.description }}
                    </p>
                </section>

                <!-- RESUMEN DE MÉTRICAS (STATISTICS CARDS) -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Resumen de Métricas
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Ejemplo de tarjetas de estadísticas -->
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-indigo-600">
                                {{ stats.clicks }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Clicks
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-green-600">
                                {{ stats.conversions }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Conversiones
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-yellow-600">
                                {{ stats.ctr }}%
                            </p>
                            <p class="text-sm text-gray-600">
                                CTR
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-red-600">
                                ${{ stats.roi }}
                            </p>
                            <p class="text-sm text-gray-600">
                                ROI
                            </p>
                        </div>
                    </div>
                </section>

                <!-- RESUMEN DE DESEMPEÑO DE LA PUBLICACIÓN -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Resumen de Desempeño de la Publicación
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                Interacciones
                            </h3>
                            <p class="text-gray-700">
                                Me Gusta: {{ publicationPerformance.likes }} <br>
                                Comentarios: {{ publicationPerformance.comments }} <br>
                                Compartidos: {{ publicationPerformance.shares }}
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                Alcance
                            </h3>
                            <p class="text-gray-700">
                                Impresiones: {{ publicationPerformance.impressions }} <br>
                                Usuarios Únicos: {{ publicationPerformance.uniqueUsers }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- DISTRIBUCIÓN DE LEADS -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Distribución de Leads
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-blue-600">
                                {{ leadsDistribution.new }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Nuevos
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-purple-600">
                                {{ leadsDistribution.contacted }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Contactados
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-3xl font-bold text-teal-600">
                                {{ leadsDistribution.converted }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Convertidos
                            </p>
                        </div>
                    </div>
                </section>

                <!-- ESTADO DE LAS QUEUES DE DISTRIBUCIÓN -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Estado de las Queues de Distribución
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                Queue de Emails
                            </h3>
                            <p class="text-gray-700">
                                Procesados: {{ distributionQueues.emails.processed }} <br>
                                Pendientes: {{ distributionQueues.emails.pending }}
                            </p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                Queue de SMS
                            </h3>
                            <p class="text-gray-700">
                                Procesados: {{ distributionQueues.sms.processed }} <br>
                                Pendientes: {{ distributionQueues.sms.pending }}
                            </p>
                        </div>
                    </div>
                </section>

                <!-- TABLA DE LEADS (LISTADO) -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Listado de Leads
                    </h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nombre
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Fecha de Creación
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="lead in leads" :key="lead.id">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.email }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.status }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ lead.createdAt }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- GRÁFICO DE AUDIENCIA E INTERESES -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Audiencia e Intereses
                    </h2>
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded">
                        <!-- Aquí iría tu componente de gráfico interactivo o un canvas -->
                        <p class="text-gray-500">Gráfico de Audiencia/Intereses (placeholder)</p>
                    </div>
                </section>

                <!-- ACTIVIDAD RECIENTE O LOG -->
                <section class="bg-white border rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">
                        Actividad Reciente
                    </h2>
                    <ul class="space-y-2">
                        <li
                            v-for="(activity, index) in recentActivity"
                            :key="index"
                            class="bg-gray-50 p-3 rounded"
                        >
                            <p class="text-sm text-gray-700">
                                {{ activity.timestamp }} - {{ activity.description }}
                            </p>
                        </li>
                    </ul>
                </section>

            </div>
            
            <router-view />
        </main>
    </div>
</template>

<script>
export default {
    name: "DealView",
    data() {
        return {
            // Simulación de datos del producto
            // En producción, obtendrás estos datos mediante una llamada a la API usando $route.params.dealId
            isPaused: false,
            dealProduct: {
                name: "Producto Promocionado XYZ",
                description:
                    "Este producto se promociona en el Deal, definiendo comportamientos, intereses y la audiencia objetivo. Diseñado para maximizar conversiones.",
                category: "Electrónica",
                imageUrl: "" // Podrías poner un link real o uno de tu CDN
            },
            filters: {
                dateRange: '',
                campaignStatus: ''
            },
            dealProduct: {
                name: 'Producto Demo',
                category: 'Categoría X',
                description: 'Descripción breve del producto',
                imageUrl: ''
            },
            stats: {
                clicks: 1234,
                conversions: 567,
                ctr: 89,
                roi: 1234
            },
            publicationPerformance: {
                likes: 100,
                comments: 20,
                shares: 10,
                impressions: 3000,
                uniqueUsers: 2500
            },
            leadsDistribution: {
                new: 350,
                contacted: 120,
                converted: 75
            },
            distributionQueues: {
                emails: {
                    processed: 500,
                    pending: 50
                },
                sms: {
                    processed: 300,
                    pending: 20
                }
            },
            leads: [
                { id: 1, name: 'Juan Pérez', email: 'juan@example.com', status: 'Nuevo', createdAt: '2025-03-01' },
                { id: 2, name: 'María López', email: 'maria@example.com', status: 'Contactado', createdAt: '2025-03-02' },
                { id: 3, name: 'Carlos Ruiz', email: 'carlos@example.com', status: 'Convertido', createdAt: '2025-03-03' }
            ],
            recentActivity: [
                { timestamp: '2025-03-04 10:00', description: 'Se creó un nuevo lead: Pedro García' },
                { timestamp: '2025-03-04 10:15', description: 'Se envió campaña de email a 50 leads' },
                { timestamp: '2025-03-04 10:30', description: 'Lead contactado: Ana Mendoza' }
            ]
        }
    },
    computed: {
        btnClass() {
            return this.isPaused
                ? "inline-flex items-center px-4 py-2 text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                : "inline-flex items-center px-4 py-2 text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        },
        isDetailView() {
            // Muestra la vista detallada solo si la ruta es 'DealsAdsManagerAdsDealView'
            return this.$route.name === 'DealsAdsManagerAdsDealView'
        }
    },
    created() {
        // Aquí podrías cargar los datos reales del DealProduct basándote en $route.params.dealId
        // Por ejemplo: this.fetchDealProduct(this.$route.params.dealId)
    },
    methods: {
        togglePause() {
            this.isPaused = !this.isPaused;
            if (this.isPaused) {
                // Ejecutar comando para detener la mercancía
                console.log("Mercancía detenida");
            } else {
                // Ejecutar comando para activar o reanudar la mercancía
                console.log("Mercancía activada");
            }
        },
        applyFilters() {
            // Lógica para aplicar filtros y recargar datos
            console.log('Aplicando filtros:', this.filters)
        }
    }
}
</script>

<style scoped>
/* Ajusta estilos adicionales para afinar la apariencia a tu gusto */
</style>
