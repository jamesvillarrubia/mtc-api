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
        Model::unguard();

        factory(App\User::class, 7)->create()->each(
            function($u){
                factory(App\Lesson::class,2)->create(['user_id'=>$u->id])->each(
                    function($l){
                        factory(App\Question::class, 3)->create(['lesson_id'=>$l->id,'user_id'=>$l->user_id])->each(
                            function($q){
                                factory(App\ShortAnswer::class, 10)->create(['question_id'=>$q->id, 'lesson_id'=>$q->lesson_id, 'user_id'=>$q->user_id]);
                            }
                        );
                    }
                );
            }
        );
        




        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
