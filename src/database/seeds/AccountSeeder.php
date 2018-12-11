<?php

use Illuminate\Database\Seeder;
use App\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create(
            [
                'account_number' => '000001',
                'balance' => 10000,
            ]
        );

        Account::create(
            [
                'account_number' => '000002',
                'balance' => 10000,
            ]
        );
    }
}
