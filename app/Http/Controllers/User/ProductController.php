<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Grandchild;
use App\Models\Product;
use App\Models\ProductFile;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Support\ZipArchiveFactory;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selected = $this->resolveSelectedFilters(
            $request->query('category_id'),
            $request->query('subcategory_id'),
            $request->query('grandchild_id')
        );

        $products = $this->applyProductFilters(
            $this->baseProductsQuery(),
            $selected['category_id'],
            $selected['subcategory_id'],
            $selected['grandchild_id']
        )->get();

        $categories = $this->activeCategoriesTree();

        return view('user.products.index', compact('products', 'categories', 'selected'));
    }

    public function filter(Request $request)
    {
        $selected = $this->resolveSelectedFilters(
            $request->query('category_id'),
            $request->query('subcategory_id'),
            $request->query('grandchild_id')
        );

        $products = $this->applyProductFilters(
            $this->baseProductsQuery(),
            $selected['category_id'],
            $selected['subcategory_id'],
            $selected['grandchild_id']
        )->get();

        $subcategories = collect();
        $grandchilds = collect();
        if (!empty($selected['category_id'])) {
            $subcategories = Subcategory::query()
                ->where('category_id', $selected['category_id'])
                ->where($this->activeStatusCondition())
                ->orderBy('name')
                ->get(['id', 'name', 'category_id']);
        }

        if (!empty($selected['subcategory_id'])) {
            $grandchilds = Grandchild::query()
                ->where('subcategory_id', $selected['subcategory_id'])
                ->where($this->activeStatusCondition())
                ->orderBy('name')
                ->get(['id', 'name', 'subcategory_id']);
        }

        return response()->json([
            'products' => $products->map(fn(Product $product) => $this->serializeProductCard($product))->values(),
            'count' => $products->count(),
            'selected' => $selected,
            'subcategories' => $subcategories->values(),
            'grandchilds' => $grandchilds->values(),
        ]);
    }

    public function downloadCenter()
    {
        return view('user.products.download-center');
    }

    public function downloadCenterOptions(Request $request)
    {
        $selected = $this->resolveDownloadCenterSelection(
            $request->query('category_id'),
            $request->query('subcategory_id'),
            $request->query('grandchild_id'),
            $request->query('product_id'),
            $request->query('file_type')
        );

        $categoryProductCounts = $this->activeProductCountMap('category_id');
        $categories = $this->activeCategoriesTree()
            ->map(fn(Category $category) => [
                'id' => $category->id,
                'name' => $category->name,
                'count' => (int) ($categoryProductCounts[$category->id] ?? 0),
            ])
            ->values();

        $subcategories = collect();
        if (!empty($selected['category_id'])) {
            $subcategoryProductCounts = $this->activeProductCountMap('subcategory_id');
            $subcategoryGrandchildCounts = $this->activeGrandchildCountMap();
            $subcategories = Subcategory::query()
                ->where('category_id', $selected['category_id'])
                ->where($this->activeStatusCondition())
                ->orderBy('name')
                ->get(['id', 'name'])
                ->map(fn(Subcategory $subcategory) => [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'count' => (int) ($subcategoryProductCounts[$subcategory->id] ?? 0),
                    'grandchild_count' => (int) ($subcategoryGrandchildCounts[$subcategory->id] ?? 0),
                ])
                ->values();
        }

        $grandchilds = collect();
        $grandchildSelectionRequired = false;
        if (!empty($selected['subcategory_id'])) {
            $grandchildProductCounts = $this->activeProductCountMap('grandchild_id');
            $grandchilds = Grandchild::query()
                ->where('subcategory_id', $selected['subcategory_id'])
                ->where($this->activeStatusCondition())
                ->orderBy('name')
                ->get(['id', 'name'])
                ->map(fn(Grandchild $grandchild) => [
                    'id' => $grandchild->id,
                    'name' => $grandchild->name,
                    'count' => (int) ($grandchildProductCounts[$grandchild->id] ?? 0),
                ])
                ->values();
            $grandchildSelectionRequired = $grandchilds->isNotEmpty();
        }

        $products = collect();
        $shouldLoadProducts = !empty($selected['subcategory_id']) &&
            (!$grandchildSelectionRequired || !empty($selected['grandchild_id']));

        if ($shouldLoadProducts) {
            $products = $this->activeProductsForDownloadCenter(
                $selected['category_id'],
                $selected['subcategory_id'],
                $selected['grandchild_id']
            )->values();
        }

        $fileTypes = [];
        $files = [];
        $downloadAllUrl = null;

        if (!empty($selected['product_id'])) {
            $fileTypes = $this->buildDownloadTypeOptions($selected['product']);
            $files = $this->buildDownloadFilesForSelection($selected['product'], $selected['file_type']);
            $downloadAllUrl = count($this->buildDownloadFilesForSelection($selected['product'], '__all__')) > 0
                ? route('product.files.downloadAll', ['id' => $selected['product']->id])
                : null;
        }

        $selectedFileType = $selected['file_type']
            ? collect($fileTypes)->firstWhere('id', $selected['file_type'])
            : null;

        return response()->json([
            'selected' => [
                'category_id' => $selected['category_id'],
                'subcategory_id' => $selected['subcategory_id'],
                'grandchild_id' => $selected['grandchild_id'],
                'product_id' => $selected['product_id'],
                'file_type' => $selected['file_type'],
            ],
            'selected_labels' => [
                'category_name' => $selected['category']?->name,
                'subcategory_name' => $selected['subcategory']?->name,
                'grandchild_name' => $selected['grandchild']?->name,
                'product_name' => $selected['product']?->title,
                'file_type_name' => $selectedFileType['name'] ?? null,
            ],
            'categories' => $categories,
            'subcategories' => $subcategories->values(),
            'grandchilds' => $grandchilds->values(),
            'grandchild_selection_required' => $grandchildSelectionRequired,
            'products' => $products,
            'file_types' => $fileTypes,
            'files' => $files,
            'download_all_url' => $downloadAllUrl,
        ]);
    }

    public function show(Request $request, $id = null)
    {
        $product = $this->resolveProductFromRequest($request, $id);

        if (!$product) {
            return redirect()->route('products')->with('danger', 'Record Not Found');
        }

        $images = $product->files->where('type', 'image')->values();
        $keySpecs = $this->buildKeySpecs($product);

        return view('user.products.show', compact('product', 'images', 'keySpecs'));
    }

    public function keySpecs(Request $request)
    {
        $product = $this->resolveProductFromRequest($request);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        return response()->json([
            'product_id' => $product->id,
            'key_specs' => $this->buildKeySpecs($product),
        ]);
    }

    public function otherSpecs(Request $request)
    {
        $product = $this->resolveProductFromRequest($request);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        return response()->json([
            'product_id' => $product->id,
            'groups' => $this->buildOtherSpecsGrouped($product),
        ]);
    }

    public function filesList(Request $request)
    {
        $product = $this->resolveProductFromRequest($request);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $filesByType = $this->buildDownloadFilesByType($product);
        $allCount = collect($filesByType)->sum(fn(array $typeBlock) => count($typeBlock['files']));

        return response()->json([
            'product_id' => $product->id,
            'types' => array_values($filesByType),
            'all_files_count' => $allCount,
        ]);
    }

    public function downloadFile(ProductFile $file, Request $request)
    {
        $product = $this->resolveProductFromRequest($request);
        if (!$product || (int) $file->product_id !== (int) $product->id) {
            abort(404);
        }

        if ($file->type === 'image' || !$this->isActiveStatusValue($file->getRawOriginal('status'))) {
            abort(404);
        }

        $fullPath = $this->resolveStoragePath($file->path);
        if (!$fullPath) {
            abort(404);
        }

        $downloadName = $file->title ?: basename($file->path);
        return response()->download($fullPath, $downloadName);
    }

    public function downloadAll(Request $request, ZipArchiveFactory $zipArchiveFactory)
    {
        $product = $this->resolveProductFromRequest($request);
        if (!$product) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Product not found.'], 404)
                : redirect()->route('products')->with('danger', 'Product not found.');
        }

        $files = $product->files
            ->where('type', '!=', 'image')
            ->filter(fn(ProductFile $file) => $this->isActiveStatusValue($file->getRawOriginal('status')))
            ->values();

        if ($files->isEmpty()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'No files available for download.'], 422)
                : redirect()->back()->with('danger', 'No files available for download.');
        }

        if (! $zipArchiveFactory->isAvailable()) {
            $message = 'ZIP downloads are temporarily unavailable. Server ZIP support is not installed.';

            return $request->expectsJson()
                ? response()->json(['message' => $message], 503)
                : redirect()->back()->with('danger', $message);
        }

        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $zipFilename = 'product-' . $product->id . '-files.zip';
        $zipPath = $tempDir . DIRECTORY_SEPARATOR . Str::uuid() . '-' . $zipFilename;

        $zip = $zipArchiveFactory->make();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Failed to prepare zip file.'], 500)
                : redirect()->back()->with('danger', 'Failed to prepare zip file.');
        }

        foreach ($files as $file) {
            $fullPath = $this->resolveStoragePath($file->path);
            if (!$fullPath) {
                continue;
            }

            $entryName = $file->type . '/' . ($file->title ?: basename($file->path));
            $zip->addFile($fullPath, $entryName);
        }

        $zip->close();

        return response()->download($zipPath, $zipFilename)->deleteFileAfterSend(true);
    }

    public function file($id)
    {
        $product = Product::query()
            ->with([
                'files' => function ($q) {
                    $q->where('type', '!=', 'image')
                        ->where($this->activeStatusCondition())
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },
            ])
            ->where('id', $id)
            ->first();

        if (!$product) {
            abort(404);
        }

        $file = $product->files->first();
        if (!$file) {
            abort(404);
        }

        $fullPath = $this->resolveStoragePath($file->path);
        if (!$fullPath) {
            abort(404);
        }

        return response()->file($fullPath);
    }

    private function baseProductsQuery(): Builder
    {
        return Product::query()
            ->with([
                'category:id,name',
                'subcategory:id,name,category_id',
                'grandchild:id,name,subcategory_id',
                'files' => function ($q) {
                    $q->select('id', 'product_id', 'type', 'path', 'is_primary', 'sort_order')
                        ->where('type', 'image')
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order');
                },
            ])
            ->where($this->activeStatusCondition())
            ->orderBy('created_at', 'desc');
    }

    private function applyProductFilters(Builder $query, ?int $categoryId, ?int $subcategoryId, ?int $grandchildId): Builder
    {
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        if (!empty($subcategoryId)) {
            $query->where('subcategory_id', $subcategoryId);
        }

        if (!empty($grandchildId)) {
            $query->where('grandchild_id', $grandchildId);
        }

        return $query;
    }

    private function activeCategoriesTree()
    {
        return Category::query()
            ->where($this->activeStatusCondition())
            ->with([
                'subcategories' => function ($q) {
                    $q->where($this->activeStatusCondition())
                        ->with([
                            'grandchilds' => function ($grandchildQuery) {
                                $grandchildQuery->where($this->activeStatusCondition())->orderBy('name');
                            },
                        ])
                        ->orderBy('name');
                },
            ])
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    private function resolveSelectedFilters($categoryInput, $subcategoryInput, $grandchildInput): array
    {
        $categoryId = $this->normalizeId($categoryInput);
        $subcategoryId = $this->normalizeId($subcategoryInput);
        $grandchildId = $this->normalizeId($grandchildInput);

        if (!empty($grandchildId)) {
            $grandchild = Grandchild::query()
                ->where('id', $grandchildId)
                ->where($this->activeStatusCondition())
                ->with([
                    'subcategory' => function ($query) {
                        $query->select('id', 'category_id');
                    },
                ])
                ->first(['id', 'subcategory_id']);

            if (!$grandchild || !$grandchild->subcategory) {
                $grandchildId = null;
            } else {
                $subcategoryId = (int) $grandchild->subcategory_id;
                $categoryId = (int) $grandchild->subcategory->category_id;
            }
        }

        if (!empty($subcategoryId) && empty($grandchildId)) {
            $subcategory = Subcategory::query()
                ->where('id', $subcategoryId)
                ->where($this->activeStatusCondition())
                ->first(['id', 'category_id']);

            if (!$subcategory) {
                $subcategoryId = null;
            } else {
                $categoryId = (int) $subcategory->category_id;
            }
        }

        if (!empty($categoryId)) {
            $categoryExists = Category::query()
                ->where('id', $categoryId)
                ->where($this->activeStatusCondition())
                ->exists();

            if (!$categoryExists) {
                $categoryId = null;
                $subcategoryId = null;
                $grandchildId = null;
            }
        }

        if (!empty($subcategoryId) && !empty($categoryId)) {
            $subcategoryMatchesCategory = Subcategory::query()
                ->where('id', $subcategoryId)
                ->where('category_id', $categoryId)
                ->where($this->activeStatusCondition())
                ->exists();

            if (!$subcategoryMatchesCategory) {
                $subcategoryId = null;
                $grandchildId = null;
            }
        }

        if (!empty($grandchildId) && !empty($subcategoryId)) {
            $grandchildMatchesSubcategory = Grandchild::query()
                ->where('id', $grandchildId)
                ->where('subcategory_id', $subcategoryId)
                ->where($this->activeStatusCondition())
                ->exists();

            if (!$grandchildMatchesSubcategory) {
                $grandchildId = null;
            }
        }

        return [
            'category_id' => $categoryId,
            'subcategory_id' => $subcategoryId,
            'grandchild_id' => $grandchildId,
        ];
    }

    private function resolveProductFromRequest(Request $request, $routeId = null): ?Product
    {
        $productId = $routeId ?: $request->query('id');

        $query = Product::query()
            ->with([
                'category:id,name',
                'subcategory:id,name,category_id',
                'grandchild:id,name,subcategory_id',
                'files' => function ($q) {
                    $q->where($this->activeStatusCondition())
                        ->orderByRaw("CASE WHEN type = 'image' THEN 0 ELSE 1 END")
                        ->orderByDesc('is_primary')
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },
                'specValues' => function ($q) {
                    $q->whereNotNull('value_text')
                        ->where('value_text', '!=', '')
                        ->with([
                            'field' => function ($fieldQuery) {
                                $fieldQuery->where($this->activeStatusCondition())
                                    ->with([
                                        'group' => function ($groupQuery) {
                                            $groupQuery->select('id', 'title', 'sort_order');
                                        },
                                    ]);
                            },
                        ]);
                },
            ])
            ->where($this->activeStatusCondition())
            ->orderBy('created_at', 'desc');

        if ($productId) {
            return $query->where('id', (int) $productId)->first();
        }

        return $query->first();
    }

    private function buildKeySpecs(Product $product): array
    {
        return $product->specValues
            ->filter(function ($specValue) {
                return $specValue->field && (bool) $specValue->field->is_key;
            })
            ->sortBy(function ($specValue) {
                return [
                    (int) ($specValue->field->group->sort_order ?? 999999),
                    (int) ($specValue->field->sort_order ?? 999999),
                    (int) $specValue->id,
                ];
            })
            ->map(function ($specValue) {
                return [
                    'label' => $specValue->field->label,
                    'value' => $specValue->value_text,
                    'unit' => $specValue->field->unit,
                ];
            })
            ->values()
            ->all();
    }

    private function buildOtherSpecsGrouped(Product $product): array
    {
        $nonKeySpecs = $product->specValues
            ->filter(function ($specValue) {
                return $specValue->field && !(bool) $specValue->field->is_key;
            })
            ->sortBy(function ($specValue) {
                return [
                    (int) ($specValue->field->group->sort_order ?? 999999),
                    (int) ($specValue->field->sort_order ?? 999999),
                    (int) $specValue->id,
                ];
            });

        $grouped = [];

        foreach ($nonKeySpecs as $specValue) {
            $groupId = (string) ($specValue->field->group->id ?? 'ungrouped');
            $groupTitle = $specValue->field->group->title ?? 'Other Details';
            $groupSortOrder = (int) ($specValue->field->group->sort_order ?? 999999);

            if (!isset($grouped[$groupId])) {
                $grouped[$groupId] = [
                    'title' => $groupTitle,
                    '_sort_order' => $groupSortOrder,
                    'fields' => [],
                ];
            }

            $grouped[$groupId]['fields'][] = [
                'label' => $specValue->field->label,
                'value' => $specValue->value_text,
                'unit' => $specValue->field->unit,
                'sort_order' => (int) ($specValue->field->sort_order ?? 999999),
            ];
        }

        uasort($grouped, function ($a, $b) {
            return $a['_sort_order'] <=> $b['_sort_order'];
        });

        return array_values(array_map(function ($group) {
            usort($group['fields'], function ($a, $b) {
                return $a['sort_order'] <=> $b['sort_order'];
            });
            unset($group['_sort_order']);
            return $group;
        }, $grouped));
    }

    private function buildDownloadFilesByType(Product $product): array
    {
        $files = $this->activeDownloadFilesCollection($product);

        $grouped = [];

        foreach ($files as $file) {
            $type = (string) $file->type;
            $label = $this->humanizeFileType($type);

            if (!isset($grouped[$type])) {
                $grouped[$type] = [
                    'type' => $type,
                    'label' => $label,
                    'files' => [],
                ];
            }

            $grouped[$type]['files'][] = [
                'id' => $file->id,
                'title' => $file->title ?: basename($file->path),
                'mime_type' => $file->mime_type,
                'size_bytes' => (int) $file->size_bytes,
                'size_label' => $this->formatBytes((int) $file->size_bytes),
                'updated_label' => optional($file->updated_at)->format('M Y'),
                'extension' => $this->fileExtensionLabel($file),
                'download_url' => route('product.files.download', ['file' => $file->id, 'id' => $product->id]),
            ];
        }

        ksort($grouped);
        return $grouped;
    }

    private function activeProductsForDownloadCenter(?int $categoryId, ?int $subcategoryId, ?int $grandchildId)
    {
        $products = $this->applyProductFilters(
            Product::query()
                ->with([
                    'grandchild:id,name',
                    'subcategory:id,name',
                ])
                ->where($this->activeStatusCondition())
                ->orderBy('title'),
            $categoryId,
            $subcategoryId,
            $grandchildId
        )->get(['id', 'title', 'subcategory_id', 'grandchild_id']);

        $fileCounts = ProductFile::query()
            ->selectRaw('product_id, COUNT(*) as aggregate_count')
            ->whereIn('product_id', $products->pluck('id'))
            ->where('type', '!=', 'image')
            ->where($this->activeStatusCondition())
            ->groupBy('product_id')
            ->pluck('aggregate_count', 'product_id');

        return $products->map(fn(Product $product) => [
            'id' => $product->id,
            'name' => $product->title,
            'count' => (int) ($fileCounts[$product->id] ?? 0),
            'grandchild_name' => $product->grandchild?->name,
            'subcategory_name' => $product->subcategory?->name,
        ]);
    }

    private function resolveDownloadCenterSelection(
        $categoryInput,
        $subcategoryInput,
        $grandchildInput,
        $productInput,
        $fileTypeInput
    ): array {
        $selected = $this->resolveSelectedFilters($categoryInput, $subcategoryInput, $grandchildInput);
        $productId = $this->normalizeId($productInput);
        $product = null;
        $category = null;
        $subcategory = null;
        $grandchild = null;

        if (!empty($selected['category_id'])) {
            $category = Category::query()
                ->where('id', $selected['category_id'])
                ->where($this->activeStatusCondition())
                ->first(['id', 'name']);
        }

        if (!empty($selected['subcategory_id'])) {
            $subcategory = Subcategory::query()
                ->where('id', $selected['subcategory_id'])
                ->where($this->activeStatusCondition())
                ->first(['id', 'name']);
        }

        if (!empty($selected['grandchild_id'])) {
            $grandchild = Grandchild::query()
                ->where('id', $selected['grandchild_id'])
                ->where($this->activeStatusCondition())
                ->first(['id', 'name']);
        }

        $grandchildSelectionRequired = false;
        if (!empty($selected['subcategory_id'])) {
            $grandchildSelectionRequired = Grandchild::query()
                ->where('subcategory_id', $selected['subcategory_id'])
                ->where($this->activeStatusCondition())
                ->exists();
        }

        if ($grandchildSelectionRequired && empty($selected['grandchild_id'])) {
            $productId = null;
        }

        if (!empty($productId)) {
            $product = Product::query()
                ->with([
                    'files' => function ($q) {
                        $q->where($this->activeStatusCondition())
                            ->orderBy('sort_order')
                            ->orderBy('id');
                    },
                ])
                ->where('id', $productId)
                ->where($this->activeStatusCondition())
                ->first(['id', 'category_id', 'subcategory_id', 'grandchild_id', 'title']);

            if (
                !$product ||
                (!empty($selected['category_id']) && (int) $product->category_id !== (int) $selected['category_id']) ||
                (!empty($selected['subcategory_id']) && (int) $product->subcategory_id !== (int) $selected['subcategory_id']) ||
                (
                    !empty($selected['grandchild_id'])
                    ? (int) $product->grandchild_id !== (int) $selected['grandchild_id']
                    : ($grandchildSelectionRequired && !is_null($product->grandchild_id))
                )
            ) {
                $product = null;
                $productId = null;
            }
        }

        $fileType = is_string($fileTypeInput) ? trim($fileTypeInput) : '';
        if ($fileType === '') {
            $fileType = null;
        }

        if ($product && $fileType) {
            $availableTypes = collect($this->buildDownloadTypeOptions($product))->pluck('id')->all();
            if (!in_array($fileType, $availableTypes, true)) {
                $fileType = null;
            }
        } else {
            $fileType = null;
        }

        return [
            'category_id' => $selected['category_id'],
            'subcategory_id' => $selected['subcategory_id'],
            'grandchild_id' => $selected['grandchild_id'],
            'product_id' => $productId,
            'category' => $category,
            'subcategory' => $subcategory,
            'grandchild' => $grandchild,
            'product' => $product,
            'file_type' => $fileType,
        ];
    }

    private function buildDownloadTypeOptions(Product $product): array
    {
        $filesByType = $this->buildDownloadFilesByType($product);

        if (empty($filesByType)) {
            return [];
        }

        return array_values(array_merge(
            [[
                'id' => '__all__',
                'name' => 'All Files',
                'count' => array_sum(array_map(fn(array $typeBlock) => count($typeBlock['files']), array_values($filesByType))),
                'extension' => 'ALL',
            ]],
            array_map(fn(array $typeBlock) => [
                'id' => $typeBlock['type'],
                'name' => $typeBlock['label'],
                'count' => count($typeBlock['files']),
                'extension' => strtoupper(substr($typeBlock['files'][0]['extension'] ?? $typeBlock['type'], 0, 4)),
            ], array_values($filesByType))
        ));
    }

    private function buildDownloadFilesForSelection(Product $product, ?string $fileType): array
    {
        if (!$fileType) {
            return [];
        }

        if ($fileType === '__all__') {
            return array_values(array_map(function (array $typeBlock) {
                return [
                    'type' => $typeBlock['type'],
                    'label' => $typeBlock['label'],
                    'files' => $typeBlock['files'],
                ];
            }, array_values($this->buildDownloadFilesByType($product))));
        }

        $filesByType = $this->buildDownloadFilesByType($product);
        return $filesByType[$fileType]['files'] ?? [];
    }

    private function activeDownloadFilesCollection(Product $product)
    {
        return $product->files
            ->where('type', '!=', 'image')
            ->filter(fn(ProductFile $file) => $this->isActiveStatusValue($file->getRawOriginal('status')))
            ->sortBy(fn(ProductFile $file) => [(string) $file->type, (int) ($file->sort_order ?? 999999), (int) $file->id])
            ->values();
    }

    private function serializeDownloadFiles(array $files): array
    {
        return array_map(function (ProductFile $file) {
            return [
                'id' => $file->id,
                'title' => $file->title ?: basename($file->path),
                'mime_type' => $file->mime_type,
                'size_bytes' => (int) $file->size_bytes,
                'size_label' => $this->formatBytes((int) $file->size_bytes),
                'updated_label' => optional($file->updated_at)->format('M Y'),
                'extension' => $this->fileExtensionLabel($file),
                'download_url' => route('product.files.download', ['file' => $file->id, 'id' => $file->product_id]),
            ];
        }, $files);
    }

    private function humanizeFileType(string $type): string
    {
        return ucwords(str_replace('_', ' ', $type));
    }

    private function activeProductCountMap(string $column): array
    {
        return Product::query()
            ->selectRaw($column . ' as aggregate_key, COUNT(*) as aggregate_count')
            ->whereNotNull($column)
            ->where($this->activeStatusCondition())
            ->groupBy($column)
            ->pluck('aggregate_count', 'aggregate_key')
            ->map(fn($count) => (int) $count)
            ->all();
    }

    private function activeGrandchildCountMap(): array
    {
        return Grandchild::query()
            ->selectRaw('subcategory_id as aggregate_key, COUNT(*) as aggregate_count')
            ->where($this->activeStatusCondition())
            ->groupBy('subcategory_id')
            ->pluck('aggregate_count', 'aggregate_key')
            ->map(fn($count) => (int) $count)
            ->all();
    }

    private function fileExtensionLabel(ProductFile $file): string
    {
        $extension = pathinfo($file->title ?: $file->path, PATHINFO_EXTENSION);
        if (!$extension) {
            return strtoupper(substr((string) $file->type, 0, 4));
        }

        return strtoupper(substr($extension, 0, 4));
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return 'Unknown size';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = min((int) floor(log($bytes, 1024)), count($units) - 1);
        $value = $bytes / (1024 ** $power);

        return number_format($value, $power === 0 ? 0 : 1) . ' ' . $units[$power];
    }

    private function normalizeId($value): ?int
    {
        $id = filter_var($value, FILTER_VALIDATE_INT);
        return $id && $id > 0 ? (int) $id : null;
    }

    private function activeStatusCondition(): \Closure
    {
        return function ($q) {
            $q->where('status', 1)
                ->orWhere('status', '1')
                ->orWhereRaw('LOWER(status) = ?', ['active']);
        };
    }

    private function isActiveStatusValue($status): bool
    {
        if ($status === null) {
            return false;
        }

        $value = strtolower(trim((string) $status));
        return $value === '1' || $value === 'active';
    }

    private function resolveStoragePath(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $normalized = ltrim(str_replace('\\', '/', $path), '/');
        $diskPath = Storage::disk('public')->path($normalized);
        if (file_exists($diskPath)) {
            return $diskPath;
        }

        $publicStoragePath = public_path('storage/' . $normalized);
        if (file_exists($publicStoragePath)) {
            return $publicStoragePath;
        }

        $basePath = base_path($normalized);
        if (file_exists($basePath)) {
            return $basePath;
        }

        return null;
    }

    private function serializeProductCard(Product $product): array
    {
        $image = $product->files->first();
        $imageUrl = $image ? asset('storage/' . ltrim($image->path, '/')) : null;

        return [
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'category_name' => $product->category?->name,
            'subcategory_name' => $product->subcategory?->name,
            'grandchild_name' => $product->grandchild?->name,
            'image_url' => $imageUrl,
            'product_url' => route('product', ['id' => $product->id]),
        ];
    }
}
