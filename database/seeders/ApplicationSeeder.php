<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applications = Application::factory()->count(50)->create();
        foreach ($applications as $application) {
            $application->addMedia(storage_path('seed/mock_subject_pdf.pdf'))->preservingOriginal()
                ->toMediaCollection(Application::MEDIA_COLLECTION_DOCUMENTS);
        }
    }
}
