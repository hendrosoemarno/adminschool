<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Rename table
        Schema::rename('ai_competencies_reguler', 'ai_competencies');

        // 2. Add type, parent_id, jenjang columns
        Schema::table('ai_competencies', function (Blueprint $table) {
            $table->enum('type', ['pelajaran', 'topik', 'deep_topik'])->nullable()->after('topic_code');
            $table->unsignedBigInteger('parent_id')->nullable()->after('type');
            $table->enum('jenjang', ['sd', 'smp', 'sma'])->nullable()->after('parent_id');
        });

        // 3. Set type: no dash = pelajaran, with dash = topik
        DB::statement("UPDATE ai_competencies SET type = 'pelajaran' WHERE topic_code NOT LIKE '%-%'");
        DB::statement("UPDATE ai_competencies SET type = 'topik' WHERE topic_code LIKE '%-%'");

        // 4. Set parent_id: match prefix of topic_code with pelajaran
        DB::statement("
            UPDATE ai_competencies t
            SET t.parent_id = (
                SELECT p.id FROM ai_competencies p
                WHERE p.type = 'pelajaran'
                AND t.topic_code LIKE CONCAT(p.topic_code, '-%')
                LIMIT 1
            )
            WHERE t.type = 'topik'
        ");

        // 5. Set jenjang from topic_code
        DB::statement("UPDATE ai_competencies SET jenjang = 'sd' WHERE topic_code LIKE '%SD%' OR topic_code LIKE '%sd%'");
        DB::statement("UPDATE ai_competencies SET jenjang = 'smp' WHERE topic_code LIKE '%SMP%' OR topic_code LIKE '%smp%'");
        DB::statement("UPDATE ai_competencies SET jenjang = 'sma' WHERE topic_code LIKE '%SMA%' OR topic_code LIKE '%sma%'");

        // 6. Drop ai_competencies_deep (empty table)
        Schema::dropIfExists('ai_competencies_deep');

        // 7. Drop old unique key on ai_competency_mapping
        Schema::table('ai_competency_mapping', function (Blueprint $table) {
            $table->dropUnique('category_mapping_unique');
            $table->dropColumn('mapping_type');
            $table->unique('moodle_category_id', 'category_mapping_unique');
        });
    }

    public function down()
    {
        // Reverse
        Schema::rename('ai_competencies', 'ai_competencies_reguler');

        Schema::table('ai_competencies_reguler', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('parent_id');
            $table->dropColumn('jenjang');
        });

        Schema::table('ai_competency_mapping', function (Blueprint $table) {
            $table->dropUnique('category_mapping_unique');
            $table->enum('mapping_type', ['reguler', 'deep'])->after('competency_id');
            $table->unique(['moodle_category_id', 'mapping_type'], 'category_mapping_unique');
        });
    }
};
