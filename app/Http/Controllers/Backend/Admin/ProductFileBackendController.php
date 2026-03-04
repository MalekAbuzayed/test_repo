<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductFileBackendController extends Controller
{
    public function destroy(ProductFile $file)
    {
        // delete physical file
        Storage::disk('public')->delete($file->path);

        $productId = $file->product_id;
        $wasPrimary = (bool)$file->is_primary;
        $type = $file->type;

        $file->delete();

        // if deleted file was primary image, promote another image to primary
        if ($wasPrimary && $type === 'image') {
            $next = ProductFile::where('product_id', $productId)
                ->where('type', 'image')
                ->orderBy('sort_order')
                ->first();

            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'File deleted.');
    }

    public function setPrimary(ProductFile $file)
    {
        if ($file->type !== 'image') {
            return back()->with('danger', 'Only images can be set as primary.');
        }

        DB::transaction(function () use ($file) {
            ProductFile::where('product_id', $file->product_id)
                ->where('type', 'image')
                ->update(['is_primary' => false]);

            $file->update(['is_primary' => true]);
        });

        return back()->with('success', 'Primary image updated.');
    }
}
