<?php

use App\Livewire\Pages\DogPage;
use App\Livewire\Ecommerce\Shop;
use App\Livewire\Pages\BlogPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Ecommerce\GetCart;
use App\Livewire\Pages\ContactPage;
use App\Livewire\Pages\DonationPage;
use App\Livewire\Pages\Announcements;
use App\Livewire\Pages\DogSinglePage;
use App\Livewire\Pages\VolunteerPage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Ecommerce\SingleProd;
use App\Livewire\Adoption\AdoptionCart;
use App\Livewire\Pages\ApplicationForm;

use App\Livewire\Pages\SingleBlogPostPage;
use App\Livewire\Ecommerce\ProductReviewsForm;
use App\Livewire\Pages\AnnouncementSinglePage;
use App\Http\Controllers\Paymongo\PaymentController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/adopt/application-form', ApplicationForm::class)->name('page.app-form');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/singleProd/{prod_slug}',SingleProd::class)->name('page.singleProd'); // para sa long description and reviews of specific product
Route::get('/review', ProductReviewsForm::class)->name('page.review');
Route::get('/shop', Shop::class)->name('page.shop');
Route::get('/cart', GetCart::class)->name('page.get-cart'); // ecommerce cart

Route::get('/', HomePage::class)->name('page.home');
Route::get('/dogs', DogPage::class)->name('page.dogs');
Route::get('/dogs/{dog_slug}', DogSinglePage::class)->name('page.dog.single');

Route::get('/volunteer', VolunteerPage::class)->name('page.volunteer');

Route::get('/blogs', BlogPage::class)->name('page.blogs');
Route::get('/blogs/{slug}', SingleBlogPostPage::class)->name('page.blog.single');

Route::get('/contact', ContactPage::class)->name('page.contact');

Route::get('/selected-dogs', AdoptionCart::class)->name('page.cart'); // adoption cart

Route::get('/donate', DonationPage::class)->name('page.donate');

// this work in laravel herd not in laragon
Route::get('/donation/redirect', [PaymentController::class, 'handleRedirect'])->name('donation.redirect');

Route::get('/announcements', Announcements::class)->name('page.announcements');
Route::get('/announcement/{announcementId}', AnnouncementSinglePage::class)->name('page.announcement-single');
