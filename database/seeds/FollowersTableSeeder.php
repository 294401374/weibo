<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户关注第一个用户，在让第一个用户关注所有用户
        // 获取所有用户
        $users  = User::all();
        // 获取第一个用户
        $user   = $users->first();
        $user_id = $user->id;
        // 去掉第一个用户
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();
        // 所有用户关注第一个用户
        $user->follow($follower_ids);
        // 除了 1 号用户以外的所有用户都来关注 1 号用户
        foreach ($followers as  $follower) {
            $follower->follow($user_id);
        }

    }
}
