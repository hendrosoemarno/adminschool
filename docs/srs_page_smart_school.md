# Spesifikasi Halaman Aplikasi: Smart School v1.0

## A. Area Guru (Operational Workspace)
Halaman-halaman ini berfokus pada efisiensi input data dan penyelesaian administrasi.

* **Dashboard Guru:** Ringkasan tugas hari ini, jadwal mengajar, dan progres target administrasi (misal: "3 Jurnal belum diisi").
* **Library Modul Ajar:**
  * **List Modul:** Daftar modul per mata pelajaran.
  * **Editor Modul:** Halaman pengeditan teks ringan (WYSIWYG editor).
  * **Download Center:** Akses mengunduh template perangkat ajar.
* **Halaman Asesmen & Nilai:**
  * **Input Nilai:** Form tabel untuk memasukkan nilai angka siswa.
  * **Generator Narasi:** Halaman pratinjau narasi otomatis berdasarkan rentang nilai (dengan opsi edit manual).
* **Halaman Jurnal & Refleksi:**
  * **Form Jurnal Harian:** Input materi, kendala, dan solusi.
  * **Arsip Jurnal:** Daftar historis jurnal yang telah dibuat (dengan filter tanggal/kelas).
* **Halaman Presensi:**
  * **Form Input:** Daftar Presensi Siswa.
  * **List Presensi:** Tabel interaktif dengan toggle status kehadiran (default: Hadir).
* **Halaman Smart Remedial:**
  * **Dashboard Remedial:** Daftar siswa yang otomatis terfilter karena nilai di bawah KKTP.
  * **Modul Remedial:** Generate rencana tindak lanjut (topik remedial).
* **Halaman Laporan Rapor:**
  * **Preview Rapor:** Tampilan visual rapor sebelum dicetak.
  * **Cetak Massal:** Halaman untuk memilih format PDF dan proses cetak rapor seluruh kelas.

---

## B. Area Kepala Sekolah (Supervision & Monitoring)
Halaman-halaman ini didesain untuk memberikan "high-level view" atau pandangan makro bagi Kepala Sekolah.

* **Dashboard Utama (Supervisi):**
  * **Ringkasan Sekolah:** Tabel daftar guru beserta progress bar kepatuhan (Hijau/Kuning/Merah).
  * **Widget Statistik:** Grafik cepat (misal: "Persentase Guru yang sudah upload Rapor").
  * **Widget Kehadiran Siswa:** Statistik kehadiran harian. 
* **Halaman Analisis Performa (Smart Mapping):**
  * **Agregat Mapel:** Grafik batang/pie chart yang menampilkan mata pelajaran dengan rata-rata nilai siswa terendah.
  * **Identifikasi Topik:** List ATP (Alur Tujuan Pembelajaran) yang paling banyak siswa belum tuntas.
* **Halaman Supervisi Jurnal & Presensi (Log Aktivitas):**
  * **Timeline Jurnal:** List kronologis jurnal harian guru (bisa difilter berdasarkan nama guru atau tanggal). Melihat detail jurnal guru beserta daftar siswa yang hadir/absen pada tanggal tersebut. 
* **Halaman Laporan Sekolah (Export Center):**
  * **Generate Report:** Halaman untuk mengunduh laporan rekapitulasi sekolah (Bulanan/Semester) & presensi siswa dalam format Excel atau PDF untuk keperluan rapat.

---

## C. Area Admin (System Management)
* **Manajemen Pengguna:** Penambahan/pengaturan akses akun (Guru, Kepala Sekolah, Admin).
* **Konfigurasi Sistem:** Pengaturan KKTP (Kriteria Ketercapaian Tujuan Pembelajaran) yang berlaku untuk seluruh sekolah (Standar sekolah).
* **Log Sistem:** Pemantauan aktivitas sistem untuk keamanan.