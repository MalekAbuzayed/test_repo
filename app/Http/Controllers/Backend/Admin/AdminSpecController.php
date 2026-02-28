<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;

class AdminSpecController extends Controller
{
    public function template(Subcategory $subcategory)
    {
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
}
