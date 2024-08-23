<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
 

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails {text}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file_name = $this->argument('text');
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
