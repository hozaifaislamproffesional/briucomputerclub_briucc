-- briu_club database schema (MySQL)
CREATE DATABASE IF NOT EXISTS briu_club CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE briu_club;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  student_id VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(200) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','member','volunteer') DEFAULT 'member',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  event_date DATE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS event_registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_id INT NOT NULL,
  user_id INT NOT NULL,
  registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  status ENUM('registered','attended','cancelled') DEFAULT 'registered',
  FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS notices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  body TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample events
INSERT INTO events (title, description, event_date) VALUES
('Intro to Python Workshop','Hands-on Python basics and projects','2025-12-10'),
('Web Development Bootcamp','HTML, CSS, JS, and PHP crash course','2025-12-20'),
('Machine Learning Basics','An intro seminar to ML concepts','2026-01-15');

-- sample admin user (password: admin123)
INSERT INTO users (name, student_id, email, password_hash, role) VALUES
('Admin User','admin001','admin@briu.edu.bd', '$2y$10$e0NRdG/0rK1Qz1bCq3VfXu6Kq9sKf3g1G7kPz6h0wYf8xQp6aZbqW', 'admin');
