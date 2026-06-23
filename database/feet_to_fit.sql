CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    role VARCHAR(20) DEFAULT 'user'
);
CREATE TABLE trainers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    specialty VARCHAR(100),
    phone VARCHAR(20),
    image VARCHAR(255)
);
