<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About',
                'content' => 'This is the About page content. You can edit it later from the admin panel.',
                'status' => 'published',
                'show_in_menu' => true,
                'menu_order' => 1,
                'meta_title' => 'About Us',
                'meta_description' => 'Learn more about our company and team.'
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'portfolio'],
            [
                'title' => 'Portfolio',
                'content' => 'This is the Portfolio page content. Showcase your projects here.',
                'status' => 'published',
                'show_in_menu' => true,
                'menu_order' => 2,
                'meta_title' => 'Our Portfolio',
                'meta_description' => 'Check out our latest work and projects.'
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact',
                'content' => 'Feel free to reach out to us via this contact form.',
                'status' => 'published',
                'show_in_menu' => true,
                'menu_order' => 3,
                'meta_title' => 'Contact Us',
                'meta_description' => 'Get in touch with us through this page.'
            ]
        );

    }
}
