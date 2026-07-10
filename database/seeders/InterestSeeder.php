<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InterestSeeder extends Seeder
{
    public function run(): void
    {
        $interests = [
            'loisir' => ['Randonnée', 'Photographie', 'Cuisine', 'Lecture', 'Jeux de société', 'Voyage'],
            'sport' => ['Football', 'Course à pied', 'Yoga', 'Natation', 'Musculation', 'Danse'],
            'profession' => ['Tech', 'Entrepreneuriat', 'Finance', 'Santé', 'Éducation', 'Marketing'],
            'culture' => ['Musique', 'Cinéma', 'Art', 'Théâtre', 'Écriture'],
            'langue' => ['Français', 'Anglais', 'Espagnol', 'Portugais', 'Arabe'],
        ];

        foreach ($interests as $category => $names) {
            foreach ($names as $name) {
                Interest::firstOrCreate(
                    ['slug' => Str::slug($name)],
                    ['name' => $name, 'category' => $category, 'is_active' => true]
                );
            }
        }
    }
}
