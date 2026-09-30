# PRD --- temu.art

## Product Requirements Document (Consolidated Brainstorm → Product Specification)

**Versi:** 2.0\
**Status:** Development / Consolidated Draft\
**Platform:** Web\
**Wilayah fokus:** Surabaya\
**Stack saat ini:** PHP Native + MySQL + Laragon + VS Code

> Dokumen ini merupakan konsolidasi dari materi temu.art yang tersedia
> di percakapan/proyek: konsep direktori tempat dan kegiatan, struktur
> website publik, dashboard admin, sistem CRUD, soft delete/Tong Sampah,
> CSRF, serta template pengumpulan dan verifikasi data temu.art.

------------------------------------------------------------------------

# 1. Ringkasan Produk

**temu.art** adalah platform direktori dan eksplorasi informasi seni,
budaya, literasi, kegiatan, pameran, serta ruang yang menjadi bagian
dari kehidupan kota Surabaya.

Konsep utama temu.art adalah menjadi **pintu masuk informasi**.

Pengguna datang ke temu.art untuk menjawab pertanyaan seperti:

-   Ada tempat seni atau budaya apa di Surabaya?
-   Di mana saya bisa menemukan ruang literasi?
-   Ada pameran apa?
-   Ada kegiatan apa yang sedang atau akan berlangsung?
-   Kegiatan tersebut berlangsung di mana?
-   Apa informasi dasar tempat tersebut?
-   Di mana lokasi tempatnya?
-   Kanal resmi mana yang harus saya cek untuk informasi terbaru?

Temu.art bukan pengganti website resmi tempat atau penyelenggara.
Informasi yang bersifat berubah-ubah tetap diarahkan untuk diverifikasi
melalui sumber resmi.

------------------------------------------------------------------------

# 2. Problem Statement

Informasi mengenai ruang seni, budaya, literasi, pameran, dan kegiatan
kota dapat tersebar di berbagai tempat:

-   website;
-   Instagram;
-   akun penyelenggara;
-   halaman institusi;
-   sumber pemerintah;
-   kanal komunitas;
-   sumber informasi lainnya.

Akibatnya, pengguna yang ingin menemukan kegiatan atau tempat tidak
selalu memiliki satu pintu masuk yang mudah digunakan.

Masalah yang ingin dijawab temu.art:

> **Bagaimana membuat informasi mengenai tempat dan kegiatan seni,
> budaya, literasi, dan ruang kota Surabaya lebih mudah ditemukan,
> dipahami, dan dijelajahi tanpa mengklaim sebagai sumber resmi utama?**

------------------------------------------------------------------------

# 3. Product Vision

### Visi

Menjadi **pintu masuk digital untuk menemukan ruang dan kegiatan seni,
budaya, literasi, dan komunitas di Surabaya.**

### Karakter produk

Temu.art harus terasa:

-   sederhana;
-   informatif;
-   editorial;
-   lokal;
-   mudah dijelajahi;
-   tidak berlebihan;
-   dapat dipercaya dari sisi proses pengumpulan data.

------------------------------------------------------------------------

# 4. Product Principles

## 4.1 Discoverability

Pengguna harus dapat menemukan tempat dan kegiatan tanpa harus sudah
mengetahui nama tempat atau kegiatan tersebut.

## 4.2 Information First

Informasi dasar harus mudah dipahami sebelum pengguna mengambil
keputusan untuk mengunjungi sebuah tempat atau kegiatan.

## 4.3 Source-Aware

Data tidak boleh dibuat berdasarkan tebakan.

## 4.4 Official Source Priority

Jika informasi tersedia, sumber berikut diprioritaskan:

1.  Website resmi.
2.  Akun resmi.
3.  Pemerintah / institusi terkait.
4.  Penyelenggara.
5.  Sumber relevan lain yang dapat diverifikasi.

## 4.5 Transparent Uncertainty

Jika informasi belum ditemukan, field boleh dikosongkan dan dijelaskan
dalam catatan internal daripada mengarang data.

## 4.6 Timely Information

Informasi seperti jadwal, jam buka, tiket, program, dan akses dapat
berubah sehingga pengguna harus diarahkan untuk mengecek sumber resmi.

------------------------------------------------------------------------

# 5. Target Users

## 5.1 Explorer

Pengguna yang ingin mencari kegiatan atau tempat tetapi belum menentukan
tujuan.

Kebutuhan:

-   eksplorasi;
-   kategori;
-   wilayah;
-   daftar kegiatan;
-   rekomendasi berbasis informasi, bukan ranking.

