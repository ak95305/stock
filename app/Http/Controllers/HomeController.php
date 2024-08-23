<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\TestJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class HomeController extends Controller 
{
    public function index(Request $request) 
    {
        // $check = $request->get('name') ? $request->get('name') : "one";
        // exec("php /Users/aman/dev/htdocs/laravel/stock/artisan app:send-emails $check &");
        // $process = new Process(["php", "/Users/aman/dev/htdocs/laravel/stock/artisan", "app:send-emails", "$check"]);
        // $process->run();
        // Artisan::queue('app:send-emails two');

        // TestJob::dispatch();

        return view("home.index");
    }
}