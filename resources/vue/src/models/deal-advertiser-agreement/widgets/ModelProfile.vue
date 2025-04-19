<template>
	
	<div class="bg-gray-50 p-6">
		<header class="mb-4">
			<h1 class="text-3xl font-bold text-gray-900">
				Dashboard de Agreement
			</h1>
			<p class="mt-2 text-gray-600">
				Revisa el rendimiento del agreement y conoce el desempeño del anunciante, inversión, ganancia e indicadores de leads.
			</p>
		</header>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			
			<div class="bg-white shadow rounded-lg p-6">
				<h2 class="text-xl font-semibold text-gray-800 mb-4">
					Anunciante
				</h2>
				<div class="flex items-center">
					<img 
						src="https://via.placeholder.com/150" 
						alt="Anunciante" 
						class="w-16 h-16 rounded-full mr-4" />
					<div>
						<h3 class="text-lg font-bold text-gray-800">
							Anunciante Ejemplo
						</h3>
						<p class="text-sm text-gray-500">
							Ejemplo Corp
						</p>
					</div>
				</div>
				<div class="mt-4 text-sm text-gray-600">
					<p>
						<i class="fa-solid fa-phone text-gray-500 mr-2"></i>
						+1 234 567 890
					</p>
					<p>
						<i class="fa-solid fa-envelope text-gray-500 mr-2"></i>
						contacto@ejemplo.com
					</p>
				</div>
			</div>

			<div class="bg-white shadow rounded-lg p-6">
				<h2 class="text-xl font-semibold text-gray-800 mb-4">
					Métricas del Deal
				</h2>
				<div class="grid grid-cols-2 gap-4">
					<div class="flex flex-col">
						<span class="text-xs text-gray-500">Clicks</span>
						<span class="text-2xl font-bold text-indigo-600">1,234</span>
					</div>
					<div class="flex flex-col">
						<span class="text-xs text-gray-500">Conversiones</span>
						<span class="text-2xl font-bold text-green-600">567</span>
					</div>
					<div class="flex flex-col">
						<span class="text-xs text-gray-500">CPL</span>
						<span class="text-2xl font-bold text-red-600">$84</span>
					</div>
					<div class="flex flex-col">
						<span class="text-xs text-gray-500">ROI</span>
						<span class="text-2xl font-bold text-blue-600">120%</span>
					</div>
				</div>
			</div>

			<div class="bg-white shadow rounded-lg p-6">
				<h2 class="text-xl font-semibold text-gray-800 mb-4">Progreso de Leads</h2>
				<!-- Barra de progreso -->
				<div class="mb-4">
					<div class="flex justify-between mb-1">
						<!-- Usamos íconos de FontAwesome -->
						<i class="fa-solid fa-check text-green-500 text-base" title="Convertidos"></i>
						<i class="fa-solid fa-clock text-yellow-500 text-base" title="En Proceso"></i>
						<i class="fa-solid fa-times text-red-500 text-base" title="Rechazados"></i>
					</div>
					<div class="relative h-2 bg-gray-200 rounded-full">
						<div class="absolute top-0 left-0 h-2 bg-green-500 rounded-full" style="width: 75%"></div>
					</div>
				</div>
				<!-- Distribución de leads -->
				<div class="flex justify-around">
					<div class="flex flex-col items-center">
						<i class="fa-solid fa-check text-green-500 text-lg"></i>
						<span class="text-xs text-gray-500">50</span>
					</div>
					<div class="flex flex-col items-center">
						<i class="fa-solid fa-clock text-yellow-500 text-lg"></i>
						<span class="text-xs text-gray-500">30</span>
					</div>
					<div class="flex flex-col items-center">
						<i class="fa-solid fa-times text-red-500 text-lg"></i>
						<span class="text-xs text-gray-500">20</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Reporte Detallado del Agreement -->
		<div class="mt-8 bg-white shadow rounded-lg p-6">
			<h2 class="text-2xl font-semibold text-gray-800 mb-4">
				Reporte Detallado del Agreement
			</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div class="bg-gray-50 p-4 rounded-lg">
					<h3 class="text-lg font-medium text-gray-800 mb-2">
						Inversión Publicitaria
					</h3>
					<p class="text-2xl font-bold text-gray-900">
						$3,500
					</p>
				</div>
				<div class="bg-gray-50 p-4 rounded-lg">
					<h3 class="text-lg font-medium text-gray-800 mb-2">
						Ganancia por Inversión
					</h3>
					<p class="text-2xl font-bold text-gray-900">
						$5,000
					</p>
				</div>
			</div>
		</div>
	</div>

</template>

<script>

	import { showModel } from '@dealsModels/deal-advertiser-agreement'
	
	export default {

		props: {

			dealAdvertiserAgreement: {
				type: Object,
				required: false,
			},

			dealAdvertiserAgreementId: {
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
	
	        // Asegurarse de que al menos uno de los dos props esté definido.
	        if (!this.dealAdvertiserAgreement && !this.dealAdvertiserAgreementId) {
	
	            console.error("Se debe proporcionar 'dealAdvertiserAgreement' o 'dealAdvertiserAgreementId'.");
	
	        }
	
	    },

		mounted() {

			if (!this.dealAdvertiserAgreement && this.dealAdvertiserAgreementId) {

				this.fetchDealAdvertiserAgreement();

			} else {

				this.dataLoaded = true;

			}

		},	

	    methods: {

			fetchDealAdvertiserAgreement() {

				showModel(this.dealAdvertiserAgreementId).then( res => {

					this.dealAdvertiserAgreement = res;

					this.dataLoaded = true;

				})

			},	

	    }

	}

</script>