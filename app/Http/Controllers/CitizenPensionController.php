<?php

namespace App\Http\Controllers;

use App\Models\CitizenPension;
use App\Models\Citizen;
use App\Models\PensionScheme;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CitizenPensionController extends Controller
{
    public function index(): View
    {
        $assignments = CitizenPension::with(['citizen', 'pensionScheme'])->latest()->paginate(10);
        return view('citizen_pensions.index', compact('assignments'));
    }

    public function create(): View
    {
        $citizens = Citizen::all();
        $schemes = PensionScheme::all();
        return view('citizen_pensions.create', compact('citizens', 'schemes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'citizen_id' => 'required|exists:citizens,id',
            'pension_scheme_id' => 'required|exists:pension_schemes,id',
            'enrollment_number' => 'required|unique:citizen_pensions',
            'start_date' => 'required|date',
            'benefit_amount' => 'required|numeric',
        ]);

        CitizenPension::create($validated);
        return redirect()->route('citizen-pensions.index')
            ->with('success', 'Pension assignment created successfully');
    }

    public function edit(CitizenPension $citizenPension): View
    {
        $citizens = Citizen::all();
        $schemes = PensionScheme::all();
        return view('citizen_pensions.edit', compact('citizenPension', 'citizens', 'schemes'));
    }

    public function update(Request $request, CitizenPension $citizenPension): RedirectResponse
    {
        $validated = $request->validate([
            'citizen_id' => 'required|exists:citizens,id',
            'pension_scheme_id' => 'required|exists:pension_schemes,id',
            'enrollment_number' => 'required|unique:citizen_pensions,enrollment_number,' . $citizenPension->id,
            'start_date' => 'required|date',
            'benefit_amount' => 'required|numeric',
            'pension_status' => 'required|string'
        ]);

        $citizenPension->update($validated);
        return redirect()->route('citizen-pensions.index')
            ->with('success', 'Pension assignment updated successfully');
    }

    public function destroy(CitizenPension $citizenPension): RedirectResponse
    {
        $citizenPension->delete();
        return redirect()->route('citizen-pensions.index')
            ->with('success', 'Pension assignment deleted successfully');
    }
}
