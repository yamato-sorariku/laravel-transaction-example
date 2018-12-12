<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Account;

class Case3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'case3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'トランザクションをクロージャで管理する場合';

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
    public function handle()
    {        
        DB::transaction(function () {
            $fromAccountNumber = '000001';
            $toAccountNumber = '999999'; //存在しない口座
    
            $remittance = 2500;
            
            //まず送金元口座から減額
            $fromAccount = Account::where('account_number', $fromAccountNumber)->first();
            $fromAccount->balance = $fromAccount->balance - $remittance;
            $fromAccount->save();
            
            //送金先口座へ振込
            $toAccount = Account::where('account_number', $toAccountNumber)->first();
            
            if($toAccount === null)
            {
                throw new \Exception('口座が存在しません');
                
            }
            
            $toAccount->balance = $toAccount->balance + $remittance;
            $toAccount->save();
        });
    }
}
