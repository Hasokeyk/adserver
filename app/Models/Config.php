<?php
/**
 * Copyright (c) 2018 Adshares sp. z o.o.
 *
 * This file is part of AdServer
 *
 * AdServer is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License,
 * or (at your option) any later version.
 *
 * AdServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AdServer. If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Adserver\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    /**
     * Time of last processed event in ADS user's log
     */
    const ADS_LOG_START = 'ads-log-start';

    /**
     * Time of last campaign export to AdPay
     */
    const AD_PAY_CAMPAIGN_EXPORT_TIME = 'adpay-camp-exp';

    /**
     * Time of last event export to AdPay
     */
    const AD_PAY_EVENT_EXPORT_TIME = 'adpay-evt-exp';


    const ADSELECT_LAST_IMPORT = 'adselect-last-import';

    public $incrementing = false;

    protected $primaryKey = 'key';

    protected $keyType = 'string';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public static function adselectLastImportDate(): DateTime
    {
        $config = Config::where('key', self::ADSELECT_LAST_IMPORT)->first();

        if (!$config) {
            return new DateTime('@0');
        }

        return DateTime::createFromFormat(DateTime::ATOM, $config->value);
    }

    public static function updateAdselectLastImportDate(\DateTime $date): void
    {
        $config = Config::where('key', self::ADSELECT_LAST_IMPORT)->first();

        if (!$config) {
            $config = new self();
            $config->key = self::ADSELECT_LAST_IMPORT;
        }

        $config->value = $date->format(DateTime::ATOM);
        $config->save();
    }
}
