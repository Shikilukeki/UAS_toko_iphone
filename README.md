# 🛒 Toko iPhone (PHP Native)

Project web **Toko iPhone** sederhana berbasis **PHP Native + MySQL** dengan fitur login, keranjang, checkout, dan manajemen pesanan (admin & user).

Project ini dibuat untuk memenuhi tugas mata kuliah Web Programming.

---

## 🚀 Fitur Utama

### 👤 Auth
- Login sebagai **Admin** atau **User**
- Session-based authentication
- Role-based access (admin & user)

### 🛍️ User
- Lihat daftar produk iPhone
- Tambah produk ke **Keranjang**
- Update jumlah & hapus item di keranjang
- Checkout (fake payment)
- Lihat **Riwayat Pesanan**
- Pencarian & pagination pesanan

### 🔑 Admin
- Login khusus admin
- Lihat **semua pesanan**
- Search pesanan berdasarkan ID
- Pagination data pesanan

---

## 🧱 Teknologi yang Digunakan
- PHP Native (MVC sederhana)
- MySQL
- Bootstrap 5
- JavaScript (Fetch API)
- XAMPP

---

## 🗂️ Struktur Folder  
toko-iphone/  
├── app/  
│ ├── controllers/  
│ │ ├── AuthController.php  
│ │ ├── CartController.php  
│ │ └── OrderController.php  
│ └── views/  
│ ├── auth/  
│ ├── cart/  
│ ├── orders/  
│ └── home/  
├── public/  
│ └── index.php  
└── database.sql  


---

## 🧪 Akun Dummy

**Admin**  
email : admin@iphone.com  
password : admin123  


**User**  
email : user@iphone.com  
password : user123  


---

## ⚙️ Cara Menjalankan Project

1. Clone repo ini  
2. Pindahkan ke folder `htdocs`  
3. Import database ke MySQL  
4. Jalankan Apache & MySQL (XAMPP)  
5. Akses di browser: http://localhost/toko-iphone/public

---

## 📌 Catatan
- Pembayaran bersifat **simulasi (fake checkout)**
- Fokus pada logika backend & alur transaksi
- Tidak menggunakan framework (pure PHP)

---

## 📷 Demo
Video demo & penjelasan tersedia di YouTube (https://youtu.be/xfaQaRkrl0M?si=DVLUjmgXyU6s_b57)

---


