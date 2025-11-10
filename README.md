Tugas Pemrograman Web (CRUD Procedural PHP dengan File Upload, Pagination, dan Search)

## 👤 Identitas
- **Nama:** Zulfikar Fauzi
- **NIM:** 240411100054
- **Kelas:** PAW-A

## 📘 Deskripsi
Aplikasi CRUD untuk data kendaraan dengan fitur:
- Create, Read, Update, Delete (CRUD)
- Upload gambar kendaraan
- Pagination dan pencarian data

## 🛠️ Cara Menjalankan
1. Import file SQL berikut ke phpMyAdmin:
   ```sql
   CREATE DATABASE db_vehicle_crud;
   USE db_vehicle_crud;
   CREATE TABLE vehicles (
     id INT AUTO_INCREMENT PRIMARY KEY,
     brand VARCHAR(100),
     model VARCHAR(100),
     year INT,
     price DECIMAL(15,2),
     image VARCHAR(255),
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
