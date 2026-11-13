# 🏙️ URBIX – Smart City Civic Complaint Management System

**URBIX** is a web-based Smart City Civic Complaint Management System designed to connect citizens with city administrators and staff. It helps citizens report public issues, track complaint progress, and stay informed about city services.

The platform provides separate dashboards for Citizens, Admins, and Staff to make complaint management more organized, transparent, and efficient.

---

## ✨ Key Features

- **Citizen Portal** – Citizens can register, log in, and access their dashboard.
- **Complaint Reporting** – Report civic problems with descriptions and images.
- **Complaint Tracking** – View submitted complaints and monitor their status.
- **Admin Dashboard** – Manage complaints, users, and city-related activities.
- **Staff Dashboard** – View assigned complaints and manage their progress.
- **Role-Based Access** – Separate access permissions for Citizens, Admins, and Staff.
- **Smart City Interface** – Modern city-themed homepage and interactive sections.
- **City Information** – Explore city services, emergency services, and updates.

---

## 👥 User Modules

### 1. Citizen Module
- Citizen registration and login.
- View Citizen Dashboard.
- Report civic complaints.
- Upload complaint images.
- View My Complaints.
- Track complaint status.

### 2. Admin Module
- Admin login.
- View Admin Dashboard.
- Manage complaints.
- Update complaint status.
- Monitor city complaint activities.

### 3. Staff Module
- Staff login.
- View Staff Dashboard.
- Access complaint information.
- Manage complaint progress.

---

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| Laravel 12 | Backend Framework |
| PHP 8.2 | Server-side Programming |
| SQLite | Database |
| HTML5 | Page Structure |
| CSS3 | Styling and Layout |
| JavaScript | Interactive Features |
| Bootstrap | Responsive UI Components |
| Three.js | 3D Visual Elements |
| GSAP | Animations |
| Git & GitHub | Version Control |

---

## 🎨 Design

URBIX uses a modern futuristic smart-city design with:

- Dark city-themed interface.
- Neon blue and purple visual elements.
- Interactive 3D city presentation.
- Responsive page layouts.
- Animated user interface elements.

---

## ⚙️ Installation & Setup

### Prerequisites

Make sure you have installed:

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- Laravel-compatible PHP extensions

### Step 1: Clone the Repository

```bash
git clone https://github.com/jenushreej1106/urbix.git
```

### Step 2: Open the Project

```bash
cd urbix
```

### Step 3: Install PHP Dependencies

```bash
composer install
```

### Step 4: Create Environment File

```bash
Copy-Item .env.example .env
```

### Step 5: Generate Application Key

```bash
php artisan key:generate
```

### Step 6: Create SQLite Database

If the database file does not already exist:

```powershell
New-Item database/database.sqlite -ItemType File
```

Make sure the `.env` file uses SQLite:

```env
DB_CONNECTION=sqlite
```

### Step 7: Run Database Migrations

```bash
php artisan migrate
```

### Step 8: Install Frontend Dependencies

```bash
npm install
```

### Step 9: Build Frontend Assets

```bash
npm run build
```

### Step 10: Create Storage Link

```bash
php artisan storage:link
```

### Step 11: Start the Development Server

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

---

## 📁 Project Structure

```text
URBIX/
│
├── app/
│   ├── Http/
│   └── Models/
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── css/
│   ├── js/
│   └── images/
│
├── resources/
│   └── views/
│
├── routes/
│   └── web.php
│
├── storage/
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 🔐 Security

- Role-based access control.
- Authentication-protected pages.
- Environment configuration using `.env`.
- Sensitive environment and database files are excluded from Git.

---

## 🚀 Future Enhancements

- Real-time complaint notifications.
- Advanced complaint analytics.
- Interactive city map integration.
- Mobile application integration.
- AI-based complaint categorization.

---

## 👩‍💻 Developer

**Developed as a Smart City Web Application Project.**

**Project Name:** URBIX  
**Project Type:** Smart City Civic Complaint Management System  
**Framework:** Laravel 12  
**Repository:** `jenushreej1106/urbix`

---

## 📄 License

This project is developed for educational and portfolio purposes.