<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Show all applicants with search and filtering
     * GET /applicants
     */
    public function index(Request $request)
    {
        // Get the search keyword from the request (if user searched for something)
        $search = $request->input('search');
        
        }
        
        // Get all applicants from the database (with pagination for better performance)
        $applicants = $query->paginate(10); // Show 10 applicants per page
        
        // Return the view with applicants data
        return view('applicants.index', compact('applicants', 'search', 'filterStatus'));
    }
    
    /**
     * Show the form to create a new applicant
     * GET /applicants/create
     */
    public function create()
    {
        // Return the view with the form to create a new applicant
        return view('applicants.create');
    }
    
    /**
     * Save a new applicant to the database
     * POST /applicants
     */
    public function store(Request $request)
    {
        // Validate the data from the form
        $validated = $request->validate([
            'name' => 'required|string|max:100', // Name is required and must be text, maximum 100 characters
            'email' => 'required|email|unique:applicants', // Email is required, must be valid email, and must be unique
            'phone' => 'required|string|max:20', // Phone is required and can be text (to support different formats)
            'position' => 'required|string|max:100', // Position is required
            'experience' => 'required|integer|min:0', // Experience must be a number and at least 0
            'description' => 'nullable|string', // Description is optional
        ]);
        
        // Create a new applicant with the validated data
        Applicant::create($validated);
        
        // Redirect to the applicants list page with a success message
        return redirect()->route('applicants.index')->with('success', 'Applicant created successfully!');
    }
    
    /**
     * Show details of a single applicant
     * GET /applicants/{id}
     */
    public function show(Applicant $applicant)
    {
        // Return the view with the applicant details
        return view('applicants.show', compact('applicant'));
    }
    
    /**
     * Show the form to edit an applicant
     * GET /applicants/{id}/edit
     */
    public function edit(Applicant $applicant)
    {
        // Return the view with the edit form and the applicant data
        return view('applicants.edit', compact('applicant'));
    }
    
    /**
     * Update an applicant in the database
     * PUT/PATCH /applicants/{id}
     */
    public function update(Request $request, Applicant $applicant)
    {
        // Validate the data from the form
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:applicants,email,' . $applicant->id, // Allow the same email for this applicant
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:100',
            'experience' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:new,under review,accepted,rejected', // Status must be one of these values
        ]);
        
        // Update the applicant with the new data
        $applicant->update($validated);
        
        // Redirect to the applicant details page with a success message
        return redirect()->route('applicants.show', $applicant)->with('success', 'Applicant updated successfully!');
    }
    
    /**
     * Delete an applicant from the database
     * DELETE /applicants/{id}
     */
    public function destroy(Applicant $applicant)
    {
        // Delete the applicant from the database
        $applicant->delete();
        
        // Redirect to the applicants list page with a success message
        return redirect()->route('applicants.index')->with('success', 'Applicant deleted successfully!');
    }
}

