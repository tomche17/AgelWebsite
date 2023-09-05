<?php

namespace App\Http\Middleware;

use Closure;
use App\Listing;

class CheckComite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_listing = $request->route()->parameter('id');
        $id_cb = Listing::where('id', $id_listing)->value('id_cb');
        if (auth()->user()->comite_id != $id_cb) {
            return redirect('/home')->with('error', 'Page non autorisée');
        }

        return $next($request);
    }
}
