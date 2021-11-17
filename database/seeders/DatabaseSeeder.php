<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $root = User::factory()->create([
            'email' => 'a@a',
            'password' => bcrypt('a')
        ]);

        $subjects = Subject::factory(5)->create();
        $subjects->each(function ($subject) {
            $subject->forums()->saveMany(Forum::factory(2)->make());
        });

        $root->subjects()->saveMany($subjects);
    }
}
