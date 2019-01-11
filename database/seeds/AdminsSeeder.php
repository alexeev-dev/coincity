<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = collect([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@cryptodales.com',
                'password' => Hash::make('123123')
            ]
        ]);

        $admins->each(function ($item) {
            $row = Admin::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new Admin;
            }
            $row->fill($item);
            $row->save();
        });
    }
}
