<?php

namespace Larabug\NovaLarabugTool\Http\Middleware;

use Larabug\NovaLarabugTool\NovaLarabugTool;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(NovaLarabugTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}
