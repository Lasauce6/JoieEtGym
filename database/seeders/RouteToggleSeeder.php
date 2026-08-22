<?php

namespace Database\Seeders;

use App\Models\RouteToggle;
use Illuminate\Database\Seeder;

class RouteToggleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = ['news', 'planning', 'cours', 'inscriptions', 'tarifs'];

        foreach ($routes as $route) {
            RouteToggle::firstOrCreate(
                ['route_name' => $route],
                ['is_enabled' => true],
            );
        }
    }
}
