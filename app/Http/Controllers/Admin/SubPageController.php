<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\SubPage;
use Illuminate\Http\Request;
use Validator;

class SubPageController extends Controller
{
    public function getSubPage()
    {
        $sub_pages = SubPage::all();
        return view('admin.subpages.display',compact('sub_pages'));
    }

    public function addSubPage()
    {
        $pages = Page::all();
        return view('admin.subpages.create',compact('pages'));
    }

    public function postSubPage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'name_ar' => 'required',
            'name_en' => 'required',
            'content' => 'required',
            'page_id' => 'required'
        ],
            [
                'image.required' => 'من فضلك قم باختيار الصورة',
                'image.mimes' => 'من فضلك قم باختيار صورة صحيحة',
                'name_ar.required' => 'من فضلك قم بتسجيل الصفحة الفرعية بالعربى',
                'name_en.required' => 'من فضلك قم بتسجيل الصفحة الفرعية بالانجليزى',
                'content.required' => 'من فضلك قم بتسجيل المحتوى',
                'page_id.required' => 'من فضلك قم بتسجيل قسم الصفحة'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if(request('image')){
            $file = request()->file('image');
            $path = "assets/uploads/subpages";
            $random = rand(1111,9999);
            $name = rand(1111111,9999999);
            $fileName = $random.'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
        }
        $sub_page = new SubPage();
        $sub_page->name_ar = $request['name_ar'];
        $sub_page->name_en = $request['name_en'];
        $sub_page->image = $fileName;
        $sub_page->content = $request['content'];
        $sub_page->page_id = $request['page_id'];
        $sub_page->save();

        if($sub_page->save())
        {
            return redirect()->route('admin.subpages')->with('success','تم اضافة صفحة فرعية جديدة');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }
    }

    public function editSubPage($id)
    {
        $sub_page = SubPage::find($id);
        $pages = Page::all();
        return view('admin.subpages.edit', compact('sub_page','pages'));
    }

    public function updateSubPage($id)
    {
        $sub_page = SubPage::find($id);

        $validator = Validator::make(request()->all(), [
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
            'name_ar' => 'required',
            'name_en' => 'required',
            'content' => 'required',
            'page_id' => 'required'
        ],
            [
                'image.mimes' => 'من فضلك قم باختيار صورة صحيحة',
                'name_ar.required' => 'من فضلك قم بتسجيل الصفحة بالعربى',
                'name_en.required' => 'من فضلك قم بتسجيل الصفحة بالانجليزى',
                'content.required' => 'من فضلك قم بتسجيل المحتوى',
                'page_id.required' => 'من فضلك قم بتسجيل قسم الصفحة'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if(request('image')){
            $file = request()->file('image');
            $path = "assets/uploads/subpages";
            $random = rand(1111,9999);
            $name = rand(1111111,9999999);
            $fileName = $random.'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $sub_page->image = $fileName;
        }
        $sub_page->name_ar = request('name_ar');
        $sub_page->name_en = request('name_en');
        $sub_page->content = request('content');
        $sub_page->page_id = request('page_id');
        $sub_page->update();

        if($sub_page->update())
        {
            return redirect()->route('admin.subpages')->with('success','تم تعديل الصفحة الفرعية');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }
    }

    public function deleteSubPage($id)
    {
        $sub_page = SubPage::find($id);
        $sub_page->delete();

        return redirect()->back()->with('success','تم مسح الصفحة الفرعية بنجاح');

    }
}
