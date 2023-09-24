<?php
namespace App\Repository\Products;


use App\Interfaces\Products\ProductsInterface;
use App\Models\Media;
use App\Models\Product;
use App\Repository\Base\BasePaginateRepo;
use App\Services\MediaServices\MediaService;

class ProductsRepository extends BasePaginateRepo implements ProductsInterface
{

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
        if (request()->filled('random') && request()->random === 'true'){
            $data->inRandomOrder();
        }
        $data->select([
            'id',
            'category_id',
            'brand_id',
            'name',
            'short_description',
            'price',
            'sale',
            'code',
            'quantity',
            'views',
            'sells',
            'commenting',
            'rate',
        ]);
        $data->withCount('orders');

        //Categories
        if (request()->filled('category')){
            $category = json_decode(request()->category, false, 512, JSON_THROW_ON_ERROR);
            if (count($category)){
                $category_ids = shop_categories_filter($category);
                if (count($category_ids)){
                    $data->whereIn('category_id',$category_ids);
                }

            }

        }


        //Min and Max Prices
        if (request()->filled('min_price')){
            $data->where('price','>=',request()->min_price);
        }
        if (request()->filled('max_price')){
            $data->where('price','<=',request()->max_price);
        }

        return response_success($data->orderBy($this->sort_by,$this->sort_type)->paginate($this->per_page)->appends(request()->except('page')));
    }

    public function front_show($item)
    {
        $product = Product::where('code',$item)
            ->withCount('comments')
            ->where('is_active',true)
            ->with(['comments.user' => function ($comment_user){
                $comment_user->select(['id','name']);
            }])
            ->with(['comments' => function ($comment){
                $comment->take(3)->get();
            }])
            ->firstorfail();
        $product->load('images');
        $product->load('category');
        $product->load('brand');
        $product->load('category.parent');
        return response_success($product);
    }

    public function front_comments($item)
    {
        $product = Product::where('code',$item)->where('is_active',true)->firstorfail();
        $comments = $product->comments()->with(['user' => function ($user){
            $user->select(['id','name']);
        }])->get();

        return response_success($comments);
    }


}
