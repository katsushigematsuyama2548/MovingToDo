<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * この名前空間はコントローラールートに適用されます。
     *
     * さらに、URLジェネレーターのルート名前空間として設定されます。
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * アプリケーションの「ホーム」ルートへのパス。
     *
     * @var string
     */
    public const HOME = '/'; // 追加: HOME定数の定義

    /**
     * ルートモデルバインディング、パターンフィルターなどを定義します。
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * アプリケーションのルートを定義します。
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * アプリケーションの「web」ルートを定義します。
     *
     * これらのルートはすべてセッション状態、CSRF保護などを受け取ります。
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * アプリケーションの「api」ルートを定義します。
     *
     * これらのルートは通常、ステートレスです。
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}