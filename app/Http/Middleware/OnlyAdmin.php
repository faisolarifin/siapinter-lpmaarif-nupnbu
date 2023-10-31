<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array(auth()->user()->role, ["super admin", "admin pusat", "admin wilayah", "admin cabang"])) {
            if (auth()->user()->status_active == 'block') {
                return redirect()->route('login')->with('error', 'this account has blocked');
            }
            $specificFilter = null;
            if (in_array(auth()->user()->role, ["admin wilayah"])) {
                $specificFilter = [
                    "id_prov" => auth()->user()->provId,
                ];
            } elseif (in_array(auth()->user()->role, ["admin cabang"])) {
                $specificFilter = [
                    "id_pc" => auth()->user()->cabangId,
                ];
            }
            $request->specificFilter = $specificFilter;

            return $next($request);
        }
        return redirect()->route('login')->with('error', 'user tidak memiliki privilages');
    }
}