## 5.2 Visitor

Pengguna yang sudah menemukan tempat/kegiatan dan membutuhkan informasi
praktis:

-   alamat;
-   lokasi;
-   tanggal;
-   jam;
-   akses;
-   website;
-   Instagram;
-   informasi kegiatan.

## 5.3 Cultural / Creative Audience

Pengguna yang tertarik pada:

-   seni;
-   pameran;
-   budaya;
-   literasi;
-   komunitas;
-   ruang kreatif.

## 5.4 Administrator

Pengguna internal yang bertugas:

-   mengumpulkan;
-   memasukkan;
-   memverifikasi;
-   memperbarui;
-   menghapus;
-   memulihkan;
-   mempublikasikan data.

------------------------------------------------------------------------

# 6. User Jobs

## Job 1 --- Menemukan tempat

> "Saya ingin menemukan tempat seni, budaya, atau literasi di Surabaya."

## Job 2 --- Menemukan kegiatan

> "Saya ingin tahu kegiatan atau pameran apa yang tersedia."

## Job 3 --- Mengetahui detail

> "Saya sudah menemukan tempat/kegiatan dan ingin tahu detail sebelum
> datang."

## Job 4 --- Menemukan lokasi

> "Saya ingin mengetahui lokasi tempat tersebut."

## Job 5 --- Memastikan informasi

> "Saya ingin mengetahui sumber resmi untuk memastikan jadwal atau
> informasi terbaru."

## Job 6 --- Mengelola data

> "Saya ingin administrator dapat memperbarui informasi tanpa mengubah
> kode website."

------------------------------------------------------------------------

# 7. Information Architecture

``` text
temu.art
│
├── Beranda
│
├── Jelajahi
│   ├── Tempat
│   ├── Agenda
│   └── Pameran
│
├── Tempat
│   └── Detail Tempat
│
├── Agenda
│   └── Detail Kegiatan
│
├── Pameran
│   └── Detail Kegiatan
│
└── Admin
    ├── Login
    ├── Dashboard
    ├── Tempat
    ├── Event
    └── Tong Sampah
```

------------------------------------------------------------------------

# 8. Website Publik

## 8.1 Beranda

### Tujuan

Menjadi entry point utama.

### Elemen

-   branding temu.art;
-   pengantar;
-   akses eksplorasi;
-   akses tempat;
-   akses agenda;
-   akses pameran;
-   CTA menuju halaman eksplorasi.

### Prinsip

Beranda tidak harus menampilkan seluruh data. Beranda bertugas
mengarahkan pengguna ke konten utama.

------------------------------------------------------------------------

# 9. Jelajahi

Halaman Jelajahi digunakan untuk pengguna yang belum mengetahui tujuan
spesifik.

### CTA utama

-   Jelajahi tempat.
-   Lihat agenda.
-   Lihat pameran.

### Konsep copy

``` text
Belum tahu mau ke mana?
Mulai dari jelajahi.
```

------------------------------------------------------------------------

# 10. Direktori Tempat

URL saat ini:

``` text
tempat.php
```

## 10.1 Fungsi

Menampilkan direktori tempat seni, budaya, literasi, dan ruang
berkegiatan.

## 10.2 Filter

### Search

Mencari berdasarkan:

-   nama;
-   kategori;
-   deskripsi;
-   data relevan lainnya.

### Category

Kategori awal:

-   Galeri Seni.
-   Museum.
-   Pameran.
-   Taman Baca Masyarakat.

### District

Filter berdasarkan wilayah/kecamatan yang tersedia di database.

## 10.3 Card

Setiap card dapat menampilkan:

-   gambar;
-   kategori;
-   kecamatan;
-   nama;
-   deskripsi;
-   alamat;
-   CTA/detail.

------------------------------------------------------------------------

# 11. Detail Tempat

URL saat ini:

``` text
detail.php?id={id}
```

## Informasi utama

-   Nama.
-   Gambar.
-   Kategori.
-   Kecamatan.
-   Deskripsi.
-   Alamat.
-   Latitude.
-   Longitude.
-   Jam buka.
-   Tiket / akses.
-   Telepon.
-   Website.
-   Instagram.

## CTA

-   Lihat di Maps.
-   Website resmi.
-   Instagram resmi.
-   Kembali ke direktori.
-   Lanjut menjelajah.

## Catatan informasi

Halaman harus mengingatkan bahwa informasi operasional dapat berubah.

------------------------------------------------------------------------

# 12. Agenda

