<?php

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = ['Хорошо позанимался!', 'Красавчик!', 'Так держать!'];
        foreach ($messages as $message) {
            if (!Notification::where('message', $message)->first()) {
                Notification::create(['message' => $message]);
            }
        }
    }
}
