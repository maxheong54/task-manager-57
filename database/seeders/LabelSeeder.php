<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'ошибка' => 'Какая-то ошибка в коде или проблема с функциональностью',
            'документация' => 'Задача которая касается документации',
            'дубликат' => 'Повтор другой задачи',
            'доработка' => 'Новая фича, которую нужно запилить',
            ])->each(function ($desc, $name) {
                Label::firstOrCreate(['name' => $name], ['description' => $desc]);
            });
    }
}