Agenda menampilkan kegiatan yang tersedia.

Data berasal dari entitas event.

## Informasi kartu

-   Judul.
-   Tipe kegiatan.
-   Tanggal.
-   Tempat.
-   Status.
-   Gambar jika tersedia.

## Filter potensial

-   pencarian;
-   tipe kegiatan;
-   status;
-   tanggal.

Filter dapat dikembangkan sesuai kebutuhan data.

------------------------------------------------------------------------

# 13. Pameran

Pameran merupakan bagian dari event.

Halaman pameran dapat mengambil data event berdasarkan tipe/kategori
pameran.

Dengan demikian:

``` text
Event
├── Agenda
└── Pameran
```

tidak perlu menjadi dua sistem database berbeda.

------------------------------------------------------------------------

# 14. Detail Kegiatan

Detail kegiatan menampilkan:

-   status;
-   tipe;
-   judul;
-   deskripsi;
-   tanggal mulai;
-   tanggal selesai;
-   tempat;
-   kategori tempat;
-   kecamatan;
-   alamat;
-   website resmi;
-   Instagram;
-   Google Maps.

### Tujuan

Memberikan konteks kegiatan sekaligus menghubungkan kegiatan dengan
ruang tempat berlangsungnya kegiatan.

------------------------------------------------------------------------

# 15. Relasi Konsep

Konsep inti temu.art:

``` text
TEMPAT
  │
  ├── memiliki informasi ruang
  │
  └── menjadi lokasi
        │
        └── EVENT
              │
              ├── AGENDA
              └── PAMERAN
```

Satu tempat dapat memiliki banyak event.

------------------------------------------------------------------------

# 16. Data Model

## 16.1 Admin

``` text
admins
├── id
├── name
├── username
├── password
└── created_at
```

## 16.2 Place

``` text
places
├── id
├── name
├── category
├── description
├── address
├── district
├── latitude
├── longitude
├── opening_hours
├── ticket_info
├── phone
├── website
├── instagram
├── image
├── status
├── created_at
├── updated_at
└── deleted_at
```

## 16.3 Event

``` text
events
├── id
├── place_id
├── title
├── type
├── description
├── start_date
├── end_date
├── image
├── status
├── created_at
├── updated_at
└── deleted_at
```

------------------------------------------------------------------------

# 17. Data Governance

Bagian ini merupakan komponen penting dari konsep temu.art.

## 17.1 Workflow pengumpulan data

``` text
1. Cari
   ↓
2. Isi
   ↓
3. Verifikasi
   ↓
4. Catat sumber
   ↓
5. Review
   ↓
6. Database
   ↓
7. Publikasi
```

## 17.2 Cari

Temukan tempat/kegiatan dari sumber yang relevan.

## 17.3 Isi

Lengkapi data yang ditemukan.

**Jangan menebak.**

## 17.4 Verifikasi

Prioritaskan:

-   website resmi;
-   akun resmi;
-   pemerintah;
-   penyelenggara.

## 17.5 Catat sumber

Simpan:

-   URL sumber;
-   tanggal pengecekan;
-   informasi relevan.

## 17.6 Review

Koordinator/admin melakukan pemeriksaan sebelum data dianggap siap
tayang.

------------------------------------------------------------------------

# 18. Aturan Data

## Wajib

-   Jangan mengarang informasi.
-   Jangan menebak informasi yang tidak ditemukan.
-   Gunakan URL lengkap.
-   Periksa apakah tautan masih dapat dibuka.
-   Instagram harus menggunakan akun resmi jika dapat diverifikasi.
-   Status penggunaan foto harus jelas.
-   Data belum terverifikasi tidak boleh dianggap siap tayang.

## Jika data tidak tersedia

Field boleh kosong.

Contoh:

``` text
Jam buka:
Cek sumber resmi
```

atau data internal diberi catatan bahwa informasi belum ditemukan.

------------------------------------------------------------------------

# 19. Sumber Foto

Setiap gambar harus memiliki informasi internal mengenai:

-   sumber foto;
-   status penggunaan;
-   URL sumber jika diperlukan;
-   catatan hak penggunaan.

Tujuan:

-   mengurangi risiko penggunaan gambar tanpa kejelasan;
-   menjaga dokumentasi sumber;
-   memudahkan penggantian gambar jika diperlukan.

------------------------------------------------------------------------

# 20. Admin Dashboard

URL:

``` text
/admin/
```

## Menu

``` text
Dashboard
Tempat
Pameran & Agenda
Tong Sampah
Keluar
```

