# Applicant Management System - CRUD Application

## Overview
This is a simple **CRUD (Create, Read, Update, Delete)** application built with **Laravel** to manage job applicants. It helps you track applicants for job positions, their experience, and the status of their applications.

---

## What is CRUD?
**CRUD** stands for:
- **C**reate - Add new applicants
- **R**ead - View applicant details
- **U**pdate - Edit applicant information
- **D**elete - Remove applicants

---

## Features of This Application

### 1. **View All Applicants**
   - See a list of all applicants
   - See their name, email, phone, position, experience, and status
   - See all information on one page

### 2. **Search Applicants**
   - Search by applicant name
   - Search by applicant email
   - Real-time search results

### 3. **Filter by Status**
   - Filter applicants by their application status:
     - **New** - Just applied
     - **Under Review** - Being reviewed
     - **Accepted** - Application accepted
     - **Rejected** - Application rejected

### 4. **Add New Applicant**
   - Create a new applicant record
   - Enter: Name, Email, Phone, Position, Experience, Cover Letter
   - Data is saved to the database automatically

### 5. **View Applicant Details**
   - Click on any applicant to see full details
   - See the date and time they applied
   - See when their record was last updated

### 6. **Edit Applicant**
   - Update any applicant's information
   - Change their status (New → Under Review → Accepted/Rejected)
   - All changes are saved automatically

### 7. **Delete Applicant**
   - Remove an applicant from the system
   - Cannot be undone (confirmation required)

---

## Project Structure

### Files and Folders

```
app/
├── Http/
│   └── Controllers/
│       └── ApplicantController.php    ← Contains all business logic (CRUD methods)
└── Models/
    └── Applicant.php                  ← Database model (connects to applicants table)

database/
└── migrations/
    └── 2026_06_11_095356_create_applicants_table.php  ← Creates applicants table

resources/
└── views/
    ├── layout.blade.php               ← Main template with navigation and styling
    └── applicants/
        ├── index.blade.php            ← List all applicants, search, filter
        ├── create.blade.php           ← Form to add new applicant
        ├── edit.blade.php             ← Form to edit applicant
        └── show.blade.php             ← View applicant details

routes/
└── web.php                            ← URL routes for the application
```

---

## Database Structure

### Applicants Table

| Column | Type | Description |
|--------|------|-------------|
| id | Integer (Primary Key) | Unique identifier for each applicant |
| name | String | Applicant's full name |
| email | String | Applicant's email (unique) |
| phone | String | Applicant's phone number |
| position | String | Position they are applying for |
| experience | Integer | Years of experience |
| description | Text | Cover letter or description |
| status | String | Application status (new, under review, accepted, rejected) |
| created_at | Timestamp | Date and time applicant was created |
| updated_at | Timestamp | Date and time record was last updated |

---

## How to Use the Application

### Step 1: Start the Server
```bash
php artisan serve
```
- This starts the development server
- Open http://localhost:8000/applicants in your browser
- Default port is 8000

### Step 2: Add an Applicant
1. Click **"Add New Applicant"** button
2. Fill in the form:
   - Name (required)
   - Email (required, must be unique)
   - Phone (required)
   - Position (required)
   - Experience (required, number of years)
   - Description/Cover Letter (optional)
3. Click **"Create Applicant"** button
4. You will see a success message

### Step 3: View Applicants
1. You will see a table with all applicants
2. Each row shows:
   - ID (auto-generated)
   - Name
   - Email
   - Phone
   - Position
   - Experience
   - Status (with colored badge)
   - Action buttons (View, Edit, Delete)

### Step 4: Search for Applicants
1. In the search box at the top, type:
   - Applicant's name (e.g., "John")
   - Applicant's email (e.g., "john@example.com")
2. Click **"Filter"** button
3. Results will show matching applicants

### Step 5: Filter by Status
1. In the status dropdown, select:
   - "All Status" (default, shows all)
   - "New" (newly submitted applications)
   - "Under Review" (being reviewed)
   - "Accepted" (accepted applications)
   - "Rejected" (rejected applications)
2. Click **"Filter"** button
3. Only applicants with that status will show

### Step 6: View Applicant Details
1. Click the **"View"** button next to an applicant
2. You will see:
   - All their information
   - Cover letter
   - Date they applied
   - Last updated date

### Step 7: Edit an Applicant
1. Click the **"Edit"** button next to an applicant
2. You can change:
   - Name, Email, Phone, Position, Experience, Description
   - **Status** (to track application progress)
3. Click **"Update Applicant"** button
4. Changes are saved automatically

### Step 8: Delete an Applicant
1. Click the **"Delete"** button next to an applicant
2. A confirmation popup will ask: "Are you sure?"
3. Click OK to confirm deletion
4. Applicant will be removed from the database permanently

---

## Understanding the Code

### Controller (ApplicantController.php)

The controller is like the "brain" of the application. It handles all the logic:

#### `index()` - Show All Applicants
```php
// Gets the search keyword from the user
$search = $request->input('search');

// Builds a database query to find matching applicants
$query = Applicant::query();
if ($search) {
    $query->where('name', 'LIKE', '%' . $search . '%')
          ->orWhere('email', 'LIKE', '%' . $search . '%');
}

// Get applicants from database and show them
$applicants = $query->paginate(10);
return view('applicants.index', compact('applicants'));
```

#### `create()` - Show Create Form
```php
// Simply return the form view
return view('applicants.create');
```

#### `store()` - Save New Applicant
```php
// Validate the form data
$validated = $request->validate([
    'name' => 'required|string|max:100',
    'email' => 'required|email|unique:applicants',
    // ... other fields
]);

// Save to database
Applicant::create($validated);

// Redirect with success message
return redirect()->route('applicants.index')->with('success', 'Created!');
```

