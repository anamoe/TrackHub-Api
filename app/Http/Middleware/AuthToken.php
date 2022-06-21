<?php

namespace App\Http\Middleware;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Http\Request;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        try {


            // get token from request header
            $token = $request->header('api-token');

            // check role and token


            // get token with role 'pengirim'
            $pt = User::where('api-token', $token)->first();

            if ($pt) {
                // if token match with database result,
                // bypass the request to the next process
                return $next($request);
            } else {
                // if token mismatch,
                // return the error message
                return response()->json([
                    'pesan'    => 'gagal',
                    'message'   => 'token invalid, unauthorized!',
                    'data'      => []
                ], 401);
            }
        } catch (\Throwable $th) {
            // catch error, return the error message
            return response()->json([
                'pesan'    => 'error',
                'message'   => $th->getMessage(),
                'data'      => []
            ], 500);
        }
    }
}