## Dashboard menampilkan

-   Total tempat.
-   Total event.
-   Total administrator.

------------------------------------------------------------------------

# 21. Authentication

## Login

``` text
/admin/login.php
```

Field:

-   username;
-   password.

## Session

Session utama:

``` text
admin_id
admin_name
admin_username
```

Setelah login:

``` php
session_regenerate_id(true);
```

## Logout

``` text
/admin/logout.php
```

Logout harus menghancurkan session admin.

------------------------------------------------------------------------

# 22. Authorization

Halaman admin harus memeriksa autentikasi sebelum melakukan operasi.

Jika tidak authenticated:

``` text
redirect → login.php
```

Operasi perubahan data tidak boleh hanya bergantung pada UI.

Endpoint juga harus melakukan pemeriksaan session.

------------------------------------------------------------------------

# 23. CRUD Tempat

## Create

``` text
place-form.php
```

Admin dapat membuat tempat baru.

## Read

``` text
places.php
```

Menampilkan tempat yang belum dihapus.

## Update

``` text
place-form.php?id={id}
```

## Soft Delete

``` text
place-delete.php
```

Mengubah:

``` text
deleted_at = NOW()
```

------------------------------------------------------------------------

# 24. CRUD Event

## Create

``` text
event-form.php
```

## Read

``` text
events.php
```

## Update

``` text
event-form.php?id={id}
```

## Soft Delete

``` text
event-delete.php
```

------------------------------------------------------------------------

# 25. Tong Sampah

Tong Sampah adalah mekanisme pemulihan data.

## Aktif

``` sql
deleted_at IS NULL
```

## Dihapus

``` sql
deleted_at IS NOT NULL
```

## Restore

``` text
deleted_at = NULL
```

## Force Delete

Penghapusan permanen.

Force delete harus:

-   authenticated;
-   CSRF protected;
-   menggunakan POST;
-   melakukan validasi ID;
-   mempertimbangkan relasi data.

------------------------------------------------------------------------

# 26. CSRF Security

Seluruh operasi yang mengubah state harus menggunakan CSRF.

Target:

-   create;
-   update;
-   soft delete;
-   restore;
-   force delete;
-   cleanup.

Pattern:

``` text
GET
↓
Tampilkan form + token
↓
POST
↓
Validasi token
↓
Validasi input
↓
Database operation
↓
Redirect
```

------------------------------------------------------------------------

# 27. HTTP Method Policy

Untuk operasi mutasi data:

``` text
GET  → membaca / membuka halaman
POST → membuat / mengubah / menghapus
```

Jangan menggunakan link GET sebagai satu-satunya mekanisme penghapusan
permanen.

Contoh yang perlu dihindari:

``` html
<a href="delete.php?id=1">
```

Untuk aksi mutasi sebaiknya:

``` html
<form method="post">
    CSRF
    ID
    submit
</form>
```

------------------------------------------------------------------------

# 28. Validation

Validasi minimal:

## Place

-   ID integer.
-   Nama tidak kosong.
-   Kategori valid.
-   Status valid.
-   URL divalidasi jika diisi.
-   Latitude/longitude valid jika diisi.
-   Field tanggal tidak relevan tidak boleh dipaksakan.

## Event

-   ID valid.
-   Judul tidak kosong.
-   Tipe valid.
-   Place ID valid jika diwajibkan.
-   Start date valid.
-   End date valid.
-   End date tidak boleh lebih awal daripada start date.
-   Status valid.

------------------------------------------------------------------------

# 29. Output Escaping

Data dari database harus di-escape saat ditampilkan.

Contoh:

``` php
htmlspecialchars(
    $value,
    ENT_QUOTES,
    'UTF-8'
);
```

Helper publik:

``` php
e()
```

dapat digunakan untuk konsistensi.

------------------------------------------------------------------------

# 30. Prepared Statements

Input pengguna tidak boleh digabungkan langsung ke SQL.

Gunakan:

``` php
$pdo->prepare(...)
```

dan parameter binding.

------------------------------------------------------------------------

# 31. Public Data Rules

Website publik hanya boleh menampilkan:

``` text
status = active
AND
deleted_at IS NULL
```

Data:

``` text
draft
```

atau:

``` text
deleted_at IS NOT NULL
```

tidak boleh muncul sebagai konten publik aktif.

------------------------------------------------------------------------

# 32. Error Handling

## 404

Jika tempat/event tidak ditemukan:

-   response HTTP 404;
-   halaman tetap memiliki header/footer;
-   pesan jelas;
-   CTA kembali ke halaman terkait.

