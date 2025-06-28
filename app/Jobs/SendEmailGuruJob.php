<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailGuru;
use App\Models\Guru;

class SendEmailGuruJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $guru;

    public function __construct(Guru $guru)
    {
        $this->guru = $guru;
    }


    public function handle(): void
    {
        Mail::to($this->guru->email)->send(new SendEmailGuru($this->guru));
    }
}
