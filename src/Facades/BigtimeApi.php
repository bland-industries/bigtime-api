<?php

namespace bland-industries\BigtimeApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \bland-industries\BigtimeApi\BigtimeApi
 */
class BigtimeApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \bland-industries\BigtimeApi\BigtimeApi::class;
    }
}
