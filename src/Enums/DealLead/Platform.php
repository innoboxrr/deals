<?php

namespace Innoboxrr\Deals\Enums\DealLead;

use Innoboxrr\Deals\Support\Traits\EnumTrait;

enum Platform: string
{
    use EnumTrait;

    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case GOOGLE = 'google';
    case TIKTOK = 'tiktok';
    case SNAPCHAT = 'snapchat';
    case LINKEDIN = 'linkedin';
    case YOUTUBE = 'youtube';
    case X = 'x';
    case WHATSAPP = 'whatsapp';
    case TELEGRAM = 'telegram';
    case EMAIL = 'email';
    case SMS = 'sms';
    case WEBSITE = 'website';
    case APP = 'app';
    case CALL = 'call';
    case CHAT = 'chat';
    case FORUM = 'forum';
    case REFERRAL = 'referral';
    case PARTNER = 'partner';
    case EVENT = 'event';
    case ADVERTISING = 'advertising';
    case UNKNOWN = 'unknown';
}