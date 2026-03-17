<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Grandchild;
use App\Models\Product;
use App\Models\ProductFile;
use App\Models\Subcategory;
use App\Support\ZipArchiveFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductDownloadAllTest extends TestCase
{
    use RefreshDatabase;

    public function test_download_all_returns_redirect_with_error_when_zip_support_is_missing(): void
    {
        $product = $this->createActiveProduct();
        $this->createDownloadableFile($product);

        $this->app->instance(ZipArchiveFactory::class, new class extends ZipArchiveFactory
        {
            public function isAvailable(): bool
            {
                return false;
            }
        });

        $response = $this->from('/product?id=' . $product->id)
            ->get(route('product.files.downloadAll', ['id' => $product->id]));

        $response->assertRedirect('/product?id=' . $product->id);
        $response->assertSessionHas('danger', 'ZIP downloads are temporarily unavailable. Server ZIP support is not installed.');
    }

    public function test_download_all_returns_json_error_when_zip_support_is_missing(): void
    {
        $product = $this->createActiveProduct();
        $this->createDownloadableFile($product);

        $this->app->instance(ZipArchiveFactory::class, new class extends ZipArchiveFactory
        {
            public function isAvailable(): bool
            {
                return false;
            }
        });

        $response = $this->getJson(route('product.files.downloadAll', ['id' => $product->id]));

        $response->assertStatus(503);
        $response->assertJson([
            'message' => 'ZIP downloads are temporarily unavailable. Server ZIP support is not installed.',
        ]);
    }

    public function test_download_all_returns_download_response_when_zip_support_is_available(): void
    {
        if (! class_exists(\ZipArchive::class)) {
            $this->markTestSkipped('ext-zip is not installed in this PHP runtime.');
        }

        $product = $this->createActiveProduct();
        $this->createDownloadableFile($product, 'downloads/manual.pdf', 'Manual.pdf');

        $response = $this->get(route('product.files.downloadAll', ['id' => $product->id]));

        $response->assertOk();
        $response->assertHeader('content-disposition', 'attachment; filename=product-' . $product->id . '-files.zip');
    }

    public function test_download_all_returns_no_files_error_when_product_has_no_downloadable_files(): void
    {
        $product = $this->createActiveProduct();

        $response = $this->getJson(route('product.files.downloadAll', ['id' => $product->id]));

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'No files available for download.',
        ]);
    }

    public function test_download_all_returns_not_found_for_missing_product(): void
    {
        $response = $this->getJson(route('product.files.downloadAll', ['id' => 999999]));

        $response->assertNotFound();
        $response->assertJson([
            'message' => 'Product not found.',
        ]);
    }

    private function createActiveProduct(): Product
    {
        $category = Category::create([
            'name' => 'Category ' . uniqid(),
            'status' => '1',
        ]);

        $subcategory = Subcategory::create([
            'category_id' => $category->id,
            'name' => 'Subcategory ' . uniqid(),
            'status' => '1',
        ]);

        $grandchild = Grandchild::create([
            'subcategory_id' => $subcategory->id,
            'name' => 'Grandchild ' . uniqid(),
            'status' => '1',
        ]);

        return Product::create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'grandchild_id' => $grandchild->id,
            'title' => 'Product ' . uniqid(),
            'description' => 'Test product',
            'status' => '1',
        ]);
    }

    private function createDownloadableFile(Product $product, string $path = 'downloads/test-manual.pdf', string $title = 'Test Manual.pdf'): ProductFile
    {
        Storage::disk('public')->put($path, 'dummy file content');

        return ProductFile::create([
            'product_id' => $product->id,
            'type' => 'manual',
            'path' => $path,
            'title' => $title,
            'mime_type' => 'application/pdf',
            'size_bytes' => 18,
            'sort_order' => 1,
            'is_primary' => false,
            'status' => '1',
        ]);
    }
}
