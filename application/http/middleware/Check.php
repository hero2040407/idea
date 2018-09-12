<?php

namespace app\http\middleware;

use think\Request;

class Check
{
    public function handle($request, \Closure $next, $name)
    {
        if ($request->param('name') == 'think') {
            return redirect('index/think');
        }
//        echo 1234;
//        exit();
        return $next($request);
    }
}
