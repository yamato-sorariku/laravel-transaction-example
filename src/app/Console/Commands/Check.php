<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Account;

class Check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check';

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
    public function handle()
    {
        $fromAccountNumber = '000001';
        $toAccountNumber = '000002';

        $fromAccount = Account::where('account_number', $fromAccountNumber)->first();
        $toAccount = Account::where('account_number', $toAccountNumber)->first();

        $message = '口座番号[%s]の残高は[%d]円です';
        $this->info(sprintf($message, $fromAccount->account_number, $fromAccount->balance));
        $this->info(sprintf($message, $toAccount->account_number, $toAccount->balance));
    }
}
