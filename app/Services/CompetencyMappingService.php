<?php

namespace App\Services;

use App\Models\AiCompetencyMapping;
use App\Models\AiCompetency;
use Illuminate\Support\Facades\DB;

class CompetencyMappingService
{
    public function autoMapCategories($mainCategoryId)
    {
        DB::statement("CREATE TABLE IF NOT EXISTS ai_competency_mapping (
            id INT AUTO_INCREMENT PRIMARY KEY,
            moodle_category_id INT,
            competency_id INT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )");

        $childCategories = [];
        require_once app_path('Services/CategoryTreeHelper.php');
        \App\Services\CategoryTreeHelper::getAllDescendants($mainCategoryId, $childCategories);

        $mappedCount = 0;

        foreach ($childCategories as $moodleCat) {
            if (!preg_match('/^([A-Z0-9]+)-([A-Z0-9]+)-([A-Z0-9]+)-(.+)$/i', trim($moodleCat->name), $matches)) {
                continue;
            }

            $topicCode = strtoupper($matches[1] . '-' . $matches[2] . '-' . $matches[3]);
            $topicName = trim($matches[4]);

            $context = DB::connection('moodle')->table('context')->where('id', $moodleCat->contextid)->first();
            $courseId = ($context && $context->contextlevel == 50) ? $context->instanceid : 1;

            $competency = AiCompetency::firstOrCreate(
                ['topic_code' => $topicCode],
                [
                    'topic_name' => $topicName,
                    'course_id'  => $courseId,
                    'type' => 'topik',
                ]
            );

            AiCompetencyMapping::updateOrCreate(
                ['moodle_category_id' => $moodleCat->id],
                ['competency_id' => $competency->id]
            );

            $mappedCount++;
        }

        return $mappedCount;
    }
}
