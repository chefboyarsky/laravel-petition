<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($x = 0; $x < 50; $x++) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10) . '@gmail.com',
                'password' => bcrypt('secret'),
            ]);
        }

        for($x = 0; $x < 50; $x++) {
            DB::table('petitions')->insert([
                'title' => $this->gibberish(50),
                'summary' => $this->gibberish(700),
                'body' => $this->gibberish(2000),
                'user_id' => random_int(1, 50),
                'published' => random_int(0, 1),
                'thanks_message' => $this->gibberish(400),
                'thanks_email'   => $this->gibberish(2000),
                'thanks_sms' => $this->gibberish(200)
            ]);
        }

        for($x = 0; $x < 1000; $x++) {
            $editTime = $this->rand_date("01/01/2010", date("Y/m/d"));
            DB::table('signatures')->insert([
                'name' => str_random(10),
                'email' => str_random(10) . '@gmail.com',
                'phone' => '12' . random_int(0, 9) .'4567890',
                'petition_id' => random_int(1, 50),
                'created_at' => $editTime,
                'updated_at' => $this->rand_date($editTime, date("Y/m/d"))
            ]);
        }
    }

    private function gibberish($desired_length) {
        $response = '';
        $length = 0;
        while($length < $desired_length) {
            $added_length = random_int(3, 8);
            $response .= str_random($added_length) . " ";
            $length += $added_length + 1;
        }

        chop($response);
        return $response;

    }

    private function rand_date($min_date, $max_date)
    {
        /* Gets 2 dates as string, earlier and later date.
           Returns date in between them.
        */

        $min_epoch = strtotime($min_date);
        $max_epoch = strtotime($max_date);

        $rand_epoch = rand($min_epoch, $max_epoch);

        return date('Y-m-d H:i:s', $rand_epoch);
    }
}
