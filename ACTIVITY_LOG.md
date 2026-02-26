# Activity Log System

## 📝 Overview

Sistem Activity Log untuk mencatat semua aktivitas user dengan akses khusus untuk role Admin.

## ✅ Fitur

- **Log Type Filter**: Filter berdasarkan admin_activity / operator_activity / verifikator_activity
- **Event Filter**: Filter berdasarkan login / logout / created / updated / deleted
- **User Filter**: Filter berdasarkan nama user
- **Date Range Filter**: Filter berdasarkan rentang tanggal
- **Access Control**: Hanya Admin (role '0') yang dapat mengakses menu Activity Log

## 🔒 Role Access

- **Admin (c_wbls_admauth = '0')**: Full access ✅
- **Verifikator (c_wbls_admauth = '1')**: No access ❌
- **Investigator (c_wbls_admauth = '2')**: No access ❌

## 📋 Aktivitas yang Dicatat

### 1. Login/Logout

- Login user
- Logout user

### 2. CRUD Operations

Semua operasi Create, Update, Delete pada models:

- User (trwblsadm)
- CaraMelapor (tmwblsproc)
- DefinisiWbs (tmwblsabout)
- Faq (tmwblsfaq)
- PerlindunganPelapor (tmwblsprotect)
- ReferensiKategori (trwblscateg)
- ReferensiStatus (trwblsstat)
- SyaratMelapor (tmwblsreq)
- TujuanWbs (tmwblspurpose)

## 🗄️ Database

Tabel: `activity_log`

Kolom utama:

- `id`: Primary key
- `log_name`: Jenis log (admin_activity, operator_activity, verifikator_activity)
- `description`: Deskripsi aktivitas
- `subject_type`: Model yang dimodifikasi
- `subject_id`: ID record yang dimodifikasi
- `causer_type`: Model user (App\Models\User)
- `causer_id`: ID user yang melakukan aktivitas
- `properties`: Detail perubahan (JSON)
- `event`: Jenis event (created, updated, deleted, login, logout)
- `created_at`: Waktu aktivitas

## 📂 File Structure

### Resource

```
app/Filament/Resources/
└── ActivityLogResource.php
    └── Pages/
        ├── ListActivityLogs.php
        └── ViewActivityLog.php
```

### Policy

```
app/Policies/
└── ActivityLogPolicy.php
```

### Listeners

```
app/Listeners/
├── LogSuccessfulLogin.php
└── LogSuccessfulLogout.php
```

### Models (dengan LogsActivity trait)

```
app/Models/
├── User.php
├── CaraMelapor.php
├── DefinisiWbs.php
├── Faq.php
├── PerlindunganPelapor.php
├── ReferensiKategori.php
├── ReferensiStatus.php
├── SyaratMelapor.php
└── TujuanWbs.php
```

## 🚀 Cara Menggunakan

### Melihat Activity Log

1. Login sebagai Admin
2. Buka menu "Activity Log" di sidebar
3. Gunakan filter yang tersedia:
    - **Log Type**: Pilih jenis aktivitas
    - **Event**: Pilih jenis event
    - **User**: Cari berdasarkan nama user
    - **Tanggal**: Pilih rentang tanggal

### Melihat Detail Activity

1. Klik tombol "View" pada baris activity log
2. Detail yang ditampilkan:
    - Log Type
    - Event
    - Description
    - Subject Type & ID
    - User & Role
    - Tanggal
    - Properties (perubahan data)

## 🔧 Konfigurasi

### Config File

`config/activitylog.php`

### Package

- spatie/laravel-activitylog v4.10.2

## 📌 Catatan

- Activity log tidak dapat dibuat secara manual
- Activity log tidak dapat diedit
- Hanya Admin yang dapat menghapus activity log
- Semua aktivitas tercatat otomatis berdasarkan role user yang login
