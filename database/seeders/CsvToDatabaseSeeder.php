<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CsvToDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Path to CSV file
        $path = storage_path('app\ObesityDataSet.csv');

        // Open the CSV and read its contents
        $data = array_map('str_getcsv', file($path));

        // Skip the header row
        $header = array_shift($data);

        // Insert rows into the database
        foreach ($data as $row) {
            DB::table('person_attributes')->insert([
                'gender' => $row[0],
                'age' => $row[1],
                'height' => $row[2],
                'weight' => $row[3],
                'family_history_with_overweight' => $row[4],
                'favc' => $row[5],
                'fcvc' => $row[6],
                'ncp' => $row[7],
                'caec' => $row[8],
                'smoke' => $row[9],
                'ch2o' => $row[10],
                'scc' => $row[11],
                'faf' => $row[12],
                'tue' => $row[13],
                'calc' => $row[14],
                'mtrans' => $row[15],
                'nobeyesdad' => $row[16],
            ]);
        }
    }
}
