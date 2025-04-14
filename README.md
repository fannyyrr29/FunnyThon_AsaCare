## Kelompok FunnyThon
- Antonius Kustiono Putra (160422065)
- Janet Deby Marlien Manoach (160422062)
- Fanny Rorencia Ribowo (160422005)
  
---

# 📘 Laravel Project: AsaCare
Link Website : https://asacare.thelol.me/

--- 

Aplikasi AsaCare ditujukan untuk seluruh lapisan masyarakat Surabaya terutama orang-orang lanjut usia (lansia) dan mereka yang memiliki keterbatasan finansial. Dengan antarmuka yang ramah pengguna dan fitur-fitur yang inklusif, aplikasi ini mempermudah akses layanan kesehatan yang efisien dan terjangkau melalui integrasi dengan RSUD, layanan home care, pemesanan obat daring, serta pengingat konsumsi obat. Selain itu, fitur pemantauan kesehatan keluarga memastikan setiap anggota keluarga dapat memantau kondisi kesehatan kerabatnya secara berkala.

---

## 🚀 Features

- 🔐 User Authentication using Google.
- 👥 Role-Based Access Control (Admin, Doctor, User).
- 📑 Automated medical records integrated with Surabaya RSUD.
- ⏰ Medicine reminders.
- 🧑🏻‍⚕️ Book doctor appointments (GP/specialist) via app.
- ⌚ Real-time family health tracking.
- ➕ Book home care for doctor visits.
- 💬 Remote healthcare via online consultations.
- 💊 Surabaya online pharmacy with home delivery.

---

## 🧰 Tech Stack

- Laravel 10.x
- PHP 8.x
- MySQL 
- Bootstrap 5.3.3
- Blade Template Engine
- JavaScript
- jQuery 

---

## ⚙️ Setup Instructions

### 📌 Requirements

- PHP 8.1 or higher
- Composer
- MySQL or another supported DB
- Node.js and NPM

### 🔧 Installation Steps

```bash
# 1. Clone the repository
git clone https://github.com/fannyyrr29/FunnyThon_AsaCare
cd FunnyThon_AsaCare

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies and compile assets
npm install && npm run dev

# 4. Copy .env file
cp .env.example .env

# 5. Set up the database in .env
# (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 6. Generate app key
php artisan key:generate

# 7. Run migrations and seeders
php artisan migrate --seed

# 8. Start local development server
php artisan serve