## Database Error

Error database tidak boleh ditampilkan mentah kepada pengguna pada
production.

## Invalid ID

ID invalid diarahkan ke halaman terkait atau menghasilkan 404 sesuai
konteks.

------------------------------------------------------------------------

# 33. Empty State

Empty state harus informatif.

Contoh tempat:

``` text
Belum menemukan
tempat yang cocok.

Coba gunakan kata pencarian lain
atau hapus filter yang sedang digunakan.

Tampilkan semua tempat
```

Contoh event:

``` text
Tidak ada agenda
yang cocok.

Coba gunakan kata kunci,
jenis kegiatan, atau status yang berbeda.
```

------------------------------------------------------------------------

# 34. Design Direction

Arah visual temu.art:

-   editorial;
-   minimal;
-   bersih;
-   tegas;
-   banyak whitespace;
-   tipografi menjadi elemen utama;
-   CTA sederhana;
-   card informatif.

## Warna

Implementasi awal menggunakan:

-   off-white / cream;
-   hitam;
-   putih;
-   abu-abu;
-   aksen oranye pada area tertentu admin.

Warna dapat disempurnakan tanpa mengubah prinsip visual.

------------------------------------------------------------------------

# 35. Responsive Design

Website harus dapat digunakan pada:

-   desktop;
-   tablet;
-   mobile.

Prioritas:

1.  navigasi;
2.  readability;
3.  card;
4.  form;
5.  tabel admin;
6.  tombol aksi.

Tabel admin harus dapat di-scroll horizontal pada layar kecil jika
diperlukan.

------------------------------------------------------------------------

# 36. SEO dan Discoverability

Tahap lanjutan dapat mencakup:

-   title unik setiap halaman;
-   meta description;
-   URL yang konsisten;
-   semantic HTML;
-   alt text gambar;
-   struktur heading yang benar.

Detail implementasi SEO bukan blocker MVP tetapi penting sebelum
production.

------------------------------------------------------------------------

# 37. Performance

Prioritas:

-   gambar menggunakan ukuran yang wajar;
-   lazy loading untuk gambar daftar;
-   query hanya mengambil field yang diperlukan;
-   indexing database untuk field pencarian/filter yang sering
    digunakan;
-   menghindari query berulang yang tidak diperlukan.

------------------------------------------------------------------------

# 38. Accessibility

Target dasar:

-   semantic HTML;
-   label form jelas;
-   focus state;
-   kontras memadai;
-   alt text;
-   link dan button dapat dibedakan;
-   navigasi keyboard untuk komponen penting.

------------------------------------------------------------------------

# 39. Admin File Structure

Struktur yang saat ini digunakan:

``` text
admin/
├── assets/
│   └── admin.css
│
├── includes/
│   └── csrf.php
│
├── auth.php
├── index.php
├── login.php
├── logout.php
│
├── places.php
├── place-form.php
├── place-delete.php
├── place-restore.php
├── place-force-delete.php
│
├── events.php
├── event-form.php
├── event-delete.php
├── event-restore.php
├── event-force-delete.php
│
├── restore.php
├── force-delete.php
├── trash.php
└── trash-cleanup.php
```

> Struktur aktual dapat berubah. Sebelum refactor, kode yang sedang
> digunakan menjadi sumber kebenaran implementasi.

------------------------------------------------------------------------

# 40. Public File Structure

Contoh struktur:

``` text
/
├── index.php
├── jelajahi.php
├── tempat.php
├── detail.php
├── agenda.php
├── pameran.php
├── agenda-detail.php
├── pameran-detail.php
│
├── includes/
│   ├── data.php
│   ├── header.php
│   └── footer.php
│
└── config/
    └── database.php
```

------------------------------------------------------------------------

