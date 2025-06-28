<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailGuruJob;
use App\Models\Guru;

class SendEmailGuru extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-to-guru';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim email ke semua guru melalui job queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $gurus = Guru::all();

        foreach ($gurus as $guru) {
            if (!empty($guru->email)) {
                dispatch(new SendEmailGuruJob($guru));
                $this->info("Email queued for: {$guru->nama_guru}");
            } else {
                $this->error("Guru dengan ID {$guru->id} tidak memiliki email.");
            }
        }

        $this->info('Semua email telah dimasukkan ke queue.');
    }
}
