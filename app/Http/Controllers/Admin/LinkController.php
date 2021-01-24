<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function getLink()
    {
        $links = Link::all();
        return view('admin.links.display',compact('links'));
    }

    public function addLink()
    {
        return view('admin.links.create');
    }

    public function postLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'content_ar' => 'required',
            'content_en' => 'required',
            'link' => 'required'
        ],
            [
                'image.required' => 'من فضلك قم باختيار الصورة',
                'image.mimes' => 'من فضلك قم باختيار صورة صحيحة',
                'content_ar.required' => 'من فضلك قم بتسجيل العنوان بالعربى',
                'content_en.required' => 'من فضلك قم بتسجيل العنوان بالانجليزى',
                'link.required' => 'من فضلك قم بتسجيل الرابط'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if(request('image')){
            $file = request()->file('image');
            $path = "assets/uploads/links";
            $random = rand(1111,9999);
            $name = rand(1111111,9999999);
            $fileName = $random.'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
        }
        $link = new Link();
        $link->content_ar = $request['content_ar'];
        $link->content_en = $request['content_en'];
        $link->image = $fileName;
        $link->link = $request['link'];
        $link->save();

        if($link->save())
        {
            return redirect()->route('admin.links')->with('success','تم اضافة رابط جديد');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }
    }

    public function editLink($id)
    {
        $link = Link::find($id);
        return view('admin.links.edit',compact('link'));
    }

    public function updateLink($id)
    {
        $link = Link::find($id);

        $validator = Validator::make(request()->all(), [
            'image' => 'nullable|mimes:jpg,jpeg,png,gif',
            'content_ar' => 'required',
            'content_en' => 'required',
            'link' => 'required'
        ],
            [
                'image.mimes' => 'من فضلك قم باختيار صورة صحيحة',
                'content_ar.required' => 'من فضلك قم بتسجيل المحتوى بالعربى',
                'content_en.required' => 'من فضلك قم بتسجيل المحتوى بالانجليزى',
                'link.required' => 'من فضلك قم بتسجيل الرابط'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if(request('image')){
            $file = request()->file('image');
            $path = "assets/uploads/links";
            $random = rand(1111,9999);
            $name = rand(1111111,9999999);
            $fileName = $random.'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $link->image = $fileName;
        }
        $link->content_ar = request('content_ar');
        $link->content_en = request('content_en');
        $link->link = request('link');
        $link->update();

        if($link->update())
        {
            return redirect()->route('admin.links')->with('success','تم تعديل الرابط');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }
    }

    public function deleteLink($id)
    {
        $link = Link::find($id);
        $link->delete();

        return redirect()->back()->with('success','تم حذف الرابط بنجاح');
    }
}
