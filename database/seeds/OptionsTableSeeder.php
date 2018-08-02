<?php

use App\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('options'))->each(function ($opt, $key) {
            $this->insertFromCollection($key, collect($opt));
        });
    }

    public function insertFromCollection($name, $collection)
    {
        $collection->each(function ($item, $key) use ($name) {
            if (is_array($item)) {
                $this->insertFromCollection($name . '.' . $key, collect($item));
            }
            else {
                $data = [
                    'group' => $name,
                    'label' => $item,
                ];

                if (is_integer($item)) {
                    $data['value'] = 'n-' . $item;
                }

                Option::create($data);
            }
        });
    }
}
