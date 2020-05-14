<?php

namespace App\Console\Commands;

use App\Demandas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DemandasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Demandas:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Demandas $demandas)
    {

        $data = $demandas->where('estado', 'nova')->get();

        if ($data){

            dd(DB::table('demandas')
                ->where('estado', '=', 'nova')
                ->update(
                    ['estado' => 'em progresso']
                ));

        }


    }
}
