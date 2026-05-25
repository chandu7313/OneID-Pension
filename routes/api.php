<?php

use App\Models\Citizen;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| OneID Pension System API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('supabase.auth')->group(function () {
    
    // Citizen Portal Routes
    Route::prefix('citizen')->group(function () {
        Route::get('/profile', function (Request $request) {
            $user = $request->get('supabase_user');
            $citizen = Citizen::where('oneid_number', $user->sub)->first();
            return response()->json($citizen);
        });

        Route::get('/enrollments', function (Request $request) {
            $user = $request->get('supabase_user');
            $enrollments = Enrollment::whereHas('citizen', function($q) use ($user) {
                $q->where('oneid_number', $user->sub);
            })->with('scheme')->get();
            return response()->json($enrollments);
        });
    });

    // Admin Portal Routes (Requires additional RBAC check)
    Route::middleware('role:state_officer')->prefix('admin')->group(function () {
        Route::get('/beneficiaries', function (Request $request) {
            $beneficiaries = Citizen::paginate(20);
            return response()->json($beneficiaries);
        });
        
        Route::get('/fraud/alerts', function (Request $request) {
            // Logic for MongoDB fraud metadata fetch would go here
            return response()->json(['alerts' => []]);
        });
    });
});
