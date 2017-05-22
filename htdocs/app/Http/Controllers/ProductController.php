<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

		$product = Product::create([ 
			'name' => $request->name,
			'price' => $request->price,
			'description' => $request->description
		]);
		
		if(Input::hasFile('image')){
			$file = Input::file('image');
			$file->move('uploads', $file->getClientOriginalName());

			Image::create([
				'product_id' => $product->id,
				'path' =>  $file->getClientOriginalName()
			]);
		}

		return redirect('/products');
	}

	public function destroy(Request $request, $id)
	{
		$product = Product::findOrFail((int) $id);
		$product->delete();

		return redirect('/products');
	}
}
