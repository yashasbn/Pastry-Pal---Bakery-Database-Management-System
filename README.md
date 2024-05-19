## Pastry-Pal - Bakery Database Management System

**Pastry-Pal** is a web application designed to manage bakery data, allowing users to easily track and organize pastries, ingredients, and potentially even customers. 

**This README file provides information on how to set up and use the Pastry-Pal application.**

**Important Note:** The default login credentials for the administrator account are:

* Username: admin
* Password: 1234

**Please be sure to change the default password for security reasons.**

**Prerequisites:**

* A web server with PHP 
* A database server (e.g., MySQL)

**Installation:**

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yashasbn/Pastry-Pal---Bakery-Database-Management-System.git
   ```

2. **Configure database connection:**

    * Edit the `config.php` file located in the project root directory.
    * Update the database connection details (host, username, password, database name) according to your database setup.

3. **Import database schema (if not included):**

    * If the project includes a database schema file (e.g., `pastry_pal.sql`), import it into your database using your preferred method (e.g., phpMyAdmin).

4. **Upload files:**

    * Upload the entire `pastry-pal` directory to your web server's document root.

**Usage:**

1. Access the application in your web browser by visiting: `http://your-domain.com/pastry-pal/` (replace `your-domain.com` with your actual domain).
2. Login using the administrator credentials.
3. You can now manage bakery data (pastries, ingredients, etc.) through the provided interface.

