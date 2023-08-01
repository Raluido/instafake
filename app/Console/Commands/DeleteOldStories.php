<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Story;

class DeleteOldStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:stories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all stories older than 24 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todayMinus24H = date("Y-m-d H:i:s", strtotime('-24 hours'));
        $delete = Story::where('created_at', '<', $todayMinus24H)
            ->delete();
    }
}
