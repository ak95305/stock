<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $file_name = $this->argument('text');
        $file_name = "d";
        $myfile = fopen("newfile_$file_name.txt", "w") or die("Unable to open file!");
        $check = "start ";
        sleep(10);
        // for ($i=0; $i < 10000000; $i++) { 
        //     $check .= "$i \n";
        // }
        fwrite($myfile, $check);
        fclose($myfile);
    }
}
