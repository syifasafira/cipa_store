<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LookbookController extends Controller
{
    public function index()
    {
        // In a real app, these would come from a Lookbook model with images and linked products.
        // For now, we'll use static style inspiration data.
        $lookbooks = [
            [
                'title' => 'Urban Minimalist',
                'description' => 'Clean lines and monochromatic tones for the city dweller.',
                'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80&w=800',
                'category_slug' => 'baju'
            ],
            [
                'title' => 'Casual Friday',
                'description' => 'Relaxed fits that transition seamlessly from work to weekend.',
                'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=800',
                'category_slug' => 'baju'
            ],
             [
                'title' => 'Streetwear Essentials',
                'description' => 'Bold accessories and comfortable sneakers for standout style.',
                'image' => 'https://images.unsplash.com/photo-1552346154-21d32810aba3?auto=format&fit=crop&q=80&w=800',
                'category_slug' => 'sepatu'
            ],
             [
                'title' => 'Elegant Evening',
                'description' => 'Sophisticated silhouettes for special occasions.',
                'image' => 'https://images.unsplash.com/photo-1566174053879-31528523f8ae?auto=format&fit=crop&q=80&w=800',
                'category_slug' => 'celana-rok'
            ],
             [
                'title' => 'Summer Vibes',
                'description' => 'Light fabrics and bright colors for sunny days.',
                'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&q=80&w=800',
                'category_slug' => 'aksesoris'
            ],
             [
                'title' => 'Modest Fashion',
                'description' => 'Stylish and covering outfits for the modern woman.',
                'image' => 'https://images.pexels.com/photos/35263628/pexels-photo-35263628.jpeg',
                'category_slug' => 'hijab'
            ],
        ];

        return view('lookbook', compact('lookbooks'));
    }
}
