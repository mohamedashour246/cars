<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
   public function getContact()
   {
       $contacts = Contact::all();
       return view('admin.contact.display',compact('contacts'));
   }  

   public function addContact()
   {
       return view('admin.contact.create');
   }

//    public function postContact(Request $request)
//    {
//        $contact = new Contact();
//        $contact->address = $request['address'];
//        $contact->city = $request['city'];
//        $contact->phone_c1 = $request['phone1'];
//        $contact->phone_c2 = $request['phone2'];
//        $contact->fax = $request['fax'];
//        $contact->email = $request['email'];
//        $contact->site = $request['site'];
//        $contact->map = $request['map'];
//        $contact->save();

//        if($contact->save())
//        {
//           return redirect()->route('admin.contact')->with('success','تم الاضافة بنجاح');
//        }
//    }

   public function editContact($id)
   {
       $contact = Contact::find($id);
       return view('admin.contact.edit',compact('contact'));
   }

   public function updateContact($id)
   {
       $contact = Contact::find($id);

       $validator = Validator::make(request()->all(),[
            'address' => 'required',
            'city' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'site' => 'required',
            'map' => 'required',
       ],
       [
           'address.required' => 'من فضلك قم بتسجيل العنوان',
           'city.required' => 'من فضلك قم بتسجيل الدولة',
           'phone1.required' => 'من فضلك قم بتسجيل الهاتف',
           'phone2.required' => 'من فضلك قم بتسجيل الهاتف',
           'fax.required' => 'من فضلك قم بتسجيل الفاكس',
           'email.required' => 'من فضلك قم بتسجيل البريد الالكترونى',
           'site.required' => 'من فضلك قم بتسجيل الموقع',
           'map.required' => 'من فضلك قم بتسجيل الخريطة'
       ]
      );

       if($validator->fails())
       {
           return redirect()->back()->with('errors',$validator->errors());
       }

       $contact->address = request('address');
       $contact->city = request('city');
       $contact->phone_c1 = request('phone1');
       $contact->phone_c2 = request('phone2');
       $contact->fax = request('fax');
       $contact->email = request('email');
       $contact->site = request('site');
       $contact->map = request('map');
       $contact->update();

       if($contact->update())
       {
           return redirect()->route('admin.contact')->with('success','تم التعديل بنجاح');
       }

       else {
        return redirect()->back()->with('fail','حدث خطأ ما');
    }
   }
}
