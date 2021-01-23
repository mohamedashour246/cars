<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function getPage()
    {
        $pages = Page::all();
        return view('admin.pages.display',compact('pages'));
    }

    public function addPage()
    {
        return view('admin.pages.create');
    }

    public function postPage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'name_ar' => 'required',
            'name_en' => 'required',
            'content' => 'required'
        ],
            [
                'image.required' => 'من فضلك قم باختيار الصورة',
                'image.mimes' => 'من فضلك قم باختيار صورة صحيحة',
                'name_ar.required' => 'من فضلك قم بتسجيل الصفحة بالعربى',
                'name_en.required' => 'من فضلك قم بتسجيل الصفحة بالانجليزى',
                'content.required' => 'من فضلك قم بتسجيل المحتوى'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if(request('image')){
            $file = request()->file('image');
            $path = "assets/uploads/pages";
            $random = rand(1111,9999);
            $name = rand(1111111,9999999);
            $fileName = $random.'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
        }
        $page = new Page();
        $page->name_ar = $request['name_ar'];
        $page->name_en = $request['name_en'];
        $page->image = $fileName;
        $page->content = $request['content'];
        $page->save();

        if($page->save())
        {
            return redirect()->route('admin.pages')->with('success','تم اضافة صفحة جديدة');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }
    }

    public function editPage($id)
    {
        $page = Page::find($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function updatePage($id)
    {
        $page = Page::find($id);

        $validator = Validator::make(request()->all(), [
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
            'name_ar' => 'required',
            'name_en' => 'required',
            'content' => 'required'
        ],
            [
                'image.mimes' => 'من فضلك قم باختيار صورة صحيحة',
                'name_ar.required' => 'من فضلك قم بتسجيل الصفحة بالعربى',
                'name_en.required' => 'من فضلك قم بتسجيل الصفحة بالانجليزى',
                'content.required' => 'من فضلك قم بتسجيل المحتوى'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if(request('image')){
            $file = request()->file('image');
            $path = "assets/uploads/pages";
            $random = rand(1111,9999);
            $name = rand(1111111,9999999);
            $fileName = $random.'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $page->image = $fileName;
        }
        $page->name_ar = request('name_ar');
        $page->name_en = request('name_en');
        $page->content = request('content');
        $page->update();

        if($page->update())
        {
            return redirect()->route('admin.pages')->with('success','تم تعديل الصفحة');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }
    }

    public function deletePage($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect()->back()->with('success','تم مسح الصفحة بنجاح');
    }
}
