<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Offer;
use DateTime;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createOffer('Mathematik Nachhilfe', 'Nachhilfe für die Schulstufen 4-10', 'open',
            '16:00', '18:00', new DateTime('2022-07-25'), 1, 1);
        $this->createOffer('Geschicht Nachhilfe', 'Nachhilfe für die Schulstufen 4-10', 'open',
            '16:00', '18:00', new DateTime('2022-07-25'), 1, 2);
    }

    private function createOffer(string $title, string $description, string $state, string $start_time,
                                 string $end_time, DateTime $date, int $subject_id, int $user_id){

        $offer = new Offer();

        $offer->title = $title;
        $offer->description = $description;
        $offer->state = $state;
        $offer->start_time = $start_time;
        $offer->end_time = $end_time;
        $offer->date = $date;
        $offer->student_id = null;

        $subject = Subject::all()->find($subject_id);
        $offer->subject()->associate($subject);
        $user = User::all()->find($user_id);
        $offer->user()->associate($user);

        $offer->save();

    }
}
