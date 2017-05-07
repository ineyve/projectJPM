<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $dnum = 5; //How many departments
        $pnum = 5; //How many printers
        $unum = 15;  //How many users
        $rnum = 20;  //How many requests
        $cnum = 10;  //How many comments

        //Clean tables and reset auto_increment
        DB::statement('TRUNCATE TABLE departments');
        DB::statement('ALTER TABLE departments AUTO_INCREMENT = 1');

        DB::statement('TRUNCATE TABLE printers');
        DB::statement('ALTER TABLE printers AUTO_INCREMENT = 1');

        DB::statement('TRUNCATE TABLE users');
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        DB::statement('TRUNCATE TABLE requests');
        DB::statement('ALTER TABLE requests AUTO_INCREMENT = 1');

        DB::statement('TRUNCATE TABLE comments');
        DB::statement('ALTER TABLE comments AUTO_INCREMENT = 1');

        //Departments
        for ($i = 0; $i < $dnum; $i++) {
            factory(App\Department::class, 1)->create();
        }

        //Printers
        for ($i = 0; $i < $pnum; $i++) {
            factory(App\Printer::class, 1)->create();
        }

        //Users
        for ($i = 0; $i < $unum; $i++) {
            //factory(App\User::class, 1)->create();
            DB:table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123123123'),
                'admin' => $faker->numberBetween(0,1),
                'blocked' => $faker->numberBetween(0,1),
                'print_evals' => $faker->numberBetween(0,100),
                'print_counts' => $faker->numberBetween(0,100),
                'department_id' => $faker->numberBetween(1,$dnum)
            ]);
        }

        //Requests
        for ($i = 0; $i < $rnum; $i++) {
            //25% of the requests will be complete
            if (mt_rand(0, 4) === 0) {
                //factory where the request was complete
            } elseif (mt_rand(0, 4) === 0) {
                //factory where the request is being processed
            } else {
                //factory where the request is untouched
                factory(App\Request::class, 1)->create();
            }
        }

        //Comments
        for ($i = 0; $i < $cnum; $i++) {
            //factory(App\Comment::class, 1)->create();
        }
    }
}
