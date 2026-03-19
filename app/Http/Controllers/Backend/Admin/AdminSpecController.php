<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecField;
use App\Models\SpecGroup;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class AdminSpecController extends Controller
{
    public function template(Subcategory $subcategory)
    {
        $this->ensureTemplateExists($subcategory);

        $groups = $subcategory->specGroups()
            ->with(['specFields' => fn($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get()
            ->map(fn($g) => [
                'id' => $g->id,
                'title' => $g->title,
                'fields' => $g->specFields->map(fn($f) => [
                    'id' => $f->id,
                    'label' => $f->label,
                    'unit' => $f->unit,
                    'data_type' => $f->data_type,
                    'is_key' => (bool) $f->is_key,
                ])->values(),
            ]);

        return response()->json(['groups' => $groups]);
    }
    // this function is temp it will be removed in production
    private function ensureTemplateExists(Subcategory $subcategory): void
    {
        if ($subcategory->specGroups()->exists()) {
            return;
        }

        if (strcasecmp($subcategory->name, 'All in one') !== 0) {
            return;
        }

        $sourceSubcategory = Subcategory::query()
            ->whereIn('name', ['HV Batteries', 'LV Batteries'])
            ->whereHas('specGroups')
            ->orderByRaw("FIELD(name, 'HV Batteries', 'LV Batteries')")
            ->first();

        if (!$sourceSubcategory) {
            return;
        }

        DB::transaction(function () use ($subcategory, $sourceSubcategory) {
            $sourceGroups = $sourceSubcategory->specGroups()
                ->with(['specFields' => fn($query) => $query->orderBy('sort_order')])
                ->orderBy('sort_order')
                ->get();

            foreach ($sourceGroups as $sourceGroup) {
                $newGroup = SpecGroup::create([
                    'subcategory_id' => $subcategory->id,
                    'title' => $sourceGroup->title,
                    'sort_order' => $sourceGroup->sort_order,
                ]);

                foreach ($sourceGroup->specFields as $sourceField) {
                    SpecField::create([
                        'subcategory_id' => $subcategory->id,
                        'group_id' => $newGroup->id,
                        'key' => $sourceField->key,
                        'label' => $sourceField->label,
                        'unit' => $sourceField->unit,
                        'data_type' => $sourceField->data_type,
                        'is_key' => $sourceField->is_key,
                        'sort_order' => $sourceField->sort_order,
                        'status' => $sourceField->status ?? 'active',
                    ]);
                }
            }
        });
    }
}
