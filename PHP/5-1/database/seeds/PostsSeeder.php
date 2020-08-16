<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('posts')->insert([
            [
                'user_id' => '1',
                'body' => 'body1-1',
                'created_at' => $now,
            ],[
                'user_id' => '1',
                'body' => 'body1-2',
                'created_at' => $now,
            ],[
                'user_id' => '1',
                'body' => 'body1-3',
                'created_at' => $now,
            ],[
                'user_id' => '2',
                'body' => 'body2-1',
                'created_at' => $now,
            ],[
                'user_id' => '2',
                'body' => 'body2-2',
                'created_at' => $now,
            ],[
                'user_id' => '2',
                'body' => 'body2-3',
                'created_at' => $now,
            ],[
                'user_id' => '3',
                'body' => 'body3-1',
                'created_at' => $now,
            ],[
                'user_id' => '3',
                'body' => 'body3-2',
                'created_at' => $now,
            ],[
                'user_id' => '3',
                'body' => 'body3-3',
                'created_at' => $now,
            ],
        ]);
    }
}
