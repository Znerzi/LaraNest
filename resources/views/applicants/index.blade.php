@extends('layout')

@section('title', 'Applicants List')

@section('content')
    <h1>All Applicants</h1>
    
    <!-- Search and Filter Box -->
    <div class="search-box">
        <form method="GET" action="{{ route('applicants.index') }}">
            <!-- Search by name or email -->
            <input 
                type="text" 
                name="search" 
                placeholder="Search by name or email..."
                value="{{ $search ?? '' }}"
            >
            
            <!-- Filter by status -->
            <select name="status">
                <option value="">All Status</option>
                <option value="new" {{ $filterStatus == 'new' ? 'selected' : '' }}>New</option>
                <option value="under review" {{ $filterStatus == 'under review' ? 'selected' : '' }}>Under Review</option>
                <option value="accepted" {{ $filterStatus == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="rejected" {{ $filterStatus == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            
            <!-- Submit button to filter results -->
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">Filter</button>
        </form>
    </div>
    
    <!-- Button to create new applicant -->
    <a href="{{ route('applicants.create') }}" class="btn btn-success">+ Add New Applicant</a>
    
    <!-- Check if there are any applicants -->
    @if($applicants->count() > 0)
        <!-- Table to show all applicants -->
        <table style="margin-top: 1.5rem;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each applicant and show in a row -->
                @foreach($applicants as $applicant)
                    <tr>
                        <!-- Show the applicant's ID -->
                        <td>{{ $applicant->id }}</td>
                        
                        <!-- Show the applicant's name -->
                        <td>{{ $applicant->name }}</td>
                        
                        <!-- Show the applicant's email -->
                        <td>{{ $applicant->email }}</td>
                        
                        <!-- Show the applicant's phone -->
                        <td>{{ $applicant->phone }}</td>
                        
                        <!-- Show the position they applied for -->
                        <td>{{ $applicant->position }}</td>
                        
                        <!-- Show years of experience -->
                        <td>{{ $applicant->experience }} years</td>
                        
                        <!-- Show status with a colored badge -->
                        <td>
                            <span class="badge badge-{{ str_replace(' ', '-', strtolower($applicant->status)) }}">
                                {{ $applicant->status }}
                            </span>
                        </td>
                        
                        <!-- Action buttons to view, edit, or delete -->
                        <td>
                            <div class="actions">
                                <!-- View button - shows full details -->
                                <a href="{{ route('applicants.show', $applicant) }}" class="btn btn-primary">View</a>
                                
                                <!-- Edit button - shows form to edit -->
                                <a href="{{ route('applicants.edit', $applicant) }}" class="btn btn-warning">Edit</a>
                                
                                <!-- Delete button - removes from database -->
                                <form method="POST" action="{{ route('applicants.destroy', $applicant) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this applicant?');">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Show pagination links if there are many applicants -->
        <div style="margin-top: 2rem;">
            {{ $applicants->links() }}
        </div>
    @else
        <!-- Show message if no applicants found -->
        <p style="margin-top: 1.5rem;">No applicants found. <a href="{{ route('applicants.create') }}">Create one now</a></p>
    @endif
@endsection
