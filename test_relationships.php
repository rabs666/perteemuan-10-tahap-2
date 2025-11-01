<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n=== TESTING ELOQUENT RELATIONSHIPS ===\n\n";

// Test 1: One to One - User has one Pemilik
echo "1. ONE TO ONE - User has one Pemilik:\n";
$user = App\Models\User::first();
if ($user) {
    echo "   User: {$user->name} ({$user->email})\n";
    if ($user->pemilik) {
        echo "   └─ Pemilik: Alamat = {$user->pemilik->alamat}, WA = {$user->pemilik->no_wa}\n";
    } else {
        echo "   └─ Belum ada pemilik\n";
    }
} else {
    echo "   Belum ada data user\n";
}

// Test 2: One to Many - JenisHewan has many RasHewan
echo "\n2. ONE TO MANY - JenisHewan has many RasHewan:\n";
$jenis = App\Models\JenisHewan::first();
if ($jenis) {
    echo "   Jenis: {$jenis->nama_jenis_hewan}\n";
    $rasCount = $jenis->rasHewan->count();
    echo "   └─ Jumlah Ras: {$rasCount}\n";
    foreach ($jenis->rasHewan->take(3) as $ras) {
        echo "      • {$ras->nama_ras}\n";
    }
} else {
    echo "   Belum ada data jenis hewan\n";
}

// Test 3: Inverse - RasHewan belongs to JenisHewan
echo "\n3. BELONGS TO (inverse) - RasHewan belongs to JenisHewan:\n";
$ras = App\Models\RasHewan::first();
if ($ras) {
    echo "   Ras: {$ras->nama_ras}\n";
    if ($ras->jenisHewan) {
        echo "   └─ Jenis Hewan: {$ras->jenisHewan->nama_jenis_hewan}\n";
    }
} else {
    echo "   Belum ada data ras hewan\n";
}

// Test 4: Chain Relationship - Pemilik has many Pets
echo "\n4. ONE TO MANY - Pemilik has many Pets:\n";
$pemilik = App\Models\Pemilik::first();
if ($pemilik) {
    $userName = $pemilik->user ? $pemilik->user->name : 'N/A';
    echo "   Pemilik: {$userName}\n";
    $petCount = $pemilik->pets->count();
    echo "   └─ Jumlah Pet: {$petCount}\n";
    foreach ($pemilik->pets->take(3) as $pet) {
        echo "      • {$pet->nama} ({$pet->jenis_kelamin})\n";
    }
} else {
    echo "   Belum ada data pemilik\n";
}

// Test 5: Many to Many - RekamMedis has many KodeTindakanTerapi through DetailRekamMedis
echo "\n5. MANY TO MANY - RekamMedis belongsToMany KodeTindakanTerapi:\n";
$rekam = App\Models\Rekam_Medis::first();
if ($rekam) {
    echo "   Rekam Medis ID: {$rekam->idrekam_medis}\n";
    $petName = $rekam->pet ? $rekam->pet->nama : 'N/A';
    echo "   └─ Pet: {$petName}\n";
    $tindakanCount = $rekam->kodeTindakanTerapi->count();
    echo "   └─ Jumlah Tindakan: {$tindakanCount}\n";
    foreach ($rekam->kodeTindakanTerapi->take(3) as $tindakan) {
        echo "      • [{$tindakan->kode}] {$tindakan->deskripsi_tindakan_terapi}\n";
        echo "        Detail: {$tindakan->pivot->detail}\n";
    }
} else {
    echo "   Belum ada data rekam medis\n";
}

echo "\n=== ALL TESTS COMPLETED ===\n\n";
