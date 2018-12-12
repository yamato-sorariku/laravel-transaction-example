<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;

class Case1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'case1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'トランザクションを手動で切らない場合';

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
        $fromAccountNumber = '000001';
        $toAccountNumber = '000002';

        $remittance = 2500;

        //まず送金元口座から減額
        $fromAccount = Account::where('account_number', $fromAccountNumber)->first();
        $fromAccount->balance = $fromAccount->balance - $remittance;
        $fromAccount->save();

        //送金先口座へ振込
        $toAccount = Account::where('account_number', $toAccountNumber)->first();
        $toAccount->balance = $toAccount->balance + $remittance;
        $toAccount->save();
    }
}
