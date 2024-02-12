<?php

namespace App\Http\Controllers\CntCms;

use App\Models\CntCms\CmsCategory;
use App\Models\CntCms\CmsPost;
use App\Models\Company;
use Illuminate\Http\Request;

class CntCmsPostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {

        $hostname = $request->input('company_id') ?? null;
        $category_name = $request->input('category_name') ?? null;
        $slug = $request->input('slug') ?? null;

        $category = CmsCategory::where('cnt_cms_category.name', $category_name)
            ->where('cnt_cms_category.company_id', $hostname)
            ->first();

        $parent = CmsPost::select(
            'cnt_cms_post.id',
            'cnt_cms_post.excerpt',
            'cnt_cms_post.image_url',
            'cnt_cms_post.name',
            'cnt_cms_post.slug',
            'cnt_cms_post.published_time',
            // 'cnt_cms_post.company_slug'
        )
        ->where('cnt_cms_post.category_id', (int)$category->id);

        $count = $parent->count();

        // dd($parent);

        if ($slug !== null) {
            $parent->addSelect('cnt_cms_post.content');
            $parent->where('cnt_cms_post.slug', '=', $slug);
        }

        $result = $parent->orderBy('create_date', 'desc')
            ->take($request->input('limit'))
            ->skip($request->input('offset'))->get();
        
        $response = [
            'count' => $count,
            'data' => $result,
        ];

        return response()->json($response);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
