# 🛠️ Setup & Installation Guide

Complete step-by-step guide to get **FEET TO FIT** running on your system.

---

## 📋 Requirements

### System Requirements
- **OS:** Windows, macOS, or Linux
- **PHP:** 7.4 or higher
- **MySQL:** 5.7 or higher (or MariaDB 10.3+)
- **Web Server:** Apache 2.4+ or Nginx
- **Browser:** Modern browser (Chrome, Firefox, Safari, Edge)

### Development Tools
- **Git** - For cloning the repository
- **Composer** - PHP package manager (optional)
- **Code Editor** - VS Code, PHPStorm, or similar

---

## 🚀 Installation Steps

### Step 1: Clone the Repository

```bash
git clone https://github.com/lynphefry/db_feet.git
cd db_feet
```

### Step 2: Install Local Development Environment

Choose one of the following:

#### Option A: Using XAMPP (Recommended for Beginners)

1. Download & install [XAMPP](https://www.apachefriends.org/)
2. Start Apache and MySQL from XAMPP Control Panel
3. Navigate to `C:\xampp\htdocs` (Windows) or `/Applications/XAMPP/htdocs` (Mac)
4. Clone the repository: `git clone https://github.com/lynphefry/db_feet.git`

#### Option B: Using Docker

```bash
docker-compose up -d
```

#### Option C: Manual Setup

Install PHP, MySQL, and a web server following your OS-specific guides.

### Step 3: Database Setup

#### Create Database

```bash
# Connect to MySQL
mysql -u root -p

# Create database
CREATE DATABASE feet_to_fit;
USE feet_to_fit;
```

#### Import Schema

If a schema file exists:
```bash
mysql -u root -p feet_to_fit < database/schema.sql
```

#### Or Create Tables Manually

```sql
-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    role ENUM('user', 'admin', 'trainer') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Trainers Table
CREATE TABLE trainers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100),
    bio TEXT,
    experience_years INT,
    image_url VARCHAR(255),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Classes Table
CREATE TABLE classes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    trainer_id INT,
    capacity INT,
    duration_minutes INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trainer_id) REFERENCES trainers(id)
);

-- Bookings Table
CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    class_id INT NOT NULL,
    booking_date DATE NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'confirmed',
    booked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (class_id) REFERENCES classes(id)
);

-- Memberships Table
CREATE TABLE memberships (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    plan VARCHAR(50),
    start_date DATE NOT NULL,
    end_date DATE,
    status ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
    price DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Products Table
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT DEFAULT 0,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cart Table
CREATE TABLE cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Orders Table
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2),
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    payment_method VARCHAR(50),
    ordered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Payments Table
CREATE TABLE payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    user_id INT,
    amount DECIMAL(10, 2),
    phone_number VARCHAR(20),
    transaction_id VARCHAR(100),
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Step 4: Configure Database Connection

Edit `db.php` with your database credentials:

```php
<?php

$conn = mysqli_connect(
    "localhost",          // Host (usually localhost)
    "root",               // Username (usually root)
    "",                   // Password (empty for XAMPP default)
    "feet_to_fit"         // Database name
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
```

### Step 5: Configure Web Server

#### For Apache
1. Enable mod_rewrite: `a2enmod rewrite`
2. Update `DocumentRoot` to point to the project:
   ```apache
   DocumentRoot "/path/to/db_feet"
   ```
3. Create `.htaccess` (optional for URL rewriting)
4. Restart Apache: `sudo systemctl restart apache2`

#### For Nginx
Add to your server block:
```nginx
server {
    listen 80;
    server_name localhost;
    root /path/to/db_feet;
    index index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

### Step 6: Create Required Directories

```bash
mkdir -p assets/images
mkdir -p database
mkdir -p uploads
```

### Step 7: Set File Permissions

```bash
chmod -R 755 assets/
chmod -R 755 uploads/
chmod 644 db.php
```

### Step 8: M-Pesa Configuration (Optional)

Add your M-Pesa credentials to `mpesa.php`:

```php
<?php

define('MPESA_CONSUMER_KEY', 'your_consumer_key');
define('MPESA_CONSUMER_SECRET', 'your_consumer_secret');
define('MPESA_BUSINESS_CODE', 'your_business_code');
define('MPESA_PASSKEY', 'your_passkey');
define('MPESA_CALLBACK_URL', 'https://yoursite.com/callback.php');

?>
```

---

## ▶️ Running the Application

### Option 1: Using PHP Built-in Server

```bash
cd db_feet
php -S localhost:8000
```

Access at: `http://localhost:8000`

### Option 2: Using Apache

```bash
sudo systemctl start apache2
```

Access at: `http://localhost/db_feet`

### Option 3: Using XAMPP GUI

1. Open XAMPP Control Panel
2. Click "Start" on Apache and MySQL
3. Navigate to `http://localhost/db_feet`

---

## 🔧 Post-Installation Configuration

### 1. Create Test Admin Account

```sql
-- Hash the password (use PHP password_hash or online tool)
INSERT INTO users (username, email, password, first_name, role) 
VALUES ('admin', 'admin@feettofit.com', '$2y$10$...hashed_password...', 'Admin', 'admin');
```

### 2. Add Sample Trainers

```sql
INSERT INTO trainers (name, specialty, bio, experience_years) 
VALUES ('John Doe', 'Strength Training', 'Expert in weight training', 8);

INSERT INTO trainers (name, specialty, bio, experience_years) 
VALUES ('Jane Smith', 'Yoga & Pilates', 'Certified yoga instructor', 6);
```

### 3. Create Sample Classes

```sql
INSERT INTO classes (name, description, trainer_id, capacity, duration_minutes) 
VALUES ('Morning Yoga', 'Relaxing yoga session', 2, 20, 60);

INSERT INTO classes (name, description, trainer_id, capacity, duration_minutes) 
VALUES ('Strength Training', 'Build muscle with weights', 1, 15, 90);
```

---

## 🧪 Testing the Setup

### Verify Database Connection

Create `test_connection.php`:

```php
<?php
include 'db.php';

if ($conn) {
    echo "✅ Database connection successful!";
    
    $result = mysqli_query($conn, "SELECT 1");
    if ($result) {
        echo "<br>✅ Query execution successful!";
    }
} else {
    echo "❌ Connection failed: " . mysqli_connect_error();
}
?>
```

Access: `http://localhost/db_feet/test_connection.php`

### Verify PHP Version

Create `phpinfo.php`:

```php
<?php
phpinfo();
?>
```

Access: `http://localhost/db_feet/phpinfo.php`

---

## 🐛 Troubleshooting

### Issue: "Connection failed: Unknown database"

**Solution:** Verify database name in `db.php` matches the created database.

```bash
mysql -u root -p -e "SHOW DATABASES;"
```

### Issue: "Can't connect to MySQL server"

**Solution:** Ensure MySQL is running.

```bash
# Linux
sudo systemctl start mysql

# macOS
brew services start mysql

# Windows
# Start via Services or XAMPP Control Panel
```

### Issue: "PHP file not executed, shows source code"

**Solution:** Install PHP or enable PHP in web server.

```bash
# Ubuntu/Debian
sudo apt-get install php php-mysql php-curl

# Restart web server
sudo systemctl restart apache2
```

### Issue: "Permission denied" errors

**Solution:** Fix file permissions.

```bash
chmod -R 755 db_feet/
chmod -R 777 uploads/
chmod -R 777 assets/
```

### Issue: "CORS" or cross-origin errors with M-Pesa

**Solution:** Update `.htaccess` in project root:

```apache
<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE"
</IfModule>
```

---

## 📚 Additional Resources

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [M-Pesa API Guide](https://developer.safaricom.co.ke/)
- [XAMPP Tutorials](https://www.apachefriends.org/faq.html)

---

## ✅ Verification Checklist

- [ ] Git repository cloned
- [ ] MySQL database created
- [ ] Database tables created
- [ ] `db.php` configured
- [ ] Web server running
- [ ] PHP properly installed
- [ ] File permissions set
- [ ] Test admin user created
- [ ] Sample data added
- [ ] Application accessible at `http://localhost/db_feet`

---

## 🎉 You're Ready!

Your FEET TO FIT installation is complete. Start by:

1. Navigating to `http://localhost/db_feet`
2. Registering a new account
3. Logging in with your credentials
4. Exploring the platform

For issues or questions, contact: **info@feettofit.com**

---

*Happy coding! 💪*
