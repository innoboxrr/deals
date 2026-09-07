# Guía de verificación para la integración de Google Ads

Esta guía describe, paso a paso, cómo validar cada método expuesto por `GoogleAdsDriver`. Sigue el orden sugerido para cubrir autenticación, sincronización de entidades, métricas, leads, assets, palabras clave, ubicaciones y conversiones offline.

> **Importante:** Trabaja siempre sobre una subcuenta de pruebas dentro de tu MCC para evitar afectar campañas activas.

## 1. Preparativos en Google Ads y Google Cloud

1. **Habilitar un proyecto en Google Cloud:**
   - Visita [console.cloud.google.com](https://console.cloud.google.com/apis/dashboard).
   - Crea un proyecto exclusivo para pruebas.
   - Habilita la API *Google Ads API* y la API *OAuth 2.0 Client IDs*.
2. **Crear las credenciales OAuth:**
   - En el menú *APIs & Services → Credentials*, genera un *OAuth Client ID* de tipo "Web application".
   - Agrega la URL de redirección que usa SeguroPro (`https://{tu_dominio}/deals/ad-platforms/google/callback` o la ruta equivalente en staging).
   - Conserva `client_id` y `client_secret`.
3. **Solicitar/usar un developer token:**
   - Desde tu MCC ingresa a *Herramientas y configuración → Configuración → Acceso de la API*. Usa el developer token aprobado para el entorno de pruebas.
4. **Crear la subcuenta de pruebas:**
   - En el MCC ve a *Cuentas → Rendimiento* y crea una cuenta nueva con divisa MXN.
   - Copia el `customer_id` (formato `123-456-7890`).
   - Si la cuenta está bajo MCC, anota también el `login_customer_id` (ID del MCC) y, si trabajas con acceso delegado, `linked_customer_id`.
5. **Crear elementos auxiliares:**
   - **Acción de conversión** de tipo "Importar desde clics" para probar offline conversions. Guarda el `resource_name`.
   - **Lead Form Extension** (asset) para validar `fetchLeads`.
   - **Ad group y anuncio** de prueba para reutilizar IDs en operaciones de pausa/edición.

## 2. Configurar el archivo de pruebas

En la ruta `.vendor/deals/src/Services/DealAdPlatform` se incluye el script `google_ads_manual_test.php`. Antes de ejecutarlo:

1. Abre el archivo y reemplaza los valores marcados como `TODO:` dentro de `$credentials` y `$sandboxIds` con los datos reales de tu subcuenta.
2. Si aún no cuentas con tokens OAuth (access/refresh), ejecuta primero `authorizationUrl` y `handleOAuthCallback` siguiendo el flujo de la sección 3.
3. El script acepta una lista de acciones (`php google_ads_manual_test.php verify-connection list-campaigns`). Por defecto correrá las pruebas seguras (`verify-connection`, `get-account`, `list-campaigns`).

## 3. Validar autenticación y conexión

1. **Generar URL de autorización (`authorizationUrl`):**
   - Ejecuta el script con `php google_ads_manual_test.php auth-url` para imprimir la URL.
   - Visita la URL, selecciona la subcuenta de pruebas y autoriza el acceso.
2. **Intercambiar el código (`handleOAuthCallback`):**
   - Copia el parámetro `code` devuelto por Google.
   - Invoca `php google_ads_manual_test.php exchange-code "<CODE>"`.
   - El script mostrará `access_token` y `refresh_token`; pega ambos en `$credentials`.
3. **Refrescar tokens (`refreshAccessToken`):**
   - Corre `php google_ads_manual_test.php refresh-token` y valida que se obtenga un nuevo `access_token`.
4. **Verificar conexión (`verifyConnection`) y cuenta (`getAccount`):**
   - Ejecuta `php google_ads_manual_test.php verify-connection get-account`.
   - Confirma que el nombre de la cuenta, moneda y zona horaria coinciden con tu subcuenta.
5. **Desconectar (opcional, `disconnect`):**
   - Una vez concluido, limpia manualmente el payload en la plataforma si deseas revocar acceso.

## 4. Probar operaciones de entidades

> Para acciones de escritura, confirma que tu cuenta esté en modo pruebas y pausa/borra los objetos al finalizar.

1. **Listar campañas (`listEntities:campaign`):**
   - `php google_ads_manual_test.php list-campaigns`.
   - Usa filtros de estado con `php google_ads_manual_test.php "list-campaigns:ENABLED"`.
2. **Crear campaña (`createEntity`):**
   - `php google_ads_manual_test.php create-campaign` generará una campaña en estado pausado con presupuesto diario mínimo.
   - Anota el ID retornado para las siguientes pruebas.
3. **Actualizar campaña (`updateEntity`):**
   - `php google_ads_manual_test.php "update-campaign:<CAMPAIGN_ID>"` para renombrar o cambiar fechas.
4. **Ajustar presupuesto (`adjustBudget`):**
   - `php google_ads_manual_test.php "adjust-budget:<CAMPAIGN_ID>"` cambia el monto diario.
5. **Pausar/Reactivar (`pauseEntity`/`resumeEntity`):**
   - `php google_ads_manual_test.php "pause-campaign:<ID>"` y luego `resume-campaign`.
6. **Ad groups (`listEntities:container` y `createEntity`):**
   - `php google_ads_manual_test.php "list-ad-groups:<CAMPAIGN_ID>"`.
   - `php google_ads_manual_test.php "create-ad-group:<CAMPAIGN_ID>"` para generar uno nuevo.
   - `php google_ads_manual_test.php "adjust-bid:<AD_GROUP_ID>"` valida `adjustBid`.
7. **Anuncios (`listEntities:ad` y `createEntity`):**
   - `php google_ads_manual_test.php "list-ads:<AD_GROUP_ID>"`.
   - `php google_ads_manual_test.php "create-ad:<AD_GROUP_ID>"` crea un RSA (queda pausado).
   - `php google_ads_manual_test.php "pause-ad:<AD_ID>"` y `resume-ad` verifican el fix que resuelve automáticamente el `ad_group_id`.

## 5. Métricas y reportes

1. **`fetchStats`:**
   - `php google_ads_manual_test.php fetch-stats` descarga métricas de los últimos 7 días para campañas.
   - Ajusta el nivel con `php google_ads_manual_test.php "fetch-stats:ad"` si necesitas granularidad.

## 6. Leads y formularios

1. **`supportsLeadForms` y `fetchLeads`:**
   - Asegura que tu subcuenta tenga un Lead Form Extension activo y envía un lead de prueba desde el preview del anuncio.
   - `php google_ads_manual_test.php fetch-leads` trae los registros entre ayer y hoy.

## 7. Assets

1. **Listar assets (`listAssets`):**
   - `php google_ads_manual_test.php list-assets`.
2. **Subir asset (`uploadAsset`):**
   - Para texto: `php google_ads_manual_test.php upload-text-asset`.
   - Para imagen: coloca el archivo en `storage/app/tmp/test-image.jpg` y corre `php google_ads_manual_test.php upload-image-asset` (el script utiliza la ruta configurada en `$assetFiles`).
3. **Actualizar asset (`updateAsset`):**
   - `php google_ads_manual_test.php "rename-asset:<ASSET_ID>"`.

## 8. Palabras clave y ubicaciones

1. **Listar palabras clave (`listKeywords`):**
   - `php google_ads_manual_test.php "list-keywords:<AD_GROUP_ID>"`.
2. **Crear palabras clave (`createKeywords`):**
   - `php google_ads_manual_test.php "add-keywords:<AD_GROUP_ID>"`.
3. **Eliminar (`removeKeywords`):**
   - `php google_ads_manual_test.php "remove-keywords:<AD_GROUP_ID>"` (usa IDs almacenados en el script).
4. **Listar y excluir placements (`listPlacements`/`excludePlacements`):**
   - `php google_ads_manual_test.php "list-placements:<AD_GROUP_ID>"`.
   - `php google_ads_manual_test.php "exclude-placements:<AD_GROUP_ID>"` para agregar exclusiones.

## 9. Conversiones offline y CRM

1. **Subir conversiones (`uploadOfflineConversions`):**
   - Genera un clic de prueba con `gclid` usando el *Click Conversion Debugger*.
   - `php google_ads_manual_test.php upload-offline-conv` enviará un ejemplo utilizando el `conversion_action` definido en `$sandboxIds`.
2. **Ingresos CRM (`uploadCRMRevenue`):**
   - El mismo comando acepta `--crm` para reutilizar el flujo con montos de venta.

## 10. Limpieza

- Pausa o elimina campañas, grupos y anuncios creados.
- Revoca el token en [myaccount.google.com/permissions](https://myaccount.google.com/permissions) si terminaste las pruebas.
- Documenta en tu equipo los IDs utilizados para evitar colisiones en futuras pruebas.

## 11. Solución de problemas

- **403/Permission denied:** Verifica `developer_token`, nivel de acceso del usuario OAuth y que el `login_customer_id` corresponda al MCC correcto.
- **Token inválido:** Ejecuta nuevamente `refresh-token` o repite el flujo de autorización.
- **No se resuelve `ad_group_id`:** El fix incluido consulta GAQL `selectAdGroupIdByAdId`. Asegúrate de que el anuncio exista y de usar el ID numérico.
- **Errores parciales en conversiones:** Revisa `errors` en la salida del script; suelen detallar campos obligatorios faltantes o ventanas fuera de rango.

Con esta guía y el script asociado puedes validar el funcionamiento integral del driver antes de promover cambios a producción.
