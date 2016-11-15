<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class YspInterface
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
        $result = DB::table('users')->where('mobile',$request->input('mobile'))->first();//条件查询
        \Log::info('授权的用户信息'.var_export($result,true));
        if (empty($result)) {
            abort('404','未授权');
        }else{
            // DB::table('query_counts')->increment('times');
        }
        return $next($request);
    }
}
