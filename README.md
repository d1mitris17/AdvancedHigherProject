# HospitalManagementSystem

Minimal PHP/MySQL web app for **hospital appointment scheduling** with basic conflict checks and simple patient/staff flows. Sketched originally for Advanced Higher Computing.

## Stack
- **PHP** (+ HTML/CSS)
- **MySQL** (see `connect_to_db.php`)
- **JavaScript** form validation (`form_validation_*.js`)

## What it does
- Patient & staff accounts (create/login/edit profile)
- Book, edit, cancel appointments
- List **all appointments**
- **Conflict view** to spot scheduling clashes

## Project map
```
index.php, home.php               # landing & dashboard
NewPatientAccountForm.php         # patient signup (+ validator)
NewStaffForm.php                  # staff signup (+ validator)
BookAppointment.php / 2.php       # booking flow (+ validator)
EditableAppointment.php           # edit existing appointment
FinaliseAppointment.php           # confirm/save booking
all_appointments.php              # admin/staff overview
show_conflicts.php                # highlight clashes
profile.php / EditableProfile.php # view/edit profile (+ validator)
delete_app.php, signout.php
connect_to_db.php                 # DB credentials
style.css, /images
```

## Run locally (quick)
1. Clone:  
   ```bash
   git clone https://github.com/d1mitris17/AdvancedHigherProject.git
   ```
2. Put the folder in your PHP server root (XAMPP/MAMP/WAMP) and start Apache + MySQL.
3. Create a MySQL DB (e.g., `hospital_db`). Update creds in `connect_to_db.php`.
4. Create tables/seed data to match your fields (see forms & insert queries in the PHP files).
5. Visit: `http://localhost/AdvancedHigherProject/index.php`

## Notes
- Built as a **course project**; security/hardening (e.g., password hashing, CSRF) is minimal.
- Conflict logic is surfaced via `show_conflicts.php` and related booking pages.
- Uses lightweight JS validation in `form_validation_*.js`.

## License
Educational/demo use.
