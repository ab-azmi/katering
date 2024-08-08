<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Foto;
use App\Models\Menu;
use App\Models\Merchant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //make roles
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'merchant'
        ]);
        Role::create([
            'name' => 'customer'
        ]);


        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ])->assignRole('admin');

        // user merchant
        $merchant = User::factory()->create([
            'name' => 'merchant',
            'email' => 'merchant@gmail.com'
        ])->assignRole('merchant');

        Merchant::factory()->create([
            'user_id' => $merchant->id
        ]);

        //user customer
        $customer = User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@gmail.com'
        ])->assignRole('customer');

        Customer::factory()->create([
            'user_id' => $customer->id
        ]);

        //make menus
        $menus = Menu::factory(12)->create();

        //make fotos
        foreach ($menus as $menu) {
            $menu->fotos()->createMany(
                Foto::factory(3)->make()->toArray()
            );
        }
    }
}
