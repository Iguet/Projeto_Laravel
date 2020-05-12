<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $collection = collect(factory(User::class, 200)->make());

        Storage::disk('public')->put('storage/myfile.json', $collection);

        $dados = collect(json_decode(Storage::disk('public')->get('storage/myfile.json')));

        foreach ($dados as $data) {

            DB::table('users')
                ->insert([
                    'name' => $data->name,
                    'email' => $data->email,
                    'email_verified_at' => $data->email_verified_at,
                    'password' => Hash::make('123')
                ]);
        }


    }
}
