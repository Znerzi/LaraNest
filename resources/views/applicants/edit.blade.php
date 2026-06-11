@extends('layout')

@section('title', 'Edit Applicant')

@section('content')
    <h1>Edit Applicant: {{ $applicant->name }}</h1>
    
    <!-- Form to update the applicant -->
    <form method="POST" action="{{ route('applicants.update', $applicant) }}" style="background: white; padding: 2rem; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        @csrf
        @method('PATCH') <!-- This tells Laravel to use PATCH method for updating -->
        
        <!-- Applicant's Full Name -->
        <div class="form-group">
            <label for="name">Applicant Name *</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Enter full name"
                value="{{ old('name', $applicant->name) }}"
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
                value="{{ old('email', $applicant->email) }}"
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
                    value="{{ old('phone', $applicant->phone) }}"
                    required
                >
                @error('phone')
                    <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Position Applied For -->
            <div class="form-group">
                <label for="position">Position Applied For *</label>
                <input 
                    type="text" 
                    id="position" 
                    name="position" 
                    placeholder="e.g., Software Developer, Manager"
                    value="{{ old('position', $applicant->position) }}"
                    required
                >
                @error('position')
                    <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Applicant's Years of Experience -->
        <div class="form-group">
            <label for="experience">Years of Experience *</label>
            <input 
                type="number" 
                id="experience" 
                name="experience" 
                placeholder="e.g., 5"
                min="0"
                value="{{ old('experience', $applicant->experience) }}"
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
            >{{ old('description', $applicant->description) }}</textarea>
            @error('description')
                <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Application Status - only shown on edit -->
        <div class="form-group">
            <label for="status">Application Status *</label>
            <select id="status" name="status" required>
                <option value="new" {{ $applicant->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="under review" {{ $applicant->status == 'under review' ? 'selected' : '' }}>Under Review</option>
                <option value="accepted" {{ $applicant->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="rejected" {{ $applicant->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status')
                <p style="color: red; font-size: 0.9rem;">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Form actions - Submit and Cancel -->
        <div style="margin-top: 2rem;">
            <!-- Submit button to save changes -->
            <button type="submit" class="btn btn-success">Update Applicant</button>
            
            <!-- Cancel button to go back -->
            <a href="{{ route('applicants.show', $applicant) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
