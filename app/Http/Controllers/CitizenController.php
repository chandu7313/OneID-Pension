<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Citizen; 
use Illuminate\Http\Request; 
use Illuminate\View\View; 
use Illuminate\Http\RedirectResponse; 
 
class CitizenController extends Controller 
{ 
    public function index(): View 
    { 
        $citizens = Citizen::latest()->paginate(10); 
        return view('citizens.index', compact('citizens')); 
    } 
 
    public function create(): View 
    { 
        return view('citizens.create'); 
    } 
 
    public function store(Request $request): RedirectResponse 
    { 
        $validated = $request->validate([ 
            'full_name' => 'required|string|max:255', 
            'aadhaar_number' => 'required|unique:citizens', 
            'mobile_number' => 'required', 
            'state' => 'required', 
        ]); 
 
        Citizen::create($validated); 
        return redirect()->route('citizens.index') 
            ->with('success', 'Citizen registered successfully'); 
    } 
 
    public function edit(Citizen $citizen): View 
    { 
        return view('citizens.edit', compact('citizen')); 
    } 
 
    public function update(Request $request, Citizen $citizen): RedirectResponse 
    { 
        $validated = $request->validate([ 
            'full_name' => 'required|string|max:255', 
            'aadhaar_number' => 'required|unique:citizens,aadhaar_number,' . $citizen->id, 
            'mobile_number' => 'required', 
            'state' => 'required', 
        ]); 
 
        $citizen->update($validated); 
        return redirect()->route('citizens.index') 
            ->with('success', 'Citizen updated successfully'); 
    } 
 
    public function destroy(Citizen $citizen): RedirectResponse 
    { 
        $citizen->delete(); 
        return redirect()->route('citizens.index') 
            ->with('success', 'Citizen deleted successfully'); 
    } 
} 
