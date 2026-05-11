<?php

namespace App\Services;

use App\Models\AiBadge;
use App\Models\AiUserBadge;
use Illuminate\Support\Facades\DB;

class GamificationService
{
    /**
     * Memeriksa dan memberikan lencana otomatis kepada siswa
     */
    public function checkAndAwardBadges($userId, $courseId)
    {
        $this->awardGrowthHattrick($userId, $courseId);
        $this->awardExcellentBadge($userId, $courseId);
    }

    /**
     * Logika Growth Hat-trick (3x naik berturut-turut)
     * Butuh 4 data kuis: 1 baseline + 3 growth
     */
    protected function awardGrowthHattrick($userId, $courseId)
    {
        $lastAttempts = DB::connection('moodle')
            ->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('q.course', $courseId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->limit(4)
            ->pluck('qa.sumgrades')
            ->toArray();

        // Harus ada minimal 4 kuis
        if (count($lastAttempts) < 4) return;

        // Moodle desc, jadi urutannya: [terbaru, k-2, k-3, k-4]
        // Kita cek apakah: terbaru > k-2 > k-3 > k-4
        if ($lastAttempts[0] > $lastAttempts[1] && 
            $lastAttempts[1] > $lastAttempts[2] && 
            $lastAttempts[2] > $lastAttempts[3]) {
            
            $badge = AiBadge::where('badge_type', 'growth')
                ->where('badge_name', 'LIKE', '%Hat-trick%')
                ->first();

            if ($badge) {
                AiUserBadge::firstOrCreate([
                    'user_id' => $userId,
                    'badge_id' => $badge->id,
                    'quiz_id_trigger' => DB::connection('moodle')
                        ->table('quiz_attempts as qa')
                        ->join('quiz as q', 'q.id', '=', 'qa.quiz')
                        ->where('qa.userid', $userId)
                        ->where('q.course', $courseId)
                        ->orderBy('qa.timestart', 'desc')
                        ->value('qa.quiz')
                ]);
            }
        }
    }

    /**
     * Logika Lencana Excellent
     */
    protected function awardExcellentBadge($userId, $courseId)
    {
        $lastScore = DB::connection('moodle')
            ->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('q.course', $courseId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->value('qa.sumgrades');

        if ($lastScore >= 90) { // Contoh threshold statis
            $badge = AiBadge::where('badge_type', 'excellent')->first();
            if ($badge) {
                AiUserBadge::firstOrCreate([
                    'user_id' => $userId,
                    'badge_id' => $badge->id
                ]);
            }
        }
    }
}