#### `edit()` - Show Edit Form
```php
// Get the applicant and show edit form
return view('applicants.edit', compact('applicant'));
```

#### `update()` - Update Applicant
```php
// Validate new data
$validated = $request->validate([...]);

// Update the applicant in database
$applicant->update($validated);

// Redirect with success message
return redirect()->route('applicants.show', $applicant)->with('success', 'Updated!');
```

#### `destroy()` - Delete Applicant
```php
// Delete from database
$applicant->delete();

// Redirect with success message
return redirect()->route('applicants.index')->with('success', 'Deleted!');
```

---

### Model (Applicant.php)

The model represents the applicant data:

```php
class Applicant extends Model
{
    // These fields can be filled when creating/updating
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'experience',
        'description',
        'status',
    ];
}
```

---

### Views (Blade Templates)

Views are the HTML pages users see:

- **layout.blade.php** - Main template with styling and navigation
- **index.blade.php** - List all applicants with search/filter
- **create.blade.php** - Form to add new applicant
- **edit.blade.php** - Form to edit applicant
- **show.blade.php** - View applicant details

#### Using Variables in Views
```html
<!-- Show applicant name -->
{{ $applicant->name }}

<!-- Loop through all applicants -->
@foreach($applicants as $applicant)
    <p>{{ $applicant->name }}</p>
@endforeach

<!-- Show error messages -->
@error('email')
    <p>{{ $message }}</p>
@enderror
```

---

### Routes (web.php)

Routes connect URLs to controller methods:

```php
Route::resource('applicants', ApplicantController::class);
```

This creates:
- GET /applicants → index() - Show all
- GET /applicants/create → create() - Show create form
- POST /applicants → store() - Save new
- GET /applicants/{id} → show() - View details
- GET /applicants/{id}/edit → edit() - Show edit form
- PUT /applicants/{id} → update() - Update
- DELETE /applicants/{id} → destroy() - Delete

---

## Common Tasks

### Add a New Field to Applicant
1. Create a new migration:
   ```bash
   php artisan make:migration add_field_to_applicants_table
   ```
2. Edit the migration file in `database/migrations/`
3. Run migration:
   ```bash
   php artisan migrate
   ```
4. Add field to `$fillable` in `app/Models/Applicant.php`
5. Add form input in `create.blade.php` and `edit.blade.php`
6. Update validation in controller

### Change Status Options
Edit the status values in:
1. Migration file: `2026_06_11_095356_create_applicants_table.php`
2. Controller: `app/Http/Controllers/ApplicantController.php`
3. Edit view: `resources/views/applicants/edit.blade.php`
4. CSS badges in layout

### Add More Search Fields
In `app/Http/Controllers/ApplicantController.php`, add to the search logic:
```php
if ($search) {
    $query->where('name', 'LIKE', '%' . $search . '%')
          ->orWhere('email', 'LIKE', '%' . $search . '%')
          ->orWhere('position', 'LIKE', '%' . $search . '%'); // Add position search
}
```

---

## Validation Rules Explained

In the controller, we validate form data:

| Rule | Meaning |
|------|---------|
| required | Field must have a value |
| string | Field must be text |
| email | Field must be a valid email |
| unique:applicants | Email must be unique in applicants table |
| integer | Field must be a whole number |
| min:0 | Value must be at least 0 |
| max:100 | Text maximum 100 characters |
| nullable | Field is optional (can be empty) |
| in:new,under review,accepted,rejected | Must be one of these values |

---

## How Data Flows

### Creating an Applicant (Step by Step)
1. User clicks "Add New Applicant"
2. Browser goes to: `GET /applicants/create`
3. Laravel calls: `ApplicantController@create()`
4. Returns: `create.blade.php` form
5. User fills form and clicks "Create"
6. Form sends: `POST /applicants` with data
7. Laravel calls: `ApplicantController@store(request)`
8. Controller validates data
9. If valid: `Applicant::create($data)` saves to database
10. Redirects to list with success message
11. If invalid: Shows error messages

### Updating an Applicant
1. User clicks "Edit" button
2. Browser goes to: `GET /applicants/5/edit` (5 is applicant ID)
3. Laravel calls: `ApplicantController@edit(applicant)`
4. Returns: `edit.blade.php` form with current data
5. User changes data and clicks "Update"
6. Form sends: `PATCH /applicants/5` with new data
7. Laravel calls: `ApplicantController@update(request, applicant)`
8. Controller validates and saves changes
9. Redirects to details page with success message

---

## Keyboard Shortcuts and Tips

- Type in search box and click Filter to search
- Use browser back button to go to previous page
- Email addresses must be unique (can't have duplicates)
- Pagination shows 10 applicants per page
- All dates show in format: DD/MM/YYYY HH:MM

---

## Troubleshooting

### Error: "Column not found"
- Run migrations: `php artisan migrate`

### Error: "UNIQUE constraint failed"
- Email already exists, use a different email

### Error: "The page doesn't exist"
- Make sure you're on the correct URL: `http://localhost:8000/applicants`

### Form validation fails
- Check that all required fields are filled
- Email must be valid format
- Experience must be a number

---

## Summary

You now have a complete CRUD application for managing applicants! 

**Key Concepts:**
- Model = Database table representation
- Controller = Business logic (CRUD operations)
- View = HTML pages users see
- Routes = URLs that connect to controllers
- Migration = Creates/modifies database tables

**CRUD Operations:**
- Create: Add new applicants
- Read: View applicants and search
- Update: Edit applicant information and status
- Delete: Remove applicants

Happy coding! 🚀