# 41. Core Functional Requirements

  ID       Requirement                                     Priority
  -------- ----------------------------------------------- ----------
  FR-001   Admin dapat login                               Must
  FR-002   Admin dapat logout                              Must
  FR-003   Admin dapat melihat dashboard                   Must
  FR-004   Admin dapat membuat tempat                      Must
  FR-005   Admin dapat mengedit tempat                     Must
  FR-006   Admin dapat soft-delete tempat                  Must
  FR-007   Admin dapat restore tempat                      Must
  FR-008   Admin dapat force-delete tempat                 Must
  FR-009   Admin dapat membuat event                       Must
  FR-010   Admin dapat mengedit event                      Must
  FR-011   Admin dapat soft-delete event                   Must
  FR-012   Admin dapat restore event                       Must
  FR-013   Admin dapat force-delete event                  Must
  FR-014   Pengguna dapat mencari tempat                   Must
  FR-015   Pengguna dapat filter tempat                    Must
  FR-016   Pengguna dapat membuka detail tempat            Must
  FR-017   Pengguna dapat melihat agenda                   Must
  FR-018   Pengguna dapat melihat pameran                  Must
  FR-019   Pengguna dapat membuka detail kegiatan          Must
  FR-020   Pengguna dapat membuka Maps                     Must
  FR-021   Data publik menghormati status active           Must
  FR-022   Data deleted tidak tampil publik                Must
  FR-023   Mutasi admin menggunakan CSRF                   Must
  FR-024   Input database menggunakan prepared statement   Must

------------------------------------------------------------------------

# 42. Data Quality Requirements

  ID       Requirement
  -------- --------------------------------------------------------
  DQ-001   Tidak boleh mengarang data
  DQ-002   Informasi yang tidak ditemukan boleh kosong
  DQ-003   Sumber informasi dicatat
  DQ-004   URL diperiksa
  DQ-005   Akun Instagram diverifikasi
  DQ-006   Sumber foto dicatat
  DQ-007   Data direview sebelum publikasi
  DQ-008   Informasi yang mudah berubah diarahkan ke sumber resmi

------------------------------------------------------------------------

# 43. Non-Goals MVP

Tidak termasuk prioritas MVP:

-   user account umum;
-   komentar;
-   rating;
-   booking;
-   pembayaran;
-   marketplace;
-   chat;
-   aplikasi mobile native;
-   sistem rekomendasi AI;
-   sistem sosial media internal;
-   integrasi API eksternal kompleks.

Fitur tersebut dapat masuk roadmap setelah kebutuhan inti tervalidasi.

------------------------------------------------------------------------

# 44. Future Opportunities

Setelah MVP stabil, peluang pengembangan:

## 44.1 Kalender

Pengguna dapat melihat kegiatan berdasarkan tanggal.

## 44.2 Peta eksplorasi

Menampilkan tempat dalam peta Surabaya.

## 44.3 Saved Places

Pengguna dapat menyimpan tempat/kegiatan.

## 44.4 Submission

Tempat atau penyelenggara dapat mengajukan data untuk ditinjau admin.

## 44.5 Editorial Collection

Temu.art dapat membuat koleksi tematik, misalnya:

``` text
Ruang literasi
Galeri di pusat kota
Kegiatan akhir pekan
Ruang komunitas
Pameran bulan ini
```

## 44.6 Data freshness

Sistem dapat mencatat:

-   terakhir diverifikasi;
-   siapa yang memverifikasi;
-   kapan perlu diperiksa kembali.

## 44.7 Multi-admin

Role:

``` text
Super Admin
Editor
Reviewer
```

------------------------------------------------------------------------

# 45. Metrics

Metrik awal yang dapat digunakan:

## Discovery

-   jumlah pengguna membuka halaman Tempat;
-   jumlah pengguna membuka Agenda;
-   jumlah pengguna membuka Pameran;
-   jumlah pencarian;
-   penggunaan filter.

## Engagement

-   detail tempat dibuka;
-   detail event dibuka;
-   klik Google Maps;
-   klik website resmi;
-   klik Instagram.

## Content

-   jumlah tempat aktif;
-   jumlah event aktif;
-   jumlah data terverifikasi;
-   jumlah data yang perlu diperbarui.

## Admin

-   jumlah tempat dibuat;
-   jumlah event dibuat;
-   jumlah data diperbarui;
-   jumlah data dihapus;
-   jumlah data direstore.

------------------------------------------------------------------------

# 46. Acceptance Criteria --- Website

## Home

-   [ ] Halaman dapat dibuka tanpa PHP error.
-   [ ] CTA menuju Tempat berfungsi.
-   [ ] CTA menuju Agenda berfungsi.
-   [ ] CTA menuju Pameran berfungsi.
-   [ ] CTA Jelajahi berfungsi.

## Tempat

-   [ ] Daftar tempat aktif tampil.
-   [ ] Search bekerja.
-   [ ] Filter kategori bekerja.
-   [ ] Filter wilayah bekerja.
-   [ ] Empty state tersedia.
-   [ ] Detail dapat dibuka.

## Detail Tempat

