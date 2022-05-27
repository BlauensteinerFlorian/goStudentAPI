<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }

    private function createSubject(string $title, string $description){
        $subject = new Subject();
        $subject->title = $title;
        $subject->description = $description;

        $subject->save();
    }
}
