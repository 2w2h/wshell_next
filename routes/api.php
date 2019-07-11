<?php

use Illuminate\Http\Request;

Route::get('routes', function() {
    $routes = app()->routes->getRoutes();

    $groupByGuard = [];
    foreach ($routes as $route) {
        if (!in_array('GET', $route->methods)) {
            continue;
        }
        $middlewares = is_array($route->action['middleware'])
            ? $route->action['middleware']
            : [$route->action['middleware']];

        if (in_array('auth', $middlewares)) {
            $groupByGuard['session'][] = $route->uri;
            continue;
        }
        if (in_array('auth:api', $middlewares)) {
            $groupByGuard['token'][] = $route->uri;
            continue;
        }
        $groupByGuard['other'][] = $route->uri;
    }
    return $groupByGuard;
});

// неавторизованных клиентов будет отправлять на логин
Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('/test')->group(function() {
        Route::get('/mongo', function (Request $request) {
            $testCol = DB::collection('test');
            $testCol->insert(['abc' => 123]);

            return [
                'items' => $testCol->get(),
                'count' => $testCol->count(),
            ];
        });

        Route::get('/redis', function (Request $request) {
            Redis::lpush('list', 1);

            return [
                'items' => Redis::lRange('list', 0, -1),
                'count' => Redis::lLen('list'),
            ];
        });
    });
});

