<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@maisagro.test',
            'role' => 'admin',
        ]);
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_update_settings_and_see_them_on_frontend(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('admin.settings.update'), [
            'group' => 'appearance',
            'hero_title' => 'Customized Admin Real Estate Title',
            'hero_badge' => 'VERIFIED EXCLUSIVE DEVELOPER',
        ]);

        $response->assertRedirect(route('admin.settings.index', ['group' => 'appearance']));

        $this->assertEquals('Customized Admin Real Estate Title', Setting::get('hero_title'));
        $this->assertEquals('VERIFIED EXCLUSIVE DEVELOPER', Setting::get('hero_badge'));

        // Verify homepage shows the updated settings
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Customized Admin Real Estate Title');
        $homeResponse->assertSee('VERIFIED EXCLUSIVE DEVELOPER');
    }

    public function test_admin_can_update_product_and_changes_reflect_on_public_page(): void
    {
        $this->actingAs($this->admin);

        $category = Category::create([
            'name' => 'Duplex Villas',
            'slug' => 'duplex-villas',
            'type' => 'product',
            'is_active' => true,
        ]);

        $product = Product::create([
            'name' => 'Luxury Royal Villa',
            'slug' => 'luxury-royal-villa',
            'category_id' => $category->id,
            'price_range' => '₹1.50 Cr - ₹2.20 Cr',
            'short_description' => 'Original description',
            'featured_image' => 'images/properties/villa.jpg',
            'status' => true,
            'is_featured' => true,
        ]);

        // Update product via admin route
        $updateResponse = $this->put(route('admin.products.update', $product->id), [
            'name' => 'Royal Signature Villa Patia',
            'category_id' => $category->id,
            'price_range' => '₹1.80 Cr - ₹2.50 Cr',
            'short_description' => 'Updated luxury villa description with private courtyard.',
            'featured_image_url' => '/images/properties/new-villa.jpg',
            'status' => 1,
            'is_featured' => 1,
        ]);

        $updateResponse->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $this->assertEquals('Royal Signature Villa Patia', $product->name);
        $this->assertEquals('₹1.80 Cr - ₹2.50 Cr', $product->price_range);

        // Verify on public product show route
        $showResponse = $this->get(route('products.show', $product->slug));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Royal Signature Villa Patia');
        $showResponse->assertSee('₹1.80 Cr - ₹2.50 Cr');
        $showResponse->assertSee('Updated luxury villa description with private courtyard.');
    }
}
