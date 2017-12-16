<?php

namespace App\Console\Commands;

use App\Models\Main;
use App\Models\MainId;
use App\Models\MainString;
use Illuminate\Console\Command;

class Compare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perform:comparetest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performance test for string comparision and join';
    /**
     * @var Main
     */
    private $main;
    /**
     * @var MainId
     */
    private $mainId;
    /**
     * @var MainString
     */
    private $mainString;

    /**
     * Create a new command instance.
     *
     * @param Main       $main
     * @param MainId     $mainId
     * @param MainString $mainString
     */
    public function __construct(Main $main, MainId $mainId, MainString $mainString)
    {
        parent::__construct();
        $this->main = $main;
        $this->mainId = $mainId;
        $this->mainString = $mainString;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mains  = $this->main->all();
        $this->comment("starting Eloquent based Test relationship by id");
        $startTime = round(microtime(true));
        $mains->each(function ($item) {
            $main   = $this->main->find($item->id)->mainstring;
            logger()->info("[RELATIONSHIP]", [$main]);
        });
        $diff   = round(microtime(true)) - $startTime;
        $this->comment("Time taken : ". $diff);

        $this->comment("starting Eloquent based Test where by id");
        $startTime = round(microtime(true));
        $mains->each(function ($item) {
            $main   = $this->mainString->where('main_id', $item->id)->first();
            logger()->info("[WHERE]", [$main]);
        });
        $diff   = round(microtime(true)) - $startTime;
        $this->comment("Time taken : ". $diff);

        $this->comment("starting Eloquent based Test join by id");
        $startTime = round(microtime(true));
        $mains->each(function ($item) {
            $main   = $this
                ->mainString
                ->select('main_strings.*')
                ->leftJoin('mains', 'mains.id', '=', 'main_strings.main_id')
                ->where('mains.id', $item->id)
                ->first();

            logger()->info("[JOIN]", [$main]);
        });
        $diff   = round(microtime(true)) - $startTime;
        $this->comment("Time taken : ". $diff);

        $this->comment("starting Eloquent based Test String");
        $startTime = round(microtime(true));
        $mains->each(function ($item) {
            $main   = $this
                ->mainString
                ->where('main_string', $item->main)
                ->first();
            logger()->info("[STRING]", [$main]);
        });
        $diff   = round(microtime(true)) - $startTime;
        $this->comment("Time taken : ". $diff);
    }
}
