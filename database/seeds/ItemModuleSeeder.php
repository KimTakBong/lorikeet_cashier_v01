<?php

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'item' )->delete();

        Item::create([
        	'name'			=> "Es Teh Manis",
        	'price'			=> 3000,
        	'hpp'			=> 1000,
        	'stock'			=> 250,
        	'is_visible'	=> 'yes',
        	'is_delete'		=> 0
        ]);
    }
}