-   [ ] Data tampil benar.
-   [ ] Gambar tampil jika tersedia.
-   [ ] Placeholder tampil jika gambar tidak tersedia.
-   [ ] Maps bekerja.
-   [ ] Website resmi bekerja jika tersedia.
-   [ ] Instagram bekerja jika tersedia.

## Agenda/Pameran

-   [ ] Event aktif tampil.
-   [ ] Event deleted tidak tampil.
-   [ ] Event draft tidak tampil sebagai publik aktif.
-   [ ] Detail event bekerja.
-   [ ] Status tanggal dapat ditampilkan.
-   [ ] Link menuju tempat bekerja.

------------------------------------------------------------------------

# 47. Acceptance Criteria --- Admin

## Authentication

-   [ ] Login valid berhasil.
-   [ ] Login invalid ditolak.
-   [ ] Halaman admin tidak dapat diakses tanpa session.
-   [ ] Logout berhasil.
-   [ ] Session ID diregenerasi setelah login.

## Tempat

-   [ ] Create.
-   [ ] Read.
-   [ ] Update.
-   [ ] Soft delete.
-   [ ] Restore.
-   [ ] Force delete.
-   [ ] CSRF.

## Event

-   [ ] Create.
-   [ ] Read.
-   [ ] Update.
-   [ ] Soft delete.
-   [ ] Restore.
-   [ ] Force delete.
-   [ ] CSRF.

## Tong Sampah

-   [ ] Place terhapus muncul.
-   [ ] Event terhapus muncul.
-   [ ] Restore bekerja.
-   [ ] Force delete bekerja.
-   [ ] Cleanup sesuai aturan.

------------------------------------------------------------------------

# 48. Security Checklist

-   [ ] Semua admin endpoint memeriksa authentication.
-   [ ] Semua mutation memakai POST.
-   [ ] Semua mutation memakai CSRF.
-   [ ] Session regeneration setelah login.
-   [ ] Password menggunakan `password_hash`.
-   [ ] Password diverifikasi dengan `password_verify`.
-   [ ] SQL menggunakan prepared statements.
-   [ ] Output menggunakan escaping.
-   [ ] ID divalidasi sebagai integer.
-   [ ] URL divalidasi.
-   [ ] File upload jika ada harus divalidasi.
-   [ ] Error database tidak dibocorkan ke user.
-   [ ] Force delete memiliki proteksi tambahan.

------------------------------------------------------------------------

# 49. Content Workflow

``` text
Sumber
   ↓
Cari
   ↓
Isi data
   ↓
Verifikasi
   ↓
Catat URL + tanggal
   ↓
Review
   ↓
Admin publish
   ↓
Website publik
```

Jika informasi berubah:

``` text
Sumber resmi berubah
   ↓
Review
   ↓
Update database
   ↓
Verifikasi
   ↓
Website diperbarui
```

------------------------------------------------------------------------

# 50. Definition of Done

Temu.art MVP dianggap selesai apabila:

1.  Website publik berjalan.
2.  Admin dapat login/logout.
3.  Tempat dapat dikelola penuh.
4.  Event dapat dikelola penuh.
5.  Soft delete berjalan.
6.  Restore berjalan.
7.  Force delete berjalan.
8.  CSRF diterapkan.
9.  Data draft tidak tampil sebagai publik aktif.
10. Data deleted tidak tampil sebagai publik aktif.
11. Detail tempat bekerja.
12. Detail event bekerja.
13. Maps bekerja.
14. Kanal resmi dapat dibuka jika tersedia.
15. Search dan filter bekerja.
16. Empty state tersedia.
17. Mobile layout dapat digunakan.
18. Tidak terdapat error PHP pada alur normal.
19. Data mengikuti aturan verifikasi.
20. Database dapat di-backup dan dipulihkan.

------------------------------------------------------------------------

# 51. Roadmap Produk

## Phase 0 --- Discovery

-   [x] Konsep temu.art.
-   [x] Identifikasi tempat/kegiatan.
-   [x] Template pengumpulan data.
-   [x] Aturan verifikasi.
-   [x] Struktur data awal.

## Phase 1 --- Foundation

-   [x] PHP application.
-   [x] MySQL.
-   [x] Website publik dasar.
-   [x] Database places.
-   [x] Database events.
-   [x] Admin authentication.

## Phase 2 --- CMS

-   [x] CRUD places.
-   [x] CRUD events.
-   [x] Soft delete.
-   [x] Tong Sampah.
-   [x] Restore.
-   [x] Force delete.

## Phase 3 --- Security

