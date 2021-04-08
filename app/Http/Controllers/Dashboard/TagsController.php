<?php

namespace App\Http\Controllers\Dashboard;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use DB;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }
//
//
    public function store(TagsRequest $request)
    {


        DB::beginTransaction();

        //validation
        $tag = Tag::create(['slug' => $request->slug]);

        //save translations
        $tag->name = $request->name;
        $tag->save();
        DB::commit();
        return redirect()->route('admin.tags')->with(['success' => 'تم ألاضافة بنجاح']);


    }


    public function edit($id)
    {

        //get specific categories and its translations
        $tag = Tag::find($id);
//        return   $tag->makeVisible(['translations']);
        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => 'هذا الماركة غير موجود ']);

        return view('dashboard.tags.edit', compact('tag'));

    }


    public function update($id, TagsRequest  $request)
    {
        try {
            //validation

            //update DB


            $tag = Tag::find($id);



            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => 'هذا الماركة غير موجود']);


            DB::beginTransaction();


            $tag->update($request->except('_token', 'id'));  // update only for slug column

            //save translations
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $tags = Tag::find($id);
//            dd($tags->translations->delete());
            if (!$tags)
                return redirect()->route('admin.tags')->with(['error' => 'هذا الماركة غير موجود ']);

            DB::beginTransaction();
            $tags->delete();
            $tags->dropTranslation();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            report($ex);
            DB::rollback();
//            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            return redirect()->route('admin.tags')->with(['error' => $ex->getMessage()]);
        }
    }

}
