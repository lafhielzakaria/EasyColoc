<?php

namespace Database\Seeders;

use App\Models\bans;
use App\Models\categories;
use App\Models\colocations;
use App\Models\expenses;
use App\Models\invitations;
use App\Models\memberships;
use App\Models\settlements;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
     User::factory(50)->create();
     bans::factory(50)->create();
     colocations::factory(50)->create();
     categories::factory(50)->create();
     expenses::factory(50)->create();
     invitations::factory(50)->create();
     memberships::factory(50)->create();
     settlements::factory(50)->create();
    }
}
