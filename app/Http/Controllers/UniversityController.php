<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $countries = University::select('country')->distinct()->pluck('country');
        $selectedCountry = $request->get('country');
        $bachelor = $request->get('bachelor');
        $masters = $request->get('masters');
        $scholarship = $request->get('scholarship');
        $universities = University::when($selectedCountry, function($query) use ($selectedCountry) {
                $query->where('country', $selectedCountry);
            })
            ->when($bachelor, function($query) use ($bachelor) {
                $query->where('bachelor', $bachelor);
            })
            ->when($masters, function($query) use ($masters) {
                $query->where('masters', $masters);
            })
            ->when($scholarship, function($query) use ($scholarship) {
                $query->where('scholarship', $scholarship);
            })
            ->get();
        return view('universities.index', compact('countries', 'selectedCountry', 'universities'));
    }

    public function create()
    {
        return view('universities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string',
            'name' => 'required|string',
            'city' => 'required|string',
            'subjects_name' => 'required|string',
            'semester' => 'nullable|string',
            'bachelor' => 'nullable|string',
            'masters' => 'nullable|string',
            'scholarship' => 'nullable|string',
            'tuition_fees' => 'nullable|string',
            'application_fees' => 'nullable|string',
            'requirements' => 'nullable|string',
            'ielts' => 'nullable|numeric',
            'minimum_cgpa' => 'nullable|string',
        ]);
        University::create($request->all());
        return redirect()->route('universities.index')->with('success', 'University added successfully!');
    }

    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    public function update(Request $request, University $university)
    {
        $request->validate([
            'country' => 'required|string',
            'name' => 'required|string',
            'city' => 'required|string',
            'subjects_name' => 'required|string',
            'semester' => 'nullable|string',
            'bachelor' => 'nullable|string',
            'masters' => 'nullable|string',
            'scholarship' => 'nullable|string',
            'tuition_fees' => 'nullable|string',
            'application_fees' => 'nullable|string',
            'requirements' => 'nullable|string',
            'ielts' => 'nullable|numeric',
            'minimum_cgpa' => 'nullable|string',
        ]);
        $university->update($request->all());
        return redirect()->route('universities.index')->with('success', 'University updated successfully!');
    }

    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('universities.index')->with('success', 'University deleted successfully!');
    }

    /**
     * Get dashboard statistics for universities.
     */
    public static function getDashboardStats()
    {
        $totalUniversities = University::count();
        $totalBachelor = University::where('bachelor', 'Yes')->count();
        $totalMasters = University::where('masters', 'Yes')->count();
        return [
            'totalUniversities' => $totalUniversities,
            'totalBachelor' => $totalBachelor,
            'totalMasters' => $totalMasters,
        ];
    }
}
