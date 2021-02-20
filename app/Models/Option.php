<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    const SHOW_FB_POPUP = 'show_fb_popup';
    const SHOW_FLOATING_NEWS = 'show_floating_news';
    const SHOW_FLOATING_ADS = 'show_floating_ads';
    const SHOW_TG_POPUP = 'show_tg_popup';

    use HasFactory;
}
