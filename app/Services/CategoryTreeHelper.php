<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class CategoryTreeHelper {
    public static function getAllDescendants($parentId, &$allDescendants = []) {
        $children = DB::connection('moodle')->table('question_categories')
            ->where('parent', $parentId)
            ->get();
            
        foreach ($children as $child) {
            $allDescendants[] = $child;
            // Panggil fungsi ini lagi untuk mencari cucunya
            self::getAllDescendants($child->id, $allDescendants);
        }
        
        return $allDescendants;
    }
}
