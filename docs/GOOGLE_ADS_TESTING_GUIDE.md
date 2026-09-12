# Guía de pruebas manuales – Integración Google Ads Driver

Esta guía explica cómo validar, extremo a extremo, la integración de **GoogleAdsDriver** localizada en `Platforms/Google/GoogleAdsDriver.php`. El objetivo es poder ejecutar cada método expuesto por el driver usando una subcuenta de pruebas dentro de tu MCC y documentar los resultados.

---

## 1. Preparativos en Google Ads / Google Cloud

1. **Requisitos previos:**
   - Acceso a un *Manager Account (MCC)* con permisos de administrador.
   - Developer token aprobado en modo de producción (o al menos en modo de pruebas) asociado al MCC.
   - Proyecto en Google Cloud Console con OAuth consent screen publicado y credenciales OAuth 2.0 (Client ID + Client Secret) para aplicación web.
   - Usuario con acceso a la API de Google Ads (activar en *APIs & Services* > *Library* > *Google Ads API*).

2. **Crear subcuenta de pruebas:**
   - Entra al MCC → *Accounts* → *Create account* → *Google Ads account*.
   - Selecciona ubicación, moneda y zona horaria apropiadas (idealmente MXN y la zona del equipo).
   - No asocies método de pago real; mantén la cuenta en modo de pruebas o sin facturación.
   - Copia el `Customer ID` (formato `123-456-7890`). Este será `credentials.customer_id` en el payload.

3. **Habilitar acceso API para la subcuenta:**
   - Desde el MCC, enlaza la subcuenta mediante la sección *Settings* → *Account access*. Verifica que el developer token tenga permisos sobre ese `Customer ID`.
   - Si usarás cuentas enlazadas distintas, anota también el `login_customer_id` (normalmente el MCC principal) y, si aplica, el `linked_customer_id`.

