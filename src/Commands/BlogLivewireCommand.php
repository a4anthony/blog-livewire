<?php

namespace A4Anthony\BlogLivewire\Commands;

use Illuminate\Console\Command;

class BlogLivewireCommand extends Command
{
    public $signature = 'skeleton';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
