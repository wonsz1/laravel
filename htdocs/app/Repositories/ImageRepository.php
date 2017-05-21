<?php

namespace App\Repositories;

use App\Image;
use App\Product;

class ImageRepository
{
    /**
     * @param Product $product
     * @return Collection
     */
    public function getProductImage(Product $product)
    {
        return Image::where('product_id', $product->id)
            ->orderby('created_at', 'desc')
            ->get();
    }
}