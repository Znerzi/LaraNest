@extends('layout')

@section('title', $applicant->name)

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>{{ $applicant->name }}</h1>
        <!-- Status badge -->
        <span class="badge badge-{{ str_replace(' ', '-', strtolower($applicant->status)) }}" style="font-size: 1rem; padding: 0.5rem 1rem;">
            {{ $applicant->status }}
        </span>
    </div>
    
    <!-- Applicant details card -->
    <div style="background: white; padding: 2rem; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: 1.5rem;">
        <!-- Display applicant information in a nice format -->
        <div class="form-row">
            <div>
                <h3 style="color: #007bff; margin-bottom: 0.5rem;">Email</h3>
                <p>{{ $applicant->email }}</p>
            </div>
            <div>
                <h3 style="color: #007bff; margin-bottom: 0.5rem;">Phone</h3>
                <p>{{ $applicant->phone }}</p>
            </div>
        </div>
        
        <div class="form-row">
            <div>
                <h3 style="color: #007bff; margin-bottom: 0.5rem;">Position Applied For</h3>
                <p>{{ $applicant->position }}</p>
            </div>
            <div>
                <h3 style="color: #007bff; margin-bottom: 0.5rem;">Years of Experience</h3>
                <p>{{ $applicant->experience }} years</p>
            </div>
        </div>
        
        <!-- Show cover letter if it exists -->
        @if($applicant->description)
            <div class="form-row full">
                <div>
                    <h3 style="color: #007bff; margin-bottom: 0.5rem;">Cover Letter</h3>
                    <p style="line-height: 1.6;">{{ $applicant->description }}</p>
                </div>
            </div>
        @endif
        
        <div class="form-row">
            <div>
                <h3 style="color: #007bff; margin-bottom: 0.5rem;">Applied On</h3>
                <p>{{ $applicant->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <h3 style="color: #007bff; margin-bottom: 0.5rem;">Last Updated</h3>
                <p>{{ $applicant->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
    
    <!-- Action buttons -->
    <div style="margin-top: 2rem;">
        <!-- Edit button -->
        <a href="{{ route('applicants.edit', $applicant) }}" class="btn btn-warning">Edit Applicant</a>
        
        <!-- Delete button with confirmation -->
        <form method="POST" action="{{ route('applicants.destroy', $applicant) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this applicant? This cannot be undone.');">Delete Applicant</button>
        </form>
        
        <!-- Back to list button -->
        <a href="{{ route('applicants.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
