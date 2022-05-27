<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matheDescription = "Mathematikunterricht bezeichnet die institutionalisierte Vermittlung fachspezifischem Wissens sowie von Fertigkeiten und Fähigkeiten im Bereich Mathematik an Schüler durch eine meist spezifisch ausgebildete Lehrkraft sowohl in der Schule in Form eines Schulfachs, der Hochschule als auch in der Erwachsenenbildung.";
        $this->createSubject("Mathematik", $matheDescription);
        $deutschDescription = "Der Deutschunterricht dient der Entwicklung der Lese-, Schreib-, Sprech- und Hörverstehenskompetenz in der deutschen Sprache.";
        $this->createSubject("Deutsch", $deutschDescription);
        $englischDescription = "Fremdsprachenunterricht bezeichnet das Lehren und das Erlernen einer Sprache, die nicht zu der/den Muttersprache(n) gehört, in Bildungsinstitutionen oder im Privatunterricht.";
        $this->createSubject("Englisch", $englischDescription);
        $geschichteDescription = "Geschichtsunterricht bzw. Geschichte bezeichnet jede Form institutionalisierter Unterweisung in Geschichte, besonders als Unterrichtsfach in der Schule.";
        $this->createSubject("Geschichte", $geschichteDescription);
    }

    private function createSubject(string $title, string $description){
        $subject = new Subject();
        $subject->title = $title;
        $subject->description = $description;

        $subject->save();
    }
}
