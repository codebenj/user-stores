<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();

        foreach ($users as $user) {
            $stores = Store::factory(5)->make();

            foreach ($stores as $store) {
                $store->owner()->associate($user);
                $store->save();
            }
        }
    }
}
