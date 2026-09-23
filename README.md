# Activity Manager

Aplikasi manajemen kegiatan sederhana menggunakan Laravel 13.

## Persyaratan
- PHP 8.3+
- Composer
- SQLite (bawaan)

## Cara Menjalankan Proyek
1. *Clone* repositori ini.
2. Jalankan perintah `composer install` untuk mengunduh *dependencies*.
3. Salin file environment: `cp .env.example .env`
4. Hasilkan application key: `php artisan key:generate`
5. Jalankan migrasi dan isi data awal: `php artisan migrate:fresh --seed`
6. Nyalakan server: `php artisan serve`
7. Buka browser dan akses ke: `http://localhost:8000/activities`
