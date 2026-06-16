@extends('layout')

@section('title', 'Create New Applicant')

@section('content')
    <h1>Add New Applicant</h1>
    
    <!-- Form to create a new applicant -->
    <form method="POST" action="{{ route('applicants.store') }}" style="background: white; padding: 2rem; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        @csrf
        
        <!-- Applicant's Full Name -->
        <div class="form-group">
            <label for="name">Applicant Name *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Enter full name"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Applicant's Email -->
        <div class="form-group">
            <label for="email">Email Address *</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Enter email address"
                value="{{ old('email') }}"
                required
            >
            @error('email')
                <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Two columns for phone and position -->
        <div class="form-row">
            <!-- Applicant's Phone Number -->
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    placeholder="Enter phone number"
                    value="{{ old('phone') }}"
                    required
                >
                @error('phone')
                    <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Position Applied For -->
        <!-- Applicant's Years of Experience -->
        <div class="form-group">
            <label for="experience">Years of Experience *</label>
            <input 
                type="number" 
                id="experience" 
                name="experience" 
                placeholder="e.g., 5"
                min="0"
                value="{{ old('experience') }}"
                required
            >
            @error('experience')
                <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Applicant's Cover Letter or Description -->
        <div class="form-group">
            <label for="description">Cover Letter / Description</label>
            <textarea 
                id="description" 
                name="description" 
                placeholder="Tell us why you are a good fit for this position..."
            >{{ old('description') }}</textarea>
            @error('description')
                <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Form actions - Submit and Cancel -->
        <div style="margin-top: 2rem;">
            <!-- Submit button to create the applicant -->
            <button type="submit" class="btn btn-success">Create Applicant</button>
            
            <!-- Cancel button to go back to the list -->
            <a href="{{ route('applicants.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
