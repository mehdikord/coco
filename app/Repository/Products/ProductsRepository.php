<?php
namespace App\Repository\Products;


use App\Interfaces\Products\ProductsInterface;
use App\Models\Media;
use App\Models\Product;
use App\Services\MediaServices\MediaService;

class ProductsRepository implements ProductsInterface
{
    protected $per_page;
    protected $limit;
    protected $sort_by;
    protected $sort_type;

    public function __construct()
    {
        $this->per_page=15;
        $this->sort_type='ASC';
        $this->sort_by="id";
        if (request()->filled('per_page')){
            $this->per_page = request()->per_page;
        }
        if (request()->filled('sort_by')){
            $this->sort_by = request()->sort_by;
        }
        if (request()->filled('sort_type')){
            $this->sort_type = request()->sort_type;
        }

    }

    public function index()
    {
        $data = Product::query();
        $data->with('category');
        $data->with('brand');
        $data->with('images');

        $data->orderByDesc('id');
        return response_success($data->get());
    }

    public function store($request)
    {
        $item = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'sale' => $request->sale,
            'quantity' => $request->quantity,
            'commenting' => $request->commenting,
            'is_active' => true,
            'views' => 0,
            'sells' => 0,
        ]);
        //generate product code
        $item->update(['code' => core_random_code($item->id)]);


        $item->load('category');
        $item->load('brand');
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'sale' => $request->sale,
            'commenting' => $request->commenting,
        ]);

        return response_success($item);
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function activation($item)
    {
        $item->update(['is_active' => !$item->is_active]);
        return response_success(true,'item activation changed');
    }

    public function images_index($item)
    {
        return response_success($item->images);
    }

    public function images_store($item,$request)
    {
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'products');
            $media = Media::where('url',$image)->first();
            $item->images()->create([
                'image' => $image,
                'media_id' => $media->id
            ]);
            return response_success($item->images);
        }
        return response_custom_error('no image');
    }

    public function images_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function front_index()
    {
        $data = Product::query();
        $data->where('is_active',true);
        $data->with('category');
        $data->select([
            'id',
            'category_id',
            'brand_id',
            'name',
            'short_description',
            'price',
            'sale',
            'quantity',
            'views',
            'sells',
            'commenting',
            'rate'
        ]);

        return response_success($data->orderBy($this->sort_by,$this->sort_type)->paginate($this->per_page));
    }


}
