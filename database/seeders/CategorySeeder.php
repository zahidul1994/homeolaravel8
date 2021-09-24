<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categores=array(
            'News',
            'Assignment',
            'Poem',
            'Health', 
            
            
            );
            foreach($categores as $v) {
                $newlist  = new Category();
                $newlist->category =$v;
                $newlist->save();
            }
        }
    
}
