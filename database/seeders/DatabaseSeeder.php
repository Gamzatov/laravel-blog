<?php

namespace Database\Seeders;

use App\Enums\User\UserRoleEnum;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->insert([
                [
                    'name' => 'Test Admin',
                    'email' => 'test@admin.com',
                    'password' => Hash::make('12341234'),
                    'role' => UserRoleEnum::ADMIN->value
                ],
                [
                    'name' => 'Test User',
                    'email' => 'test@user.com',
                    'password' => Hash::make('12341234'),
                    'role' => UserRoleEnum::USER->value
                ]
            ]
        );

        User::factory(10)->create();
        Category::factory(12)->create();
        Tag::factory(8)->create();
        Post::factory(8)->create();

        for ($i = 0; $i < 50; $i++) {
            try {
                DB::table('post_tag')->insert([
                    'post_id' => Post::query()->inRandomOrder()->value('id'),
                    'tag_id' => Tag::query()->inRandomOrder()->value('id'),
                ]);
            }catch(UniqueConstraintViolationException $e){
                continue;
            }
        }
    }
}
