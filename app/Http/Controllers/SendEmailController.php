<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\SendEmailGuru;
use App\Models\User;
use App\Jobs\SendEmailJob;
use App\Jobs\SendEmailGuruJob;
use App\Models\SiswaModel;
use App\Models\Guru;

class SendEmailController extends Controller
{
    public function sendEmail()
    {
        \Log::info('=== MULAI PROSES PENGIRIMAN EMAIL ===');
        
        $siswaCount = 0;
        $guruCount = 0;
        
        // Kirim email ke semua siswa
        $siswas = SiswaModel::all();
        \Log::info('Total siswa ditemukan: ' . $siswas->count());
        
        foreach ($siswas as $index => $siswa) {
            if (!empty($siswa->email)) {
                try {
                    SendEmailJob::dispatch($siswa)->delay(now()->addSeconds($index * 30));
                    \Log::info("Siswa queue: {$siswa->nama} - {$siswa->email} | Delay: " . ($index * 30) . "s");
                    $siswaCount++;
                } catch (\Exception $e) {
                    \Log::error("Gagal dispatch siswa {$siswa->email}: " . $e->getMessage());
                }
            } else {
                \Log::warning("Email siswa kosong: {$siswa->nama}");
            }
        }

        // Kirim email ke semua guru (TERPISAH dari loop siswa)
        $gurus = Guru::all();
        \Log::info('Total guru ditemukan: ' . $gurus->count());
        
        foreach ($gurus as $guruIndex => $guru) {
            if (!empty($guru->email)) {
                try {
                    // Delay guru dimulai setelah siswa selesai + delay antar guru
                    $delaySeconds = (count($siswas) * 30) + ($guruIndex * 30);
                    SendEmailGuruJob::dispatch($guru)->delay(now()->addSeconds($delaySeconds));
                    \Log::info("Guru queue: {$guru->nama} - {$guru->email} | Delay: {$delaySeconds}s");
                    $guruCount++;
                } catch (\Exception $e) {
                    \Log::error("Gagal dispatch guru {$guru->email}: " . $e->getMessage());
                }
            } else {
                \Log::warning("Email guru kosong: {$guru->nama}");
            }
        }

        \Log::info("=== SELESAI MENAMBAH KE QUEUE ===");
        \Log::info("Siswa berhasil di-queue: {$siswaCount}");
        \Log::info("Guru berhasil di-queue: {$guruCount}");
        \Log::info("Total jobs di-queue: " . ($siswaCount + $guruCount));

        return response()->json([
            'success' => true,
            'message' => 'Email queued for all students and teachers.',
            'data' => [
                'students_found' => $siswas->count(),
                'teachers_found' => $gurus->count(),
                'students_queued' => $siswaCount,
                'teachers_queued' => $guruCount,
                'total_queued' => $siswaCount + $guruCount
            ]
        ]);
    }
}