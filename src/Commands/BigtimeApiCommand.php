<?php

namespace BlandIndustries\BigtimeApi\Commands;

use Illuminate\Console\Command;

class BigtimeApiCommand extends Command
{
    public $signature = 'bigtime-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
