<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Product;
use App\Image;

class ProductController extends Controller
{
	protected $images;

	public function __construct(Image $image)
	{
		$this->images = $image;
	}

	public function index(Request $request)
	{
		return view('products.index', [
			'products' => Product::all()
		]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:128',
			'price' => 'required|numeric',
			'description' => 'required|max:255'
		]);

		Product::create([ 
			'name' => $request->name,
			'price' => $request->price,
			'description' => $request->description
		]);

		return redirect('/products');
	}
}
