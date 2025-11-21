# PHP AJAX Login System

A login and registration system built with PHP, MySQL, and AJAX. Created for **CSE376 Database Systems Lab 4** (Fall 2023).

## Features

- User Registration & Login
- AJAX form submission (no page reloads)
- JavaScript validation
- Password encryption (bcrypt)
- Session management
- SQL injection protection
- Responsive design

## Project Structure

- XAMPP (Apache + MySQL)
- Web browser with JavaScript

## Installation

### 1. Clone Repository
```bash
git clone https://github.com/seifmaazouz/php-ajax-login-system.git
```

### 2. Setup Database
1. Start XAMPP (Apache + MySQL)
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Import `database/registration.sql`

### 3. Configure Database
Edit `app/config/db_connect.php` with your credentials:
```php
$host = 'localhost';
$dbname = 'registration';
$username = 'root';  // default XAMPP
$password = '';      // default XAMPP
```

### 4. Deploy
Copy project to `C:\xampp\htdocs\php-ajax-login-system\`

### 5. Access
Open browser: `http://localhost/php-ajax-login-system/`

## Usage

1. **Register**: Fill in name, email, and password
2. **Login**: Enter email and password
3. **Logout**: Click logout button on welcome page

## Security Features

- **Password Hashing**: Uses `password_hash()` with bcrypt algorithm
- **Prepared Statements**: Prevents SQL injection attacks
- **Session Management**: Secure session handling with `session_start()`
- **Input Validation**: Both client-side and server-side validation
- **XSS Protection**: Output escaping where necessary
- **HTTPS Ready**: Can be easily configured for SSL/TLS

## Database Schema

```sql
CREATE TABLE user (
  user_id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(225) NOT NULL,
  name VARCHAR(225) NOT NULL,
  password VARCHAR(225) NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
);
```

## Technologies

- PHP, MySQL
- HTML5, CSS3, JavaScript
- AJAX, XAMPP

## Author

**Seif Maazouz** - [@seifmaazouz](https://github.com/seifmaazouz)

## License

MIT License