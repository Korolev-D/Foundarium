<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $models = array(
        0  => 'Aspark',
        1  => 'Daihatsu',
        2  => 'Datsun',
        3  => 'Dome',
        4  => 'Englon',
        5  => 'Lexus',
        6  => 'Honda',
        7  => 'Acura',
        8  => 'Isuzu',
        9  => 'Mazda',
        10 => 'Mini',
        11 => 'Mitsubishi',
        12 => 'Mitsuoka',
        13 => 'Nissan',
        14 => 'Infiniti',
        15 => 'Proton',
        16 => 'Renault',
        17 => 'SEAT',
        18 => 'Subaru',
        19 => 'Suzuki',
        20 => 'Toyota',
        21 => 'Yamaha Motor',
    );
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        foreach ($this->models as $model) {
//            Car::firstOrCreate(['model' => $model]);
//            unset($this->models[$model]);
//        }

        CarUser::factory(22)->create();
    }
}
