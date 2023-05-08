<?php
use WebbyTroops\AiContentGenerator\Http\Controllers\Admin\ContentGenratorController;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => config('app.admin_url')], function () {
    Route::post('/generate-content', 
        [ContentGenratorController::class, 'generate']
    )->name('admin.ai.content-generator');
});