<?php

namespace Biplove\OopsUi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\Response render(int $statusCode, array $overrides = [])
 *
 * @see \Biplove\OopsUi\OopsUi
 */
class OopsUi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Biplove\OopsUi\OopsUi::class;
    }
}
