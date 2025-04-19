export const internalFields = [
	{ 
		value: "id", 
		label: "ID", 
		formats: [] 
	},
	{ 
		value: "idgateway", 
		label: "ID Gateway", 
		formats: [] 
	},
	{ 
		value: "email", 
		label: "Correo electrónico", 
		formats: [
			"lowercase", 
			"md5_hash", 
			"fix_email_typos", 
			"clean_email", 
			"clean_fix_email_typos", 
			"default_email_value"
		] 
	},
	{ 
		value: "phone", 
		label: "Teléfono", 
		formats: [
			"without_country_code", 
			"with_country_code", 
			"with_country_code_without_plus", 
			"numbers_of_digits", 
			"brazil_ddd_code",
			"brazil_without_ddd_code", 
			"regex"
		] 
	},
	{ 
		value: "gender", 
		label: "Género", 
		formats: [
			"m:Male|f:Female"
		] 
	},
	{ 
		value: "name", 
		label: "Nombre", 
		formats: [
			"full_name", 
			"first_name", 
			"middle_name", 
			"first_and_middle_name", 
			"last_name", 
			"middle_name_and_last_name", 
			"clean_full_name", 
			"clean_first_name", 
			"clean_middle_name", 
			"clean_first_and_middle_name", 
			"clean_middle_name_and_last_name", 
			"clean_last_name"
		] 
	},
	{ 
		value: "dateofbirth", 
		label: "Fecha de nacimiento", 
		formats: [
			"age", 
			"between_ages", 
			"random", 
			"custom_date_format", 
			"date"
		] 
	},
	{ 
		value: "address", 
		label: "Dirección", 
		formats: [
			"default_lead_address", 
			"lead_address_format", 
			"address_with_random_fallback"
		] 
	},
	{ 
		value: "postalcode", 
		label: "Código Postal", 
		formats: [
			"postal_code", 
			"city_name", 
			"numbers_of_digits", 
			"valid_postal_code", 
			"postalcode_with_random_fallback"
		] 
	},
	{ 
		value: "idcounty", 
		label: "ID Condado", 
		formats: [
			"code", 
			"name"
		] 
	},
	{ 
		value: "idstate", 
		label: "ID Estado", 
		formats: [
			"code", 
			"name"
		] 
	},
	{ 
		value: "ip", 
		label: "IP", 
		formats: [
			"default_ip", 
			"only_ipv4", 
			"random_ip"
		] 
	},
	{ 
		value: "url", 
		label: "URL", 
		formats: [
			"full_url", 
			"domain", 
			"full_domain_with_protocol"
		] 
	},
	{ 
		value: "urlreferer", 
		label: "Referer", 
		formats: [] 
	},
	{ 
		value: "sent", 
		label: "Sent", 
		formats: [] 
	},
	{ 
		value: "idall", 
		label: "ID All", 
		formats: [] 
	},
	{ 
		value: "clickid", 
		label: "Click ID", 
		formats: [] 
	},
	{ 
		value: "concempt_type", 
		label: "Concent Type", 
		formats: [] 
	},
	{ 
		value: "client_sent_object", 
		label: "Objeto enviado por cliente", 
		formats: [] 
	},
	{ 
		value: "client_reponse", 
		label: "Respuesta del cliente", 
		formats: [] 
	},
	{ 
		value: "client_id", 
		label: "Client ID", 
		formats: [] 
	},
	{ 
		value: "client_date", 
		label: "Fecha Cliente", 
		formats: [
			"custom_date_format", 
			"date"
		] 
	},
	{ 
		value: "leadstate", 
		label: "Estado del Lead", 
		formats: [] 
	},
	{ 
		value: "value", 
		label: "Valor", 
		formats: [] 
	},
	{ 
		value: "payout_level", 
		label: "Nivel de payout", 
		formats: [] 
	},
	{ 
		value: "platform", 
		label: "Plataforma", 
		formats: [] 
	},
	{ 
		value: "traffictype", 
		label: "Tipo de tráfico", 
		formats: [
			"full", 
			"code", 
			"name"
		] 
	},
	{ 
		value: "nextdeal", 
		label: "Siguiente Deal", 
		formats: [] 
	},
	{ 
		value: "fixed_value", 
		label: "Valor Fijo", 
		formats: [] 
	},
	{ 
		value: "dynamic_value", 
		label: "Valor Dinámico", 
		formats: [
			"random_ip", 
			"random_last_name", 
			"random_address", 
			"concat", 
			"country_code", 
			"generate_password", 
			"generate_password_specific", 
			"random_between", 
			"random_between_days", 
			"user_agent"
		] 
	},
	{ 
		value: "now", 
		label: "Ahora", 
		formats: [
			"custom_date_format", 
			"date"
		] 
	},
	{ 
		value: "tokens", 
		label: "Tokens", 
		formats: [
			"jornaya", 
			"trusted_form_token", 
			"trusted_form_url"
		] 
	},
	{ 
		value: "user_agent", 
		label: "User Agent", 
		formats: [] 
	},
	{ 
		value: "landing", 
		label: "Landing Page", 
		formats: [] 
	},
	{ 
		value: "datetime", 
		label: "Fecha y Hora", 
		formats: [
			"custom_date_format", 
			"date"
		] 
	},
	{ 
		value: "address.street"
		, label: "Calle", 
		formats: [
			"uppercase"
		] 
	},
	{ 
		value: "address.city"
		, label: "Ciudad", 
		formats: [
			"uppercase"
		] 
	},
	{ 
		value: "address.zip"
		, label: "Código postal", 
		formats: [] 
	},
	{ 
		value: "other", 
		label: "Campo adicional (Other)", 
		formats: [
			"custom_path"
		] 
	},
];

