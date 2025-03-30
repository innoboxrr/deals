<?php

namespace Innoboxrr\Deals\Enums\DealSessionEvent;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Key: string
{
    use EnumTrait;

    // Sesión
    case SESSION_STARTED = 'session_started';
    case SESSION_ENDED = 'session_ended';

    // Visualización
    case VIEWED = 'viewed';
    case SCROLLED = 'scrolled';
    case SCROLL_TO_BOTTOM = 'scroll_to_bottom';
    case SCROLL_TO_TOP = 'scroll_to_top';

    // Interacción
    case CLICKED = 'clicked';
    case FORWARD = 'forward';
    case FORM_SUBMITTED = 'form_submitted';
    case BUTTON_CLICKED = 'button_clicked';
    case HOVERED = 'hovered';
    case INPUT_CHANGED = 'input_changed';

    // Email
    case SUBSCRIBED = 'subscribed';
    case UNSUBSCRIBED = 'unsubscribed';
    case EMAIL_OPENED = 'email_opened';
    case EMAIL_BOUNCED = 'email_bounced';
    case EMAIL_REPLIED = 'email_replied';

    // Conversión
    case CONVERTED = 'converted';
    case CTA_CLICKED = 'cta_clicked';
    case LEAD_CAPTURED = 'lead_captured';

    // Multimedia
    case VIDEO_PLAYED = 'video_played';
    case VIDEO_PAUSED = 'video_paused';
    case VIDEO_ENDED = 'video_ended';
}
