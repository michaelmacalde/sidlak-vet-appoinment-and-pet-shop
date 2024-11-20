# Sidlak-Dog-Adoption-System 🐾
# Researcher Team: ✅ Nonilo Aujero, ✅ Rey Oridina, ✅ Glydel Villareza, ✅ Mini Diaz

![FireShot Capture 037 - Sidlak Animal Welfare - SDAS - sidlak-animal-welfare test](https://github.com/user-attachments/assets/3afc95a1-29d5-4c52-a1c1-b20c829ea0e4)


✅ Web-Based Adoption, Donation and Volunteering Report System for Unsheltered Dogs of Sidlak Animal Welfare Group of Victorias City

COLLEGIO DE STA ANA DE VICTORIAS INC.

The **Sidlak Dog Adoption System** is a web application designed to streamline dog adoption processes. Built using the **TALL Stack** (TailwindCSS, Alpine.js, Laravel, and Livewire), it leverages **Laravel 11** for robust backend functionality and a modern user experience.

The Web-based adoption, Donation and volunteering Report System for unsheltered Dogs was intended to focus on enhancing the process and services of Sidlak Animal Welfare Group of Victorias City. It offers functionalities for the shelter to manage the adoption, donation and volunteering process, a web-based system that can be accessed online, and this was managed by designated administrators and staff that help manage,keep track, and maintain the system.

The web-based platform facilitates the management of adoption, donation and volunteering processes, accessible remotely by designated administrators and staff.
The system’s effectiveness relies heavily on reliable internet connectivity within the shelter and in the user for the successful implementation of the system depends on how the shelter and the user will access the system. giving a guide or a training on how to use the website and have a user friendly system will help them understand the process.

---

## ✨ Features

- 🐶 **Dog Management**: Add, update, and list available dogs for adoption.
- 👤 **User Roles**: Role-based access control for admins and users.
- 📋 **Adoption Requests**: Real-time updates and tracking of adoption applications.
- 🌐 **TALL Stack**: Dynamic components and styling with TailwindCSS, Alpine.js, and Livewire.
- 🔐 **Secure Authentication**: Protect sensitive data with Laravel's built-in security features.

---

## ⚙️ Requirements

Ensure your environment meets these prerequisites:

- **PHP**: >= 8.2
- **Composer**
- **Node.js**: >= 18.x
- **Database**: MySQL or compatible
- **Laravel**: Version 11
- **Git**

---

## 🛠️ Installation

Follow the steps below to set up the project locally:

### 1️⃣ Clone the Repository
```
git clone https://github.com/your-username/sidlak-dog-adoption-system.git
cd sidlak-dog-adoption-system
```

### 2️⃣ Install Dependencies
PHP Dependencies
Run the following command to install PHP dependencies using Composer:
```
composer install
```
Node.js Dependencies
Run the following command to install Node.js dependencies:
```
npm install
```

### 3️⃣ Configure Environment
1. Create the .env file by copying from .env.example:
```
cp .env.example .env
```
2. Open the .env file and update the following fields with your specific environment details:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4️⃣ Generate Application Key
Run the following command to generate a unique application key:
```
php artisan key:generate
```

### 5️⃣ Set Up the Database
- Run migrations to create the necessary database tables:
```
php artisan migrate
```
- Seed the database with initial data:
```
php artisan db:seed
```

### 6️⃣ Build Frontend Assets
Development Build
Run the following command to compile the frontend assets for development:
```
npm run dev
```
Production Build
For production, use:
```
npm run build
```

### 7️⃣ Start the Application
Start the Laravel development server with:
```
php artisan serve
```
Visit the application in your browser at http://localhost:8000.

### 🛠️ Troubleshooting
If you encounter any issues during setup or usage:
-Verify that all dependencies are installed and compatible.
-Double-check your .env file for any configuration errors.
-Fix file permission issues with the following command:
```
chmod -R 775 storage bootstrap/cache
```

### 📜 License
This project is licensed under the MIT License. Feel free to use, modify, and distribute this software in compliance with the license.
