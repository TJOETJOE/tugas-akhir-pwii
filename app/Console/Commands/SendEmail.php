<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailjob;
use App\Models\SiswaModel;


class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-to-siswa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim email ke semua siswa melalui job queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $siswas = SiswaModel::all();

        foreach ($siswas as $siswa) {
            if (!empty($siswa->email)) {
                SendEmailJob::dispatch($siswa);
                $this->info("Email queued for: {$siswa->nama}");
            }else {
                $this->error('Tidak ada siswa yang ditemukan {$siswa->id}');
            }
        }
        $this->info('Semua email telah dikirm ke siswa.');
        //
    }
}
