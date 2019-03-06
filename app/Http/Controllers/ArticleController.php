<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\ArticleCategory;

class ArticleController extends Controller
{
    public function getHomePage(){
        $page = \request()->get('page') ?? 1;
        $article = Article::select('id','title', 'description', 'thumbnail', 'slug')->where('status', 1)->orderBy('published_at', 'DESC')->take(10)->skip(($page-1)*10)->get();
        return view('pages.home',compact('article', 'total'));
    }

    public function getDetailPage($slug){
        $slug = trim($slug);
        $detail = Article::where('status', 1)->where('slug', $slug)->first();
        if($detail){
            if($detail->related) {
                $related = Article::where('status', 1)->whereIn('id', json_decode($detail->related))->get();
            }else {
                $related = Article::inRandomOrder()->where('status', 1)->where('source', $detail->source)->where('id', '!=',$detail->id)->take(6)->skip(0)->get();
            }
            $tags = [];
            if($detail->source){
                $tags = [$detail->source];
            }
            $taged = DB::table('article_categories')->leftJoin('categories', 'article_categories.cate', '=', 'categories.id')->where('article_categories.post', $detail->id)->pluck('categories.name')->toArray();

            if (count($taged)>0){
                $tags = array_merge($tags, $taged);
            }
            return view('pages.detail', compact('detail','related', 'tags'));
        }
        abort('404');
    }

    public function getTagPage($tag){
        $slug = trim($tag);
        $page = \request()->get('page') ?? 1;
        $arr_relate = array();
        $tag_info = Category::select('id')->where('status',1)->where('slug', $tag)->first();
        if($tag_info && $tag_info->id){
            $tag_id = $tag_info->id;
            $arr_relate = ArticleCategory::select('post')->where('cate', $tag_id)->pluck('post')->toArray();
        }
        $result = Article::where('status', 1)->where('source', $slug)->orWhereIn('id', $arr_relate)->take(10)->skip(($page-1)*10)->get();
        $total = Article::where('status', 1)->where('source', $slug)->orWhereIn('id', $arr_relate)->count();
        $type = 'tag';
        return view('pages.tags', compact('result', 'total', 'page', 'type'));
    }

    public function getSearchPage(){
        $key = \request()->get('keyword');
        $page = \request()->get('page') ?? 1;
        $result = Article::where('status', 1)->where('title', 'like', '%' . $key . '%')->take(10)->skip(($page-1)*10)->get();
        $total = Article::where('status', 1)->where('title', 'like', '%' . $key . '%')->count();
        $type = 'search';
        return view('pages.tags', compact('result', 'total', 'page', 'type'));
    }
}
