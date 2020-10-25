<?php

namespace Rahxcr\LaravelStschk;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rahxcr\LaravelStschk\Skeleton\SkeletonClass
 */
class LaravelStschkFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-stschk';
    }
}
