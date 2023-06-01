<?php

namespace App\Actions;

use Illuminate\Http\Request;

interface ActionInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): mixed;
}
