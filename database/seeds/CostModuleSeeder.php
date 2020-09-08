<?php

use Illuminate\Database\Seeder;
use App\Models\CostCategory;
use App\Models\Cost;

class CostModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'cost_category' )->delete();
        DB::table( 'cost' )->delete();

        /* 1 */CostCategory::create(['parent_id'=>null, 'name'=>'Listrik']);
        /* 2 */CostCategory::create(['parent_id'=>null, 'name'=>'Sewa Gedung']);
        /* 3 */CostCategory::create(['parent_id'=>null, 'name'=>'Gaji']);
        /* 4 */CostCategory::create(['parent_id'=>null, 'name'=>'Tunjangan']);
        /* 5 */CostCategory::create(['parent_id'=>null, 'name'=>'Bonus']);
        /* 6 */CostCategory::create(['parent_id'=>null, 'name'=>'Restock Barang']);
        /* 7 */CostCategory::create(['parent_id'=>null, 'name'=>'Operasional']);
        /* 8 */CostCategory::create(['parent_id'=>null, 'name'=>'Lainnya']);

        Cost::create([
        	'cost_category_id' 	=> 1,
        	'name' 				=> "Bayar Listrik Minggu Pertama",
        	'description' 		=> "Coba untuk masukan saldo listrik 500k",
        	'nominal' 			=> 500000,
        	'date' 				=> new DateTime
        ]);
        
    }
}
