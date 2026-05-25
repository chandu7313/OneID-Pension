<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Citizen; 
use App\Models\PensionScheme; 
use App\Models\CitizenPension; 
use App\Models\DuplicateLog; 
use Illuminate\View\View; 
 
class DashboardController extends Controller 
{ 
    public function dashboard(): View 
    { 
        $totalCitizens = Citizen::count(); 
        $activeSchemes = PensionScheme::where('status', 'Active')->count(); 
        $totalAssignments = CitizenPension::count(); 
        $pendingAssignments = CitizenPension::where('pension_status', 'Pending')->count(); 
        $duplicateRecords = DuplicateLog::where('status', 'pending')->count(); 
        $recentCitizens = Citizen::latest()->take(5)->get(); 
 
        return view('dashboard', compact( 
            'totalCitizens', 
            'activeSchemes', 
            'totalAssignments', 
            'pendingAssignments', 
            'duplicateRecords', 
            'recentCitizens' 
        )); 
    } 
} 
