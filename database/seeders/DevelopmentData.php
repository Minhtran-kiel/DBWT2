<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  $dirPath = '/home/mibum/Desktop/DBWT2/Praktikum/M1/data/';
       $this->insertDataFromcsv($dirPath.'user.csv','ab_user');
       $this->insertDataFromcsv($dirPath.'articles.csv','ab_article');
       $this->insertDataFromcsv($dirPath.'articlecategory.csv','ab_articlecategory');
    }

    private function insertDataFromcsv($filePath, $tableName){
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file, null,';');

        if($tableName == 'ab_user'){
            while($row = fgetcsv($file, null,';')){
                $data = array_combine($header, $row);
                DB::table($tableName)->insert($data);
            } 
        } 
        else if($tableName == 'ab_articlecategory'){
            while($row = fgetcsv($file, null, ';')){
                DB::table($tableName)->insert([
                    'id'=>$row[0],
                    'ab_name'=>$row[1],
                    'ab_description'=>null,
                    'ab_parent'=>$row[2] == 'NULL'? null: $row[2]]);
            }
        }
        else{
            while($row = fgetcsv($file, null,';')){
                DB::table($tableName)->insert([
                    'id'=>$row[0],
                    'ab_name'=>$row[1],
                    'ab_price'=>(int) round($row[2]),
                    'ab_description'=>$row[3],
                    'ab_creator_id'=>$row[4],
                    'ab_createdate'=>$row[5]
                ]);
            }
        }

        fclose($file);
    }
}   