-   [x] Session authentication.
-   [x] Password hashing.
-   [x] CSRF.
-   [ ] Audit seluruh endpoint.
-   [ ] Validasi seluruh field.
-   [ ] Audit upload gambar.
-   [ ] Audit authorization.

## Phase 4 --- Data Quality

-   [ ] Source URL pada database.
-   [ ] Verification date.
-   [ ] Verification status.
-   [ ] Photo source.
-   [ ] Review workflow.
-   [ ] Data freshness.

## Phase 5 --- Public Experience

-   [ ] Penyempurnaan search.
-   [ ] Filter event.
-   [ ] Kalender.
-   [ ] Peta.
-   [ ] Editorial collection.
-   [ ] Accessibility audit.
-   [ ] SEO audit.

## Phase 6 --- Production

-   [ ] Production configuration.
-   [ ] Backup automation.
-   [ ] Error logging.
-   [ ] Security review.
-   [ ] Performance review.
-   [ ] Final QA.
-   [ ] Deployment.

------------------------------------------------------------------------

# 52. Product Risks

## Risiko 1 --- Data tidak akurat

Mitigasi:

-   verifikasi;
-   sumber resmi;
-   catatan sumber;
-   review.

## Risiko 2 --- Informasi kedaluwarsa

Mitigasi:

-   tanggal verifikasi;
-   reminder review;
-   link sumber resmi.

## Risiko 3 --- Foto tidak jelas hak penggunaannya

Mitigasi:

-   simpan sumber foto;
-   dokumentasikan status penggunaan;
-   ganti gambar jika status tidak jelas.

## Risiko 4 --- Admin endpoint tidak aman

Mitigasi:

-   authentication;
-   authorization;
-   CSRF;
-   prepared statements;
-   validation;
-   output escaping.

## Risiko 5 --- Relasi event/place rusak

Mitigasi:

-   foreign key;
-   validasi place_id;
-   aturan penghapusan;
-   pengujian relasi.

------------------------------------------------------------------------

# 53. Prioritas Pengembangan

Urutan prioritas:

``` text
1. Keamanan
        ↓
2. Kebenaran data
        ↓
3. Fungsi inti
        ↓
4. Integritas database
        ↓
5. UX
        ↓
6. Visual
        ↓
7. Fitur tambahan
```

------------------------------------------------------------------------

# 54. Product North Star

Temu.art harus membuat perjalanan berikut terasa sederhana:

``` text
"Saya ingin melakukan sesuatu di Surabaya"
                  ↓
             temu.art
                  ↓
        "Saya menemukan tempat"
                  ↓
       "Saya menemukan kegiatan"
                  ↓
       "Saya memahami detailnya"
                  ↓
        "Saya cek sumber resmi"
                  ↓
           "Saya bisa datang"
```

Nilai utama temu.art bukan sekadar jumlah data, tetapi **seberapa mudah
pengguna menemukan informasi yang relevan dan dapat menelusuri
sumbernya.**

------------------------------------------------------------------------

# 55. Final Product Statement

> **temu.art adalah pintu masuk untuk menemukan ruang dan kegiatan seni,
> budaya, literasi, serta komunitas di Surabaya --- dengan informasi
> yang dikumpulkan, diverifikasi, dan dikelola secara terstruktur.**

------------------------------------------------------------------------

# 56. Dokumentasi Sumber Internal

Materi proyek yang menjadi dasar konsolidasi PRD:

-   Konsep website temu.art yang dikembangkan dalam percakapan.
-   Implementasi halaman publik Tempat dan Detail Tempat.
-   Implementasi halaman Agenda/Pameran dan Detail Kegiatan.
-   Implementasi dashboard admin.
-   Implementasi CRUD Tempat.
-   Implementasi CRUD Event.
-   Implementasi Tong Sampah, Restore, dan Force Delete.
-   Implementasi CSRF.
-   `template_data_temu_art.xlsx`, yang menetapkan alur **Cari → Isi →
    Verifikasi → Catat sumber → Review** serta aturan untuk tidak
    mengarang/menebak informasi.
-   Struktur proyek PHP Native + MySQL yang sedang digunakan.

------------------------------------------------------------------------

## Version History

  -----------------------------------------------------------------------
  Versi                   Status                  Keterangan
  ----------------------- ----------------------- -----------------------
  1.0                     Draft                   PRD awal berdasarkan
                                                  implementasi MVP

  2.0                     Consolidated Draft      Menggabungkan konsep
                                                  produk, implementasi,
                                                  workflow data,
                                                  verifikasi, keamanan,
                                                  dan roadmap
  -----------------------------------------------------------------------
