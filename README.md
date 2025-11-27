# University Portal System

A PHP-based university management system for handling student enrollment, grading, and financial collections.

## Features

- **Admin Portal**: Manage students, courses, subjects, semesters, rooms, teachers, and grades
- **Teacher Portal**: Grade management with Excel paste support for bulk entry, manage assigned subjects
- **Student Portal**: View grades, collections, and payment history
- **Collections Management**: Track payments with OR number generation and history
- **Enrollment System**: Handle student course enrollments

## Tech Stack

- **Backend**: PHP 8.0+ with PDO/MySQL
- **Frontend**: Tailwind CSS, Alpine.js
- **PDF Generation**: FPDF library
- **Design**: Flat, minimalistic UI (shadcn-inspired)

## Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) with mod_rewrite enabled
- Composer (optional, for dependency management)

## Setup

1. **Clone the repository**:

   ```bash
   git clone https://github.com/shimijallores/myUni.git
   cd myUni
   ```

2. **Database Setup**:

   - Create a MySQL database
   - Import `database/database.sql` into your database

3. **Configuration**:

   - Update database connection details in `partials/database.php`

4. **Web Server Configuration**:

   - Point your web server document root to the project directory
   - Ensure PHP is enabled and configured

5. **Access the Application**:
   - Open your browser and navigate to the application URL

## Default Credentials

- **Admin**: Configure in the `users` table in the database
- **Teachers**: Use code-based authentication (default: 'AAAAAAAAAA')
- **Students**: Use student number as username and configured password

## Usage

- **Admin**: Access admin functions through the admin login
- **Teachers**: Login with teacher code to manage grades and subjects
- **Students**: Login with student number to view personal information

## Project Structure

```
├── auth/              # Authentication logic
├── collections/       # Payment & OR management
├── courses/          # Course CRUD operations
├── database/         # Database schema and setup
├── enrollment/       # Student enrollment management
├── fpdf186/          # PDF generation library
├── grades/           # Grade management system
├── images/           # Static images
├── partials/         # Reusable components (sidebar, header, footer, database)
├── rooms/            # Room management
├── semesters/        # Semester CRUD operations
├── student/          # Student portal pages
├── students/         # Student CRUD (admin)
├── subjects/         # Subject CRUD operations
├── teacher/          # Teacher portal pages
├── teacher_subjects/ # Teacher-subject assignments
├── teachers/         # Teacher CRUD operations
├── functions.php     # Utility functions
├── index.php         # Main entry point
├── list.php          # List view
├── logout.php        # Logout functionality
├── menu.php          # Menu component
├── report.php        # Reporting features
└── README.md         # This file
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is built as a requirement for Intelligent Systems course.
