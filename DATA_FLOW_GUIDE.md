# OneCitizen Portal - Architecture & Data Flow Guide

This guide provides a detailed, step-by-step breakdown of how data moves through the OneCitizen Portal. It covers how the Application Programming Interface (API) routes work, the role of the Model-View-Controller (MVC) architecture, and how information is permanently stored in the MySQL database.

---

## 1. The MVC Architecture Pattern

Laravel is built on the **Model-View-Controller (MVC)** architectural pattern. This separates the application into three main components:

1.  **View (Frontend):** What the user sees (HTML, CSS, Bootstrap, Blade templates).
2.  **Controller (Middleman):** The brain that receives the user's request, processes business logic, and decides what to do next.
3.  **Model (Database Logic):** The representative of your database. It handles fetching, saving, and securing data.

---

## 2. Detailed Data Flow: "Registering a New Citizen"

To understand the data flow, let's trace the exact path of a single action: **A user registering a new citizen.**

### Step 1: The Request (View ➔ Route)
1. The user navigates to `/citizens/create` in their browser.
2. They fill out the HTML form (found in `resources/views/citizens/create.blade.php`) with details like Full Name, Aadhaar Number, etc.
3. When they click **"Save Citizen"**, the browser packages this data and sends an HTTP `POST` request to the application.

### Step 2: The Routing (API)
The request hits your application's router (`routes/web.php`). 
```php
Route::resource('citizens', CitizenController::class);
```
*How it works:* The `Route::resource` command is a shortcut. It automatically generates all standard API routes for CRUD operations. When it sees a `POST` request to the `/citizens` URL, the router immediately forwards the data to the `store()` method inside the `CitizenController`.

### Step 3: The Controller (Processing & Validation)
The data arrives at `app/Http/Controllers/CitizenController.php`.

```php
public function store(Request $request): RedirectResponse 
{ 
    // 1. Validation
    $validated = $request->validate([ 
        'full_name' => 'required|string|max:255', 
        'aadhaar_number' => 'required|unique:citizens', 
        'mobile_number' => 'required', 
        'state' => 'required', 
    ]); 

    // 2. Execution
    Citizen::create($validated); 

    // 3. Response
    return redirect()->route('citizens.index')
        ->with('success', 'Citizen registered successfully'); 
}
```
*How it works:*
1. **Validation:** The controller checks the incoming data against strict rules. For example, `'unique:citizens'` queries the database to ensure no one else has registered with the same Aadhaar number.
2. **Execution:** If validation passes, it calls the `Citizen` Model's `create()` method, passing the clean data.

### Step 4: The Model & Database Storage
The request is handed to the Model (`app/Models/Citizen.php`).

```php
class Citizen extends Model
{
    protected $fillable = [
        'full_name',
        'aadhaar_number',
        'mobile_number',
        'email',
        // ...
    ];
}
```
*How it works:*
1. **Mass Assignment Security:** The `$fillable` array is a security measure. It tells Laravel, *"Only allow these exact fields to be written to the database."* This prevents a hacker from injecting a malicious field (like `is_admin = true`).
2. **SQL Translation:** The Model takes the PHP array and automatically writes the raw MySQL query (e.g., `INSERT INTO citizens (full_name, aadhaar_number...) VALUES (...)`).
3. **Storage:** The data is permanently saved as a new row in the `citizens` table inside your MySQL database.

### Step 5: The Response (Controller ➔ View)
Once the Model confirms the data is saved, the Controller takes over again:
```php
return redirect()->route('citizens.index')->with('success', 'Citizen registered successfully'); 
```
*How it works:*
1. The Controller tells the user's browser to redirect to the `citizens.index` route (the main Citizens list).
2. It attaches a temporary "flash" session variable containing a success message.
3. The browser loads the index page, the Controller fetches the newly updated list of citizens from the database, and passes them to `index.blade.php`, which renders the updated HTML table for the user to see.

---

## 3. Database Architecture (How Data is Stored)

Your data is stored relationally in MySQL. Here is how the tables interact:

### **`citizens` Table**
- Stores core demographic data (Name, Aadhaar, Mobile, State).
- **Primary Key:** `id` (Auto-incrementing integer).

### **`pension_schemes` Table**
- Stores the details of the available government programs.
- **Primary Key:** `id`.

### **`citizen_pensions` Table (The Pivot / Assignment Table)**
- This is where the magic happens. A citizen can have multiple pensions, and a pension scheme can have multiple citizens. To handle this "Many-to-Many" relationship, we use this assignment table.
- **Foreign Key 1:** `citizen_id` (Links to a specific citizen).
- **Foreign Key 2:** `pension_scheme_id` (Links to a specific scheme).
- **Extra Data:** Stores the `enrollment_number`, `start_date`, and specific `benefit_amount` for that individual assignment.

### **`duplicate_logs` Table**
- Stores records when the system flags two citizens as potential duplicates.
- Uses two Foreign Keys pointing to the `citizens` table (`citizen_id` and `duplicate_with_id`).

---

## Summary Diagram

```text
[User Browser] 
      │ 
      ▼ (HTTP POST /citizens)
[routes/web.php] 
      │ 
      ▼ (Routes to specific method)
[CitizenController@store] 
      │ 
      ├─► Validates Request Data
      │ 
      ▼ (Passes clean data)
[Citizen Model] 
      │ 
      ▼ (Translates to SQL INSERT)
[MySQL Database] (Data is permanently stored in `citizens` table)
      │ 
      ▼ (Success confirmation)
[CitizenController] 
      │ 
      ▼ (Returns Redirect Response)
[User Browser] (Views the updated Citizens List)
```
