<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\SiswaModel;

class SendEmailjob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $siswa;

    /**
     * Create a new job instance.
     */
    public function __construct(SiswaModel $siswa)
    {
        $this->siswa = $siswa;
        //
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->siswa->email)->send(new SendEmail($this->siswa));
        //
    }
}
