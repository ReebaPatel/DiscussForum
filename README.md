# Discuss Forum

A simple Q&A discussion forum built with PHP and MySQL, similar to Stack Overflow. Users can ask questions, provide answers, and browse questions by categories.

## Features

- **User Authentication**
  - User registration and login
  - Session management
  - Password-protected accounts

- **Question Management**
  - Ask questions with title, description, and category
  - View all questions or filter by category
  - Search questions by title
  - View latest questions
  - Delete own questions
  - View user-specific questions

- **Answer System**
  - Post answers to questions
  - View all answers for a question
  - Related questions sidebar

- **Category System**
  - Browse questions by category
  - Category-based filtering
  - Related questions by category

## Technologies Used

- **Backend:** PHP 7.4+
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Session Management:** PHP Sessions

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- phpMyAdmin (optional, for database management)

### Setup Instructions

1. **Clone or download the project**
   ```bash
   git clone <repository-url>
   cd Discuss_Forum
   ```

2. **Create the database**
   ```sql
   CREATE DATABASE DiscussForum;
   ```

3. **Create required tables**
   ```sql
   USE DiscussForum;

   CREATE TABLE `users` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
     `username` VARCHAR(100) NOT NULL,
     `email` VARCHAR(100) NOT NULL UNIQUE,
     `password` VARCHAR(255) NOT NULL,
     `address` TEXT,
     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE `category` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
     `name` VARCHAR(100) NOT NULL,
     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE `questions` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
     `title` VARCHAR(255) NOT NULL,
     `description` TEXT NOT NULL,
     `category_id` INT NOT NULL,
     `user_id` INT NOT NULL,
     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (`category_id`) REFERENCES `category`(`id`) ON DELETE CASCADE,
     FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
   );

   CREATE TABLE `answers` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
     `answer` TEXT NOT NULL,
     `question_id` INT NOT NULL,
     `user_id` INT NOT NULL,
     `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`) ON DELETE CASCADE,
     FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
   );
   ```

4. **Insert sample categories**
   ```sql
   INSERT INTO `category` (`name`) VALUES 
   ('PHP'),
   ('JavaScript'),
   ('MySQL'),
   ('Web Development'),
   ('General');
   ```

5. **Configure database connection**
   
   Update `common/db.php` with your database credentials:
   ```php
   $host = "localhost";
   $username = "root";
   $password = "your_password";
   $database = "DiscussForum";
   ```

6. **Configure web server**
   
   - Place the project in your web server's document root (e.g., `htdocs` for XAMPP)
   - Access via `http://localhost/Discuss_Forum`

## Project Structure

```
Discuss_Forum/
├── client/
│   ├── answers.php          # Display answers for a question
│   ├── ask.php              # Ask a question form
│   ├── category.php         # Category dropdown
│   ├── categorylist.php     # List of all categories
│   ├── commonFiles.php      # Common CSS/JS includes
│   ├── header.php           # Navigation header
│   ├── login.php            # Login form
│   ├── question-details.php # Single question view
│   ├── questions.php        # List of questions
│   └── signup.php           # Registration form
├── common/
│   └── db.php              # Database connection
├── public/
│   ├── logo.png            # Site logo
│   └── style.css           # Custom styles
├── server/
│   ├── index.php           # Main entry point
│   └── requests.php        # Handle all form submissions
└── README.md
```

## Usage

### For Users

1. **Register an Account**
   - Click "SignUp" in the navigation
   - Fill in username, email, password, and address
   - Submit to create your account

2. **Login**
   - Click "Login" in the navigation
   - Enter your email and password
   - Access all features after successful login

3. **Ask a Question**
   - Click "Ask A Question" (requires login)
   - Enter title, description, and select a category
   - Submit to post your question

4. **Answer Questions**
   - Click on any question to view details
   - Scroll down to the answer form
   - Type your answer and submit

5. **Browse Questions**
   - View all questions on the home page
   - Filter by category using the sidebar
   - Search for specific questions using the search bar
   - View "Latest Questions" for recent posts
   - View "My Questions" to see your own posts

6. **Manage Your Questions**
   - Navigate to "My Questions"
   - Click "Delete" next to any question you want to remove
