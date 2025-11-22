# 🎓 Helpdesk System PENS

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

** Tugas Sistem Tiket Bantuan Helpdesk Fasilitas Kampus PENS**  
_Lapor masalah fasilitas, dapatkan solusi cepat! 🚀_

</div>

## 🎯 Fitur Utama
Authentication	✅
Role Management	✅
Ticket System	✅
File Upload	✅
Real-time Comments	✅
Responsive Design	✅

### 👨‍💻 Untuk Admin

-   📊 Dashboard admin dengan overview tiket
-   🔄 Manage status tiket (Open → In Progress → Resolved → Closed)
-   👥 Lihat semua tiket dari mahasiswa
-   💬 Balas komentar pada tiket
-   📈 Tracking progress perbaikan

### 🎓 Untuk Mahasiswa

-   📝 Buat tiket bantuan baru
-   🖼️ Upload foto bukti masalah
-   📍 Tentukan lokasi & kategori masalah
-   💬 Komunikasi real-time dengan admin
-   📱 Responsive design

## 🛠️ Tech Stack

-   **Backend:** Laravel 12
-   **Frontend:** Bootstrap 5, Blade Templates
-   **Database:** MySQL
-   **Storage:** Local File System
-   **Authentication:** Custom Auth System

## 🚀 Instalasi

### Prerequisites

-   PHP 8.2+
-   Composer
-   Laragon

### Step by Step

1. **Clone Repository**

```bash
git clone https://github.com/username-kamu/helpdesk-systemPENS.git
cd helpdesk-system-pens
```

2. **Setup Environment**
```bash
copy .env.example .env
php artisan key:generate
```

3. **Konfigurasi Database**
Edit file .env:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=helpdesk_pens
DB_USERNAME=root
DB_PASSWORD=
```

4. **Jalankan Migration & Buat User**
```bash
php artisan migrate
php artisan tinker
```

5. **Di tinker paste:**
```bash
\App\Models\User::create(['name'=>'Admin PENS','email'=>'admin@pens.ac.id','password'=>bcrypt('admin123'),'role'=>'admin']);
\App\Models\User::create(['name'=>'Mahasiswa PENS','email'=>'mahasiswa@pens.ac.id','password'=>bcrypt('mahasiswa123'),'role'=>'mahasiswa']);
exit;
```

6. **Storage Link & Clear Cache**
```bash
php artisan storage:link
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

7. **Jalankan Server**
```bash
php artisan serve
```

Buka:  http://localhost:8000 🎉

---------------------------------------------------------------------------------------------------------------------------------------

👥 Login Default
Admin
Email: admin@pens.ac.id

Password: admin123

Akses: /admin/dashboard

Mahasiswa
Email: mahasiswa@pens.ac.id

Password: mahasiswa123

Akses: /tickets

-----------------------------------------------------------------------------------------------------------------------------------------

**Project Structure**
```text
helpdesk-system-pens/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── TicketController.php
│   │   └── CommentController.php
│   └── Models/
│       ├── User.php
│       ├── Ticket.php
│       └── Comment.php
├── database/migrations/
│   ├── create_tickets_table.php
│   ├── create_comments_table.php
│   └── add_role_to_users_table.php
├── resources/views/
│   ├── admin/dashboard.blade.php
│   ├── tickets/
│   └── auth/
└── routes/web.php
```
graph LR
A[📝 Mahasiswa Buat Tiket] --> B[🟢 Open]
B --> C[🟡 In Progress]
C --> D[🔵 Resolved]
D --> E[⚫ Closed]

🤝 **Kontribusi**
Ingin berkontribusi? Silakan!
1. Fork project ini
2. Buat feature branch (git checkout -b feature/AmazingFeature)
3. Commit changes (git commit -m 'Add some AmazingFeature')
4. Push ke branch (git push origin feature/AmazingFeature)
5. Buat Pull Request

<div align="center">
⭐ Jangan lupa kasih star jika project ini membantu!

</div>
