# Student Management System (Version 1)

## Project Overview
Student Management System is a simple web-based CRUD application built using PHP and MySQL (MariaDB). This project allows an admin to manage students and departments through a secured login system. It demonstrates relational database design, authentication, and structured CRUD operations following basic production practices.

Version 1 focuses on core functionality:
- Admin authentication
- Dashboard
- Student management (Create, Read, Update)
- Department-based relational structure
- Secure database interaction using prepared statements

---

## Technology Stack
- PHP (Procedural with MySQLi)
- MariaDB / MySQL
- HTML5
- Bootstrap 5
- Apache (XAMPP / Localhost)

---

## Database Structure

### Database: `student_system`

#### Tables

1. admins
   - id
   - name
   - email
   - password (hashed)
   - created_at

2. departments
   - id
   - name
   - status
   - created_at

3. students
   - id
   - first_name
   - last_name
   - email
   - phone
   - department_id (Foreign Key)
   - status
   - created_at
   - updated_at

Relational mapping:
- students.department_id references departments.id

---

## Features (Version 1)

Authentication
- Secure admin login
- Password hashing
- Session-based authentication
- Protected routes using auth check

Dashboard
- Overview section (basic statistics)
- Navigation to student management

Student Management
- Student listing with department join
- Add new student
- Edit student
- Server-side validation
- Department dropdown with active filter
- XSS protection using htmlspecialchars
- SQL Injection protection using prepared statements

Departments
- Linked relationally with students

---

## Folder Structure
# Project Structure

- **config/**: Database config
  - db.php
- **setup/**: Setup scripts
  - tables.php
  - department.php
  - student_insert.php
  - admin_insert.php
- **students/**: Student management
  - index.php
  - create.php
  - store.php
  - edit.php
  - update.php
- **partials/**: Shared partials
  - auth_check.php
- **index.php**: Main entry
- **login.php**: Login page

---

## Security Considerations Implemented

- Password hashing using password_hash
- Prepared statements for INSERT and UPDATE
- Server-side validation
- ID validation (numeric check)
- Department existence validation
- Protection against direct URL access
- Escaping output to prevent XSS

---

## How to Run the Project

1. Clone or copy the project into htdocs (XAMPP).
2. Create a database named `student_system`.
3. Run setup scripts or manually create tables.
4. Configure database connection inside config/db.php.
5. Open http://localhost/project-folder in browser.
6. Login using admin credentials.

---

## Default Admin (If Inserted During Setup)

Email: admin@example.com  
Password: (your configured password)

---

## Known Limitations (Version 1)

- No pagination
- No search functionality
- No delete (or soft delete if not yet implemented)
- No role-based access control
- No CSRF protection
- Basic UI only

---

## Planned Improvements (Future Versions)

- Soft delete system
- Search and pagination
- Flash messages
- Email uniqueness validation
- CSRF protection
- Role-based authentication
- Cleaner MVC-like structure
- API layer
- AJAX-based interactions

---

## Learning Objectives Covered

- Authentication flow
- Relational database design
- JOIN queries
- Prepared statements
- Form handling
- Server-side validation
- Secure session handling
- Basic project architecture

---

## Author
Developed as a learning-oriented web project to demonstrate core PHP and MySQL CRUD system design principles.