<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tutors:
        $this->createUser('Max', 'Mustermann', '+43 6641234567',
            'maxmustermann@test.test', 'maxmustermann123',
            'Ich habe einen Dr in Mathematik!', 2);
        $this->createUser('Erika', 'Musterfrau', '+43 6647654321',
            'erikamusterfrau@test.test', 'erikamusterfrau123',
            'Ich habe einen Dr in Geschichte!', 2);

        //students:
        $this->createUser('John', 'Doe', '+43 6641564761', 'johndoe@test.test',
            'johndoe123', 'Ich bin ein Schüler der nichts von Mathematik versteht!!!', 2);
        $this->createUser('Jane', 'Doe', '+43 6641315843', 'janedoe@test.test',
            'janedoe123', 'Ich habe keine Ahnung von irgendwas :-(', 1);
    }

    private function CreateUser(string $firstname, string $lastname, string $phone,
                                string $email, string $password, string $biography, int $role){
        $user = new User();

        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->phone = $phone;
        $user->email = $email;
        $user->role = $role;
        $user->password = bcrypt($password);
        $user->biography = $biography;

        $user->save();
    }
}