4. **Configurar OAuth:**
   - Añade la URL de redirección que usará tu backend a las credenciales OAuth (por ejemplo, `https://tuapp.com/oauth/google-ads/callback`).
   - Comparte el scope `https://www.googleapis.com/auth/adwords`.
   - Ejecuta un flujo manual (puede ser con la herramienta [OAuth Playground](https://developers.google.com/oauthplayground/)) para obtener `refresh_token` inicial y validar que el consentimiento se completa.

5. **Tokens y credenciales a registrar en `DealAdPlatform->payload`:**
   ```json
   {
     "credentials": {
       "developer_token": "XXXX",
       "client_id": "XXXXXXXX.apps.googleusercontent.com",
       "client_secret": "XXXX",
       "refresh_token": "XXXX",
       "login_customer_id": "111-222-3333",
       "customer_id": "444-555-6666"
     }
   }
   ```
   - Si operas con cuentas enlazadas en cascada, agrega `linked_customer_id`.

---

## 2. Uso del *playground* CLI

En este mismo directorio encontrarás `GoogleAdsDriverPlayground.php`. El script permite invocar métodos del driver desde línea de comandos:

```bash
php GoogleAdsDriverPlayground.php help
```

1. Abre el archivo y reemplaza los valores de las constantes `GOOGLE_ADS_*` con tus credenciales de pruebas.
2. Ejecuta los comandos listados en la sección `Acciones disponibles`. Cada comando imprime la respuesta normalizada que espera el dominio `deals`.
3. Documenta cualquier error HTTP o mensaje de la API; nos servirá para mejorar el manejo de excepciones.

> **Tip:** Si quieres registrar logs detallados, exporta `GOOGLE_ADS_LOGGING=true` antes de correr el script para que el cliente de Google Ads produzca trazas adicionales.

---

## 3. Validación de métodos principales

La tabla siguiente resume cómo comprobar cada funcionalidad. Sigue el orden sugerido porque algunos métodos dependen de IDs creados en pasos anteriores.

| Método | Cómo validarlo | Resultado esperado |
| --- | --- | --- |
| `authorizationUrl()` | Ejecuta el script con `oauth-url` y verifica que la URL incluya tu `client_id` y `redirect_uri`. Opcionalmente ábrela en modo incógnito y confirma que Google muestra el consentimiento. | URL construida correctamente y sin errores por falta de parámetros. |
| `handleOAuthCallback()` | Usa el código devuelto tras aprobar el consentimiento (puede ser en OAuth Playground). Corre `php GoogleAdsDriverPlayground.php exchange <AUTH_CODE>`. | Array con `ok => true` y tokens (`access_token`, `refresh_token`). |
| `refreshAccessToken()` | Corre `php GoogleAdsDriverPlayground.php refresh-token`. | Nuevos tokens válidos. |
| `verifyConnection()` | Comando `verify`. | `ok => true` y metadatos del `customer`. |
| `getAccount()` | Comando `account`. | Datos de moneda y zona horaria. |
| `listEntities('campaign')` | `list-campaigns`. | Colección de campañas con estatus normalizado. |
| `createEntity('campaign')` | `create-campaign payload.json`, donde `payload.json` contiene nombre, presupuesto y fechas. | Recurso creado en estado PAUSED en la UI de Google Ads. |
| `updateEntity('campaign')` | `update-campaign <CAMPAIGN_ID> payload.json` cambiando nombre o fechas. | Respuesta `ok => true` y cambios reflejados en Google Ads. |
| `pauseEntity('campaign')` / `resumeEntity('campaign')` | `pause-campaign <ID>` y `resume-campaign <ID>`. | El estado cambia en la UI. |
| `createEntity('container')` | `create-ad-group <CAMPAIGN_ID> payload.json` con bid inicial. | Nuevo AdGroup activo. |
| `updateEntity('container')` | `update-ad-group <ID> payload.json`. | Bid/estatus actualizado. |
| `pauseEntity('container')` / `resumeEntity('container')` | `pause-ad-group <ID>` y `resume-ad-group <ID>`. | Estado actualizado. |
| `createEntity('ad')` | `create-ad <AD_GROUP_ID> payload.json` con assets (headlines/descriptions/URL). | Anuncio RSA creado en estado PAUSED. |
| `pauseEntity('ad')` / `resumeEntity('ad')` | `pause-ad <AD_ID>` y `resume-ad <AD_ID>`. | Gracias a la corrección `resolveAdGroupIdForAd`, debe resolver el AdGroup automáticamente. |
| `fetchStats()` | `stats campaign 2024-10-01 2024-10-31`. | Métricas agregadas por fecha. |
| `fetchLeads()` | Activa un formulario de leads en la campaña, genera envíos manuales desde la vista de *Lead Form Extensions* y corre `fetch-leads 2024-10-01 2024-10-31`. | Leads normalizados con `fields.gclid` y `custom_fields`. |
| `uploadOfflineConversions()` | Prepara un CSV/JSON con GCLIDs recientes y ejecuta `upload-offline payload.json`. | Conteo `success` y `failed`. Verifica en Google Ads > *Tools* > *Conversions* que se reflejen. |
| `listAssets()` / `uploadAsset()` | `list-assets` y `upload-asset payload.json` (tipo TEXT o IMAGE). | Asset creado y visible en Biblioteca de activos. |
| `listKeywords()` / `createKeywords()` | Usa el ID de un AdGroup de búsqueda: `list-keywords <AD_GROUP_ID>` y `create-keywords <AD_GROUP_ID> keywords.json`. | Keywords creadas (positivas/negativas). |
| `listPlacements()` / `excludePlacements()` | Solo para campañas Display. Ejecuta `list-placements <AD_GROUP_ID>` y `exclude-placements <AD_GROUP_ID> placements.json`. | URLs excluidas visibles en la UI. |
| `uploadCRMRevenue()` | Mismo flujo que offline conversions (`upload-offline`). | Mismo conteo de resultados. |
| `health()` | `health`. | `ok => true` si la conexión responde, o `errors` con detalles en caso contrario. |

> **Notas:**
> - Las funciones relacionadas con audiencias y experimentos están marcadas como `unsupported`; puedes documentar su ausencia pero no requieren prueba funcional.
> - Para campañas Performance Max, actualmente el driver solo soporta AdGroups estándar. Registra la limitación si necesitas probar asset groups.

---

## 4. Limpieza y buenas prácticas

1. **Revertir cambios manuales:** Elimina campañas/ads de prueba para evitar que consuman presupuesto real.
2. **Rotar tokens de ser necesario:** Si compartiste los tokens con más personas, genera uno nuevo desde Google Cloud.
3. **Documentar hallazgos:** Agrega notas en tu sistema de seguimiento indicando qué métodos se probaron, con qué resultados y cualquier incidencia encontrada.

---

## 5. Recursos útiles

- [Documentación oficial Google Ads API](https://developers.google.com/google-ads/api/docs/start)
- [Google Ads Query Language (GAQL) reference](https://developers.google.com/google-ads/api/docs/query/overview)
- [Lead Form Extensions guide](https://support.google.com/google-ads/answer/9801938)
- [Offline conversions import](https://developers.google.com/google-ads/api/docs/conversions/upload-clicks)

Con esta guía y el script CLI deberías poder reproducir y validar cada método del driver de manera controlada dentro de tu subcuenta de pruebas.

---

### Apéndice: Guía rápida para obtener credenciales de prueba en Google Ads"

# 0) Entra a tu MCC (Manager Account)

1. Abre Google Ads y asegúrate de estar en tu **Manager Account (MCC)**. Si necesitas repasar qué es y cómo se navega un MCC, aquí lo explica la ayuda oficial. ([Google Ayuda][1])
2. **Customer ID (login_customer_id)**: lo ves arriba a la derecha en la UI (formato `123-456-7890`). ([Google Ayuda][2])

**Acceso rápido**

```
    https://ads.google.com/
```

---

# 1) Saca (o verifica) tu Developer Token

En el **MCC → Tools & Settings (llave inglesa) → Setup → API Center**. Desde ahí aplicas/obtienes el token. (También puedes abrir directamente el “API Center”.) ([Google for Developers][3])

**Acceso rápido**

```
    https://ads.google.com/aw/apicenter
```

> Nota: Google detalla el proceso de solicitud/aprobación del token en su guía de “Get started”. ([Google for Developers][4])

---

# 2) Crea la subcuenta de pruebas (customer_id)

En tu **MCC → Accounts (icono de cuentas) → Sub-account settings → (+) Create new account** (elige país/moneda/zonahoraria; no añadas método de pago real). ([Google Ayuda][5])

**Para confirmar el ID de la subcuenta (customer_id)**: también aparece arriba a la derecha al entrar a esa cuenta. ([Google Ayuda][2])

---

# 3) Prepara tu proyecto en Google Cloud

1. Abre **Google Cloud Console → APIs & Services → Library** y **habilita “Google Ads API”** en tu proyecto. ([Google for Developers][6])
2. Configura la **OAuth consent screen** (branding, correos, dominios, políticas). ([Google for Developers][7])
3. Crea **OAuth 2.0 Credentials → Web application** y agrega tu **Redirect URI** (el mismo que usarás en tu backend/CLI). ([Google for Developers][6])

**Acceso rápido**

```
    https://console.cloud.google.com/apis/library
    https://console.cloud.google.com/apis/credentials
```

---

# 4) Obtén tu Refresh Token (una sola vez)

Usa el **OAuth 2.0 Playground** para simular el flujo y canjear el `code` por tokens. Selecciona el scope **`https://www.googleapis.com/auth/adwords`**, autoriza y copia el `refresh_token`. ([Google for Developers][8])

**Acceso rápido**

```
    https://developers.google.com/oauthplayground
```

---

# 5) Rellena credenciales en tu payload / CLI

Con lo anterior ya puedes completar tu `payload.credentials` y las constantes del `Playground.php`:

```json
{
    "credentials": {
        "developer_token": "XXXX",
        "client_id": "XXXX.apps.googleusercontent.com",
        "client_secret": "XXXX",
        "refresh_token": "XXXX",
        "login_customer_id": "111-222-3333",
        "customer_id": "444-555-6666",
        "redirect_uri": "https://tudominio.test/oauth/google-ads/callback"
    }
}
```

**Pruebas rápidas (CLI)**
(Recuerda: tabulación de 4 espacios en tus archivos. Aquí te dejo comandos listos.)

```
    php GoogleAdsDriverPlayground.php help
    php GoogleAdsDriverPlayground.php verify
    php GoogleAdsDriverPlayground.php list-campaigns
```

---

# 6) Dónde probar cada feature directamente en la UI (para contrastar con tu driver)

**a) Cuenta y metadatos**

* Ver moneda / zona horaria en la **configuración de la cuenta** (izquierda: Admin/Settings). (Contexto general del API “get started”). ([Google for Developers][9])

**b) Lead Forms (para `fetchLeads`)**

* En la UI de Google Ads, los **Lead form assets** se crean y se asocian a campañas (Search/Video/PMAX/Display según elegibilidad). Úsalos para enviar formularios de prueba y luego corre `fetch-leads`. ([Google Ayuda][10])

**c) Offline Conversions (para `uploadOfflineConversions` / `upload-offline`)**

* **Tools & Settings → Goals → Conversions → (+) → Import → “From clicks” (GCLID/GBRAID/WBRAID)**. Después podrás ver **Uploads** en la sección de Conversions para corroborar. ([Google Ayuda][11])
* Guía del API para importación de **offline click conversions**. ([Google for Developers][12])

**d) Asset Library (para `listAssets` / `uploadAsset`)**

* **Tools (llave) → Shared Library → Asset library**, ahí puedes ver/crear assets y confirmar lo que suba tu driver. ([Google Ayuda][13])

**e) Keywords y Placements**

* En una campaña de **Search**, entra al **Ad group** para revisar **Keywords** (positivas/negativas). En **Display**, revisa **Placements** y exclusiones desde el ad group.

---

# 7) Mapeo rápido: qué llenar vs. dónde verlo

* **`login_customer_id`** → tu **MCC** (arriba derecha en la UI del MCC). ([Google Ayuda][2])
* **`customer_id`** → la **subcuenta de pruebas** que crearás en el paso 2. ([Google Ayuda][5])
* **Developer token** → **API Center** (MCC). ([Google for Developers][3])
* **`client_id` / `client_secret`** → **Cloud Console → APIs & Services → Credentials**. ([Google for Developers][6])
* **`refresh_token`** → **OAuth Playground** (intercambio code→tokens). ([Google for Developers][8])

---

# 8) Checks útiles antes de correr todo

* En **API Center** verifica que tu token esté **aprobado o en test** y que el MCC sea el correcto. ([Google for Developers][4])
* En **Cloud Console** confirma que **Google Ads API** está **Enabled** en el proyecto donde creaste las credenciales. ([Google for Developers][6])
* Prueba `verifyConnection()` desde el CLI para validar permisos mínimos contra el `customer_id`.

---

## Mini-chuleta (URLs útiles)

```
    Google Ads (MCC):                  https://ads.google.com/
    API Center (Developer Token):      https://ads.google.com/aw/apicenter
    Google Cloud - API Library:        https://console.cloud.google.com/apis/library
    Google Cloud - Credentials:        https://console.cloud.google.com/apis/credentials
    OAuth 2.0 Playground:              https://developers.google.com/oauthplayground
```

Si quieres, en el siguiente paso te armo un *checklist* de pruebas CLI (con ejemplos de `payload.json`) para: crear campaña, crear ad group, crear RSA, pausar/reactivar, subir asset, crear keywords, listar placements, subir offline conversions y descargar leads, todo en el orden óptimo para que cada método tenga datos válidos con los que trabajar.

[1]: https://support.google.com/google-ads/answer/6139186?hl=en&utm_source=chatgpt.com "Manager Accounts (MCC): About Google Ads manager accounts"
[2]: https://support.google.com/google-ads/answer/1704344?hl=en&utm_source=chatgpt.com "Find your Google Ads customer ID"
[3]: https://developers.google.com/google-ads/shopping/full-automation/articles/t11?utm_source=chatgpt.com "Set up Google Ads API access | Shopping Automation"
[4]: https://developers.google.com/google-ads/api/docs/get-started/dev-token?utm_source=chatgpt.com "Obtain a developer token - Ads API"
[5]: https://support.google.com/google-ads/answer/7459399?hl=en&utm_source=chatgpt.com "Create a Google Ads manager account"
[6]: https://developers.google.com/google-ads/api/docs/oauth/cloud-project?utm_source=chatgpt.com "Set up a Google API Console project | Google Ads API"
[7]: https://developers.google.com/workspace/guides/configure-oauth-consent?utm_source=chatgpt.com "Configure the OAuth consent screen and choose scopes"
[8]: https://developers.google.com/oauthplayground?utm_source=chatgpt.com "OAuth 2.0 Playground"
[9]: https://developers.google.com/google-ads/api/docs/get-started/introduction?utm_source=chatgpt.com "Introduction | Google Ads API"
[10]: https://support.google.com/google-ads/answer/9423234?hl=en&utm_source=chatgpt.com "About lead form assets - Google Ads Help"
[11]: https://support.google.com/google-ads/answer/7012522?hl=en&utm_source=chatgpt.com "Set up offline conversion imports using Google Click ID ..."
[12]: https://developers.google.com/google-ads/api/docs/conversions/upload-offline?utm_source=chatgpt.com "Manage Offline Conversions | Google Ads API"
[13]: https://support.google.com/google-ads/answer/14097765?hl=en&utm_source=chatgpt.com "How to access, add, or remove assets from the asset library"
