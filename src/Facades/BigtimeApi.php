<?php

namespace BlandIndustries\BigtimeApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BlandIndustries\BigtimeApi\BigtimeApi
 */
class BigtimeApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BlandIndustries\BigtimeApi\BigtimeApi::class;
    }
}