export const formatsWithValue = [
	"phone_mask",
	"custom_date_format",
	"custom_path",
	"numbers_of_digits",
	"regex",
	"between_ages",
	"concat",
	"generate_password_specific",
	"random_between",
	"random_between_days"
];

export const formatLabels = {
	uppercase: "Mayúsculas",
	lowercase: "Minúsculas",
	phone_mask: "Teléfono con máscara",
	without_country_code: "Sin código país",
	with_country_code: "Con código país",
	with_country_code_without_plus: "Código país sin +",
	numbers_of_digits: "N cantidad de dígitos",
	brazil_ddd_code: "Teléfono con DDD (BR)",
	brazil_without_ddd_code: "Teléfono sin DDD (BR)",
	regex: "Regex personalizada",
	m: "Hombre",
	f: "Mujer",
	full_name: "Nombre completo",
	first_name: "Primer nombre",
	middle_name: "Segundo nombre",
	last_name: "Apellido",
	clean_full_name: "Nombre limpio",
	age: "Edad",
	between_ages: "Entre edades",
	random: "Aleatorio",
	postal_code: "Código postal",
	city_name: "Nombre de ciudad",
	valid_postal_code: "Postal válido (tabla)",
	default_ip: "IP por defecto",
	only_ipv4: "Solo IPv4",
	random_ip: "IP aleatoria",
	full_url: "URL completa",
	domain: "Dominio",
	full_domain_with_protocol: "Dominio con protocolo",
	md5_hash: "MD5 del valor",
	fix_email_typos: "Corregir typos",
	clean_email: "Limpiar email",
	clean_fix_email_typos: "Limpiar y corregir",
	default_email_value: "Email por defecto",
	default_lead_address: "Dirección por defecto",
	lead_address_format: "Formato dirección",
	address_with_random_fallback: "Dirección con fallback aleatorio",
	code: "Código",
	name: "Nombre",
	full: "Completo",
	concat: "Concatenar",
	country_code: "Código país",
	generate_password: "Password aleatoria",
	generate_password_specific: "Password específica",
	random_between: "Aleatorio entre valores",
	random_between_days: "Aleatorio entre fechas",
	jornaya: "Token Jornaya",
	trusted_form_token: "Trusted Form Token",
	trusted_form_url: "Trusted Form URL",
	custom_path: "Ruta personalizada (dot notation)",
	date: "Fecha",
};
