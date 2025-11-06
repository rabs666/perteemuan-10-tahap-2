# Tugas Modul 11 - 5 Helper Functions

File ini berisi 5 fungsi helper yang diminta untuk tugas Modul 11.

Lokasi helper: `app/Helpers/modul11_helpers.php`

Daftar fungsi:

1. `setActiveNav(string $uri): string` — Mengembalikan `'active'` jika URI saat ini cocok. Digunakan di Blade untuk menandai menu aktif.
2. `formatFileSize(int $bytes, int $precision = 2): string` — Mengonversi bytes menjadi format yang mudah dibaca (KB, MB, ...).
3. `dataGet(array $array, string $key, $default = null)` — Mengambil nilai dari array bertingkat menggunakan dot notation.
4. `jsonResponse(bool $success, string $message, $data = null, int $statusCode = 200): string` — Menghasilkan JSON string terstandardisasi.
5. `getGravatar(string $email, int $size = 80, string $default = 'mp'): string` — Menghasilkan URL Gravatar dari email.

Contoh penggunaan di Blade / Controller:

```php
// Menandai menu aktif
<li class="nav-item {{ setActiveNav('admin/users') }}">Users</li>

// Format file size
echo formatFileSize(2097152); // 2 MB

// Ambil data nested
$data = ['user' => ['profile' => ['name' => 'Budi']]];
echo dataGet($data, 'user.profile.name', 'N/A'); // Budi

// JSON response (string)
echo jsonResponse(true, 'OK', ['foo' => 'bar'], 200);

// Gravatar
echo getGravatar('user@example.com', 100);
```

Catatan:
- Fungsi `jsonResponse()` disesuaikan untuk tugas ini (mengembalikan JSON string) — di aplikasi Laravel seringkali lebih baik menggunakan `return response()->json(...)`.
- Setelah menambahkan file helper, jalankan `composer dump-autoload` supaya file otomatis di-load.
