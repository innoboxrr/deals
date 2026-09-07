# Guía del paquete `deals`

Este paquete encapsula el dominio de leads/deals para múltiples anunciantes dentro del ecosistema SeguroPro. Sigue patrones de Laravel modularizado: cada endpoint delega en `FormRequest`s ricas en lógica, los modelos se descomponen en *traits* y los servicios coordinan integraciones (CRM, campañas, medios sociales).

## Estructura clave
- `src/Http/Controllers` – Controladores delgados. Deben limitarse a orquestar requests y respuestas (JSON o Inertia) y delegar toda la lógica en `FormRequest`s y servicios.
- `src/Http/Requests` – Cada request extiende `FormRequest` e implementa un método `handle()`; aquí se valida, se aplican políticas y se ejecuta la acción principal. Mantén los métodos `authorize()` y `rules()` concisos; coloca la lógica de negocio en `handle()` o en servicios dedicados.
- `src/Models/Deal` – Compuesto mediante traits (`Concerns`). Cuando añadas comportamientos nuevos crea un trait en `Models/Concerns` y adjúntalo al modelo para evitar clases gigantes.
- `src/Services` – Coordina workflows complejos (asignaciones, sincronización externa). Prefiere servicios inmutables con dependencias resueltas por el contenedor.
- `src/Support` – Helpers compartidos, data transfer objects y utilidades de filtrado/orden.
- `routes/api.php` – Registra rutas bajo el prefijo `api.innoboxrr.deals.*`. Al agregar rutas nuevas respeta el esquema `{recurso}.{acción}` para facilitar su consumo desde el front.
- `config/deals.php` – Parámetros del paquete (aliases de modelos externos, paginación, capacidades de exportación). Cualquier cambio que pueda afectar a otros módulos debe documentarse aquí.

## Convenciones de código
1. **Tipado y estilo**: Sigue PSR-12 y declara tipos estrictos donde sea viable. Evita usar *facades* dentro de métodos testeables; inyecta dependencias via constructor o método.
2. **Autorización**: Apóyate en `Policies` y en los métodos `authorize()` de los `FormRequest`. Si necesitas reglas de negocio transversales, crea `Scopes` o servicios de verificación reutilizables.
3. **Validación**: Los `FormRequest` deben exponer reglas claras y mensajes localizados (usa `lang/vendor/deals`). Para validaciones dinámicas reutiliza traits o rules objects en `Support/Validation`.
4. **Eventos y jobs**: Cuando un flujo requiera side effects (notificar, exportar, sincronizar social media) dispara Jobs en cola desde el `handle()`. Asegúrate de que sean idempotentes.
5. **Tests**: Para cambios funcionales crea pruebas en `tests/Feature` o `tests/Unit`. Usa los *factories* del paquete (`database/factories`) y el trait `DealsRefreshDatabase` cuando corresponda.
6. **Tenancy**: Utiliza los helpers de `App\Support\Tenancy` expuestos en el paquete para resolver el workspace/tenant actual. Nunca asumas un workspace global.

## Flujo de contribución
1. Identifica si el cambio es una acción (`FormRequest`), servicio o evento. Mantén los controladores y modelos como coordinadores mínimos.
2. Si una nueva acción se refleja en el front, agrega la ruta y expórtala en el modelo JS correspondiente (ver `resources/vue/app/sections/admin/modules/deals`).
3. Documenta ajustes relevantes en `docs/` del paquete (`docs/flows.md`, `docs/social-integrations.md`).
4. Antes de commitear ejecuta las pruebas del paquete: `composer test --working-dir=.vendor/deals`.

## Integraciones futuras
El roadmap incluye gestión unificada de redes sociales. Al preparar código nuevo:
- Define contratos claros en `Services/Social` y documenta dependencias externas.
- Asegura que los `Deals` y `Advertisers` conserven la trazabilidad histórica (usa eventos y modelos `Pivot` cuando apliquen).
- Mantén las exportaciones CSV/Excel sincronizadas con los campos mostrados en el front.
