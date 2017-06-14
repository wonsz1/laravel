<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Repositories\ImageRepository;
use App\Product;
use App\Image;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
	protected $images;

	public function __construct(Image $image)
	{
        $this->middleware('auth');
		$this->images = $image;
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
		return view('products.index', [
			'products' => Product::paginate(20)
		]);
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:128',
			'price' => 'required|numeric',
			'description' => 'required'
		]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
		
		if($request->hasFile('image')){
		    $name = $this->imageUpload($request->file('image'));

            Image::create([
                'product_id' => $product->id,
                'path' =>  $name,
            ]);
		}

        Session::flash('message', 'Successfully added product!');
		return redirect('/products');
	}

    //[TODO] przerzucic to do jakiegoś helpera czy coś
    private function imageUpload($file)
    {
        $nameBig = 'image_' . time() . '-big.' . $file->extension();
        $nameSmall = 'image_' . time() . '.' . $file->extension();

        $manager = new ImageManager();
        $img = $manager->make($file);
  
        if ($img->height() > $img->width()) {
            //change height first
            $this->resizeAndSave($img, $nameBig, null, 500);
            $this->resizeAndSave($img, $nameSmall, null, 250);
        } else {
            //change width first
            $this->resizeAndSave($img, $nameBig, 500, null);
            $this->resizeAndSave($img, $nameSmall, 250, null);
        }

        return $nameSmall;
    }

    //[TODO] przerzucic to do jakiegoś helpera czy coś
    private function resizeAndSave($img, $name, $size1, $size2)
    {
        $img->resize($size1, $size2, function ($constraint) {
            $constraint->aspectRatio();
        })
        ->resizeCanvas($size2, $size1, 'center', false, '000000');
        
        $img->save('uploads/' . $name);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function show($id)
	{
		return view('products.show', [
			'product' => Product::findOrFail((int) $id)
		]);
	}

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function edit($id)
	{
        return view('products.edit', [
            'product' => Product::findOrFail((int) $id)
        ]);
	}

	public function update(Request $request, $id)
	{
        $this->validate($request, [
            'name' => 'required|max:128',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $product = Product::findOrFail((int) $id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = 'image_' . time() . '.' . $file->extension();

            $file->move('uploads', $name);

            Image::create([
                'product_id' => $product->id,
                'path' =>  $name,
            ]);
        }

        Session::flash('message', 'Successfully updated product!');
        return redirect('/products');
	}

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function destroy($id)
	{
		$product = Product::findOrFail((int) $id);
		$product->delete();

		return redirect('/products');
	}
}
