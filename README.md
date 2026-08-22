# Deals

**Lead-generation and paid-acquisition infrastructure for Laravel.**

The data model behind a performance marketing operation: advertisers, agreements, campaigns, ads, leads, routing, and the reporting that reconciles all of it.

## What it models

**Acquisition**
`DealAdPlatform` · `DealAdCampaign` · `DealAdGroup` · `DealAd` — the paid media hierarchy, with per-campaign rules (`DealAdCampaignRule`).

**Commercial**
`DealAdvertiser` · `DealAdvertiserAgreement` — terms per advertiser, including CPL adjustments (`DealAdvertiserAgreementCplAdjustment`), daily reconciliation (`DealAdvertiserAgreementDaily`), invoicing (`DealAdvertiserAgreementInvoice`) and stored payment methods.

**Traffic and leads**
`DealSession` · `DealSessionEvent` · `DealLead` · `DealLeadTrackingEvent` · `DealPixelFire` — the full path from a visitor landing to a lead firing a conversion pixel.

**Routing**
`DealRouter` · `DealRouterExecution` · `DealGateway` — conditional delivery of leads to buyers, with every execution recorded rather than inferred.

**Reporting**
`DealPerformanceSnapshot` · `DealAdPerformanceSnapshot` · `DealAlert` — periodic snapshots so historical numbers stay stable when upstream data is restated, plus alerting when they move.

## The architecture

Every model follows the same shape, and that is the point:

| Layer | Responsibility |
|---|---|
| `Filters/` | Query-string driven filtering, whitelisted per model |
| `Operations/` | Business actions, kept out of controllers |
| `Relations/` | Relationship definitions |
| `Mutators/` | Attribute casting and accessors |
| `Scopes/` | Reusable query constraints |
| `Storage/` | Persistence concerns |
| `Assignments/` | Ownership and permission binding |

Adding a model means filling in seven predictable files, not inventing a new structure. That consistency is what keeps a package this size navigable.

## Install

```bash
composer require innoboxrr/deals
php artisan vendor:publish --tag=deals-config
php artisan migrate
```

---

Part of [Innobox R&R](https://github.com/innoboxrr) — 52 open-source packages extracted from production work. **[innobox.systems](https://innobox.systems)**
