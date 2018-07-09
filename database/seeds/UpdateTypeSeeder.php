<?php

use App\Models\UpdateType;
use Illuminate\Database\Seeder;

class UpdateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $updateType = collect([
            ['id' => 1, 'name' => 'Increase money-per-hour'],
            ['id' => 2, 'name' => 'Increase max money'],
            ['id' => 3, 'name' => 'Multiply money-per-hour']
        ]);
        $updateType->each(function ($item) {
            $row = UpdateType::where(['id' => $item['id']])->first();
            if ($row === null) {
                $row = new UpdateType;
            }
            $row->fill($item);
            $row->save();
        });
    }
}
