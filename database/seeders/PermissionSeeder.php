<?php
namespace Database\Seeders;
use App\Models\Permissions;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission=array(
          'Blog-List',
          'Blog-Create',
          'Blog-Edit',
          'Blog-Delete', 
        'Medicineinformation-List',
        'Medicineinformation-Create',
        'Medicineinformation-Edit',
        'Medicineinformation-Delete', 
          'Medicine-List',
        'Medicine-Create',
        'Medicine-Edit',
        'Medicine-Delete', 
          'Disease-List',
        'Disease-Create',
        'Disease-Edit',
        'Disease-Delete', 
          'Diseasemedicine-List',
        'Diseasemedicine-Create',
        'Diseasemedicine-Edit',
        'Diseasemedicine-Delete',  

        
        );
        foreach($permission as $v) {
            $newlist  = new Permissions();
            $newlist->guard_name ='superadmin';
            $newlist->name =$v;
            $newlist->save();
        }
    }
}