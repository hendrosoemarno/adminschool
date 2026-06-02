# Software Requirement Specification (SRS): Smart School v1.0

## 1. Deskripsi Umum
Aplikasi web yang dirancang untuk otomatisasi administrasi Kurikulum Merdeka, mulai dari manajemen perangkat ajar hingga supervisi akademik real-time oleh Kepala Sekolah.

---

## 2. Pengguna (User Roles)
* **Guru:** Input nilai, kelola modul, manajemen jurnal, dan cetak rapor.
* **Admin Sekolah:** Manajemen data sekolah dan konfigurasi akses.
* **Kepala Sekolah:** Akses *read-only* untuk supervisi akademik dan analisis performa.

---

## 3. Kebutuhan Fungsional

### A. Modul Operasional Guru
* **Library Perangkat Ajar:** Database template modul per jenjang/mapel dengan editor teks ringan.
* **Asesmen & Deskripsi Otomatis:** Konversi nilai angka (0-100) menjadi narasi rapor berdasarkan rentang nilai; tersedia fitur kustomisasi sebelum cetak.
* **Jurnal & Refleksi:** Input materi, kendala, solusi, dan fitur export PDF untuk laporan supervisi.
* **Presensi Terpadu:** Sistem menampilkan daftar siswa secara otomatis. Default status adalah "Hadir". Guru hanya menginput status ketidakhadiran (Sakit/Izin/Alfa). 
* **Smart Remedial:** Filter otomatis siswa di bawah KKM dan *generate* daftar remedial secara sistematis.
* **Laporan Rapor:** Integrasi data asesmen dan jurnal untuk pencetakan rapor naratif massal (PDF).

### B. Modul Monitoring (Kepala Sekolah)
* **Dashboard Supervisi Real-time:** Monitoring progres guru menggunakan indikator kepatuhan (Status Hijau/Kuning/Merah).
* **Supervisi Jurnal:** Akses log harian untuk memantau kelancaran KBM.
* **Analisis Performa Kelas:** Visualisasi data Smart Mapping untuk mengidentifikasi materi atau mata pelajaran yang memiliki tingkat ketuntasan rendah.
* **Export Laporan:** Rekapitulasi administrasi seluruh guru (Excel/PDF) untuk evaluasi bulanan.
* **Monitoring Kehadiran Siswa:** Kepala Sekolah dapat melihat grafik tingkat kehadiran siswa per kelas/per hari melalui dashboard. 

---

## 4. Arsitektur & Logika Dashboard Kepala Sekolah

Untuk mendukung kebutuhan monitoring, berikut adalah struktur alur data yang disarankan:

| Halaman | Fungsi Utama | Indikator Data |
| :--- | :--- | :--- |
| **Ringkasan Sekolah** | Ringkasan kepatuhan guru | Status (Hijau, Kuning, Merah) |
| **Detail Guru** | Drill-down aktivitas spesifik | Progres ATP, Jurnal, dan Asesmen |
| **Analisis Prestasi** | Identifikasi kesulitan siswa | Grafik Smart Mapping Mapel |

### Logika Status Indikator (Automasi):
* **Hijau:** Semua kewajiban administrasi (Modul, Jurnal, Rapor) terpenuhi > 90%.
* **Kuning:** Administrasi di antara 50% - 90% (ada keterlambatan input).
* **Merah:** Administrasi di bawah 50% (peringatan tindakan).

---

## 5. Strategi Navigasi & Antarmuka (UI/UX)

### A. Sidebar Navigation (Menu Samping - Utama)
Gunakan sidebar yang bersifat **Dynamic (Role-based)**. Artinya, menu yang muncul akan berubah otomatis tergantung siapa yang sedang login (Session). 

**Mengapa Sidebar?**
* **Skalabilitas:** Jika nantinya ada fitur baru (misal: "Manajemen Ekstrakurikuler"), Anda cukup menambah satu baris di sidebar tanpa merusak desain.
* **Konsistensi:** Menu selalu terlihat di sisi kiri, memberikan rasa aman bagi pengguna karena mereka tahu cara kembali ke halaman utama.
* **Kategorisasi:** Anda bisa mengelompokkan menu dengan Dropdown (contoh: menu "Administrasi" yang di dalamnya berisi sub-menu Library, Asesmen, dan Jurnal).

### B. Dashboard Widgets (Tombol Akses Cepat)
Selain sidebar, letakkan Tombol (Action Cards) di area tengah dashboard utama. Ini adalah cara yang paling intuitif bagi guru.

**Contoh Implementasi di Dashboard Guru:**
Buatlah 4-6 tombol besar berbentuk card dengan ikon menarik:
* `[Tombol: Input Jurnal]` (Langsung mengarah ke form input).
* `[Tombol: Input Nilai]` (Langsung mengarah ke daftar kelas).
* `[Tombol: Data Remedial]` (Notifikasi jika ada siswa yang butuh remedial).

> **Tujuan:** Guru yang sedang terburu-buru tidak perlu mencari menu di sidebar, cukup tekan tombol besar di layar depan.

### C. Strategi Pengelompokan Menu per Role

| Role | Struktur Navigasi |
| :--- | :--- |
| **GURU** | 1. Dashboard (Widget Utama)<br>2. Perangkat Ajar (Library, Modul)<br>3. Administrasi (Asesmen, Jurnal, Remedial)<br>4. Laporan (Cetak Rapor) |
| **KEPSEK** | 1. Dashboard (Ringkasan/Progress Bar)<br>2. Monitoring (Supervisi Jurnal, Analisis Prestasi)<br>3. Dokumen (Export Laporan Sekolah) |
| **ADMIN** | 1. User Management<br>2. Pengaturan Sistem (Setting KKTP)<br>3. System Logs |

---

## 6. Rekomendasi UI/UX dari Konsultan

* **Breadcrumbs:** Di bagian atas halaman konten, selalu sediakan breadcrumbs (contoh: `Home > Administrasi > Asesmen`). Ini membantu user tahu posisi mereka saat ini.
* **Notification Badge:** Pada menu "Jurnal" atau "Asesmen" di sidebar, tambahkan angka (badge) berwarna merah jika ada tugas yang belum dikerjakan (contoh: `Jurnal [3]`). Ini akan sangat membantu Kepala Sekolah dalam melihat kepatuhan guru.
* **Floating Action Button (Aksi Utama):** Jika layar sedang berada di daftar siswa, buatlah tombol `[+ Input Nilai]` yang menonjol agar guru mudah mengakses fitur.

### Ringkasan Pendekatan UI:
1. Gunakan **Sidebar** untuk navigasi antar modul (Menu utama).
2. Gunakan **Tombol/Card** di Dashboard untuk akses cepat (Workflow sehari-hari).