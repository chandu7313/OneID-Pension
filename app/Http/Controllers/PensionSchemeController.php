<?php

namespace App\Http\Controllers;

use App\Models\PensionScheme;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PensionSchemeController extends Controller
{
    public function index(): View
    {
        $schemes = PensionScheme::latest()->paginate(10);
        return view('pension_schemes.index', compact('schemes'));
    }

    public function create(): View
    {
        return view('pension_schemes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'scheme_name' => 'required|string|max:255',
            'scheme_code' => 'required|unique:pension_schemes',
            'benefit_amount' => 'required|numeric',
        ]);

        PensionScheme::create($validated);
        return redirect()->route('pension-schemes.index')
            ->with('success', 'Pension scheme created successfully');
    }

    public function edit(PensionScheme $pensionScheme): View
    {
        return view('pension_schemes.edit', compact('pensionScheme'));
    }

    public function update(Request $request, PensionScheme $pensionScheme): RedirectResponse
    {
        $validated = $request->validate([
            'scheme_name' => 'required|string|max:255',
            'scheme_code' => 'required|unique:pension_schemes,scheme_code,' . $pensionScheme->id,
            'benefit_amount' => 'required|numeric',
            'status' => 'required|string'
        ]);

        $pensionScheme->update($validated);
        return redirect()->route('pension-schemes.index')
            ->with('success', 'Pension scheme updated successfully');
    }

    public function destroy(PensionScheme $pensionScheme): RedirectResponse
    {
        $pensionScheme->delete();
        return redirect()->route('pension-schemes.index')
            ->with('success', 'Pension scheme deleted successfully');
    }
}
