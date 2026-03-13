<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthApiController;
use App\Http\Controllers\Api\V1\ServiceApiController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * ============================================
 * API V1 - PUBLIQUE (pas d'authentification)
 * ============================================
 */
Route::prefix('v1')->group(function () {
    
    // Test de l'API
    Route::get('/ping', function (Request $request){
        return response()->json([
            'success' => true,
            'message' => 'API V1 fonctionne correctement',
            'Heure' => now(),
            
        ], 200);
    });

    /**
     * Routes AUTHENTIFICATION (publiques)
     */
    Route::post('/auth/login', [AuthApiController::class, 'login']);
    Route::post('/auth/register', [AuthApiController::class, 'register']);

    /**
     * Routes SERVICES (publiques)
     */
    Route::get('/services', [ServiceApiController::class, 'index']);
    Route::get('/services/{service}', [ServiceApiController::class, 'show']);
    Route::post('/services/store', [ServiceApiController::class, 'store']);
    Route::put('/services/{service}', [ServiceApiController::class, 'update']);
    Route::delete('/services/{service}', [ServiceApiController::class, 'destroy']);

    /**
     * ============================================
     * API V1 - PROTÉGÉES (authentification requise)
     * ============================================
     */
    Route::middleware('auth:sanctum')->group(function () {

        /**
         * Routes AUTHENTIFICATION (protégées)
         */
        Route::post('/auth/logout', [AuthApiController::class, 'logout']);
        Route::get('/auth/me', [AuthApiController::class, 'me']);
    });
});