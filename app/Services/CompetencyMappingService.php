<?php

namespace App\Services;

use App\Models\AiCompetencyMapping;
use App\Models\AiCompetencyReguler;
use App\Models\AiCompetencyDeep;
use Illuminate\Support\Facades\DB;

class CompetencyMappingService
{
    /**
     * Memindai kategori soal Moodle dan mencoba memetakan secara otomatis 
     * berdasarkan pola kode (misal: FIS-01)
     */
    public function autoMapCategories($mainCategoryId)
    {
        // Pastikan tabel mapping kompetensi ada
        DB::statement("CREATE TABLE IF NOT EXISTS ai_competency_mapping (
            id INT AUTO_INCREMENT PRIMARY KEY,
            moodle_category_id INT,
            mapping_type VARCHAR(50),
            competency_id INT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )");

        // Ambil SEMUA keturunan (anak, cucu, cicit) dari kategori Moodle secara rekursif
        $childCategories = [];
        require_once app_path('Services/CategoryTreeHelper.php');
        \App\Services\CategoryTreeHelper::getAllDescendants($mainCategoryId, $childCategories);

        $mappedCount = 0;

        foreach ($childCategories as $moodleCat) {
            // 1. Validasi Standard Naming Format: [KODE_MAPEL]-[KODE_JENIS]-[NOMOR]-[LABEL]
            // Contoh: MATSD-SULIT-A06-Bangun Datar
            if (!preg_match('/^([A-Z0-9]+)-([A-Z0-9]+)-([A-Z0-9]+)-(.+)$/i', trim($moodleCat->name), $matches)) {
                // Jika format namanya tidak sesuai, ABIAKAN
                continue;
            }

            // Ekstrak bagian-bagiannya
            $topicCode = strtoupper($matches[1] . '-' . $matches[2] . '-' . $matches[3]); // misal: FIS-MC-01
            $topicName = trim($matches[4]); // misal: Mekanika Dasar
            
            // Cari tahu Course ID dari kategori ini (jika levelnya Course = 50)
            $context = DB::connection('moodle')->table('context')->where('id', $moodleCat->contextid)->first();
            $courseId = ($context && $context->contextlevel == 50) ? $context->instanceid : 1;

            // 2. Buatkan Topik (Mata Pelajaran) secara otomatis di sistem kita
            $competency = AiCompetencyReguler::firstOrCreate(
                ['topic_code' => $topicCode],
                [
                    'topic_name' => $topicName,
                    'course_id'  => $courseId,
                    'weight'     => 1.0
                ]
            );

            // 3. Pasangkan langsung ID Kategori Moodle dengan ID Topik baru ini
            AiCompetencyMapping::updateOrCreate(
                ['moodle_category_id' => $moodleCat->id, 'mapping_type' => 'reguler'],
                ['competency_id' => $competency->id]
            );
            
            $mappedCount++;
        }

        return $mappedCount;
    }
}
