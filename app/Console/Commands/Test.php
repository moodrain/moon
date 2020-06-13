<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command {

    protected $signature = 'test';
    protected $description = 'test';

    public function handle() {
        echo 'test';
    }

}