<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        $user = \Sentinel::check();
       
        if(!empty($user))
        {
           /* if($user->is_admin!='1')
            {
                return redirect('/admin');
            }
            //return new RedirectResponse(url('/admin'));
            if($user->is_admin!='1')
            {
               return redirect('/admin');
            }*/
        }
        else
        {
            return redirect('/admin');
        }
        
      
        return $next($request);
    }
}
