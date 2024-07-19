# 📚 Login Coding Challenge

Welcome to the Login Coding Challenge! 🎉

This is a simple PHP-based dashboard application with functionalities for user login and management.

## 🗂️ Project Structure

- **root/**
  - `classes/`
    - `News.php` – Defines the News class.
    - `Notification.php` – Handles notifications.
    - `NotificationType.php` – Enum for notification types (success or error).
  - `config/`
    - `connect.php` – Database connection configuration.
  - `resources/`
    - `media/` – Media files.
    - `script.js` – JavaScript functionalities.
    - `style.css` – Styling for the application.
  - `utils/`
    - `login.php` – Handles user login.
    - `notifications.php` – Manages notifications.
  - `dashboard.php` – Main dashboard view for logged-in users.
  - `header.html` – HTML template for header.
  - `index.php` – Login page.
  - `login.php` – Login form logic and template.
  - `controller.php` – Handles routing and CRUD operations.

## 🚀 Getting Started

1. **Install XAMPP:**

   - Download and install XAMPP from the official website: [XAMPP Download](https://www.apachefriends.org/index.html). This will provide you with PHP, MySQL, and Apache.

2. **Clone the Repository:**

   ```bash
   git clone https://github.com/Charly-Wolf/login-cgrd
   ```

- After cloning the repository, move the folder into the `htdocs` directory of your XAMPP installation. By default, this directory is located at `C:\xampp\htdocs` on Windows or `/Applications/XAMPP/htdocs` on macOS.

3. **Set Up the Environment:**

   - **Configure the Database:**
     - Open `config/connect.php` and configure the database settings (hostname, username, password, database name and port).
     - If the database or tables are not created, they will be automatically created the first time you access the app. An initial "admin" user will also be created with username: `admin` and password: `test`.

4. **Run the Application:**

   - **Start XAMPP Control Panel:**

     - Launch the XAMPP Control Panel and start the Apache and MySQL services.

   - **Access the Application:**
     - Open your web browser and visit `http://localhost/<repo_folder_name>/index.php`, where `<repo_folder_name>` is the name of your repository folder you placed in `htdocs`.

5. Login and test the App!
   - **Use test credentials**
     - Username: `admin`
     - Passwrod: `test`

## 🛠️ Features

- **User Login:** Secure login system to access the dashboard.
- **News Management:** Create, edit, and delete news items. 🗞️
- **Notifications:** Informative messages for user actions. 🛎️

## ✨ Usage

- **Login:** Enter your username and password on the login page.
- **Dashboard:** View and manage news items. Click buttons to edit or delete news. Use the form to create or update news.

## 🛑 Troubleshooting

- **Database Connection Issues:** Check `config/connect.php` for correct database credentials.
- **Login Issues:** Ensure that the `users` table has proper username and password data.

---

Enjoy using the CGRD Dashboard! If you have any questions, feel free to reach out. 😊
