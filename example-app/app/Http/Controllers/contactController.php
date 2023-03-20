<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class contactController extends Controller
{
    // index method
    protected $company;

    public function __construct(CompanyRepository $company)
    {
       $this->company = $company;
    }
    public function index(){
        // $companies = [
        //     1 => [ 'name' => "company 1", "contact" => 3],
        //     2 => [ 'name' => "company 2", "contact" => 5]
        // ];

        // dd(Auth::user());

        $companies = $this->company->pluck();


        // $arr = $this->getContact();
        // $arr = Contact::latest()->get();
        // $query = Contact::query();


        // ->auth()->user()->contact()
        $arr = Contact::allowedTrash()->
        // latest()->
        allowedSorts(["first_name", "last_name", "email", "phone"], "-first_name")
        ->allowedFilters('company_id')
        ->allowedSearch('first_name', 'last_name', 'email')
        // ->with('company')
        ->paginate(10);


        return view("index/in",compact("arr", 'companies'));
    } // end of index method

    // create method
public function create(){

    $companies = $this->company->pluck();
    $contact = new Company();

    return view("index.create", compact('companies', 'contact'));
} // end of create method

// show method
public function show(Contact $index){


    // $contact = Contact::findOrFail($id);
    // abort_if(!empty($contact), 404);
    // print_r($contact);
    // echo $contact['name'];
    return view("index.show")->with("contact", $index);
} // end of method show


public function store(ContactRequest $request)
{
    // $request->validate($request ->rules());
    // Contact::create($request->all());

    $contact =  Contact::create($request->only('first_name', 'last_name', 'address', 'phone', 'email', 'company_id'));

    return redirect()->route('index.index')->with('message', 'Contact has been added Successfully');
    // if($request->filled('first_name'))
    // dd($request->first_name);
    // else
    // dd('this input is empty');
}

/*
protected function rules(){
    return [
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email',
        'phone' =>  'nullable',
        'address' => 'nullable',
        'company_id' => 'required|exists:companies,id'

    ];
}
*/

public function edit(Contact $index){
    $companies = $this->company->pluck();

    // $contact = Contact::findOrFail($id);
    // abort_if(!empty($contact), 404);
    // print_r($contact);
    // echo $contact['name'];
    return view("index.edit", compact('companies'))->with('contact', $index);
} // end of method show

public function update(ContactRequest $request, $id)
{
    $contact = Contact::findOrFail($id);

    // $request->validate($this->rules());
    // Contact::create($request->all());

    // $contact =  Contact::create($request->only('first_name', 'last_name', 'address', 'phone', 'email', 'company_id'));
    $contact->update($request->all());

    return redirect()->route('index.index')->with('message', 'Contact has been updated Successfully');
    // if($request->filled('first_name'))
    // dd($request->first_name);
    // else
    // dd('this input is empty');
}

public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();
    // return back()->with('dMessage', 'Contact has been Deleted Successfully');
    $redirect = request()->query('redirect');
    return ($redirect ? redirect()->route($redirect) : back())
    ->with('dMessage', 'Contact has been moved to trash')
    ->with('undoRoute', getUndoRoute('index.restore', $contact));

}

public function restore($id)
{
    $contact = Contact::onlyTrashed()->findOrFail($id);
    $contact->restore();
    // return back()->with('dMessage', 'Contact has been Deleted Successfully');
    return back()
    ->with('dMessage', 'Contact has been restored from trash')
    ->with('undoRoute', getUndoRoute('index.destroy', $contact));

}


public function forceDelete($id)
{
    $contact = Contact::onlyTrashed()->findOrFail($id);
    $contact->forceDelete();
    // return back()->with('dMessage', 'Contact has been Deleted Successfully');
    return back()
    ->with('dMessage', 'Contact has been removed permanetaly');

}

// get contact data
// protected function getContact(){
//     return [
//         1 => ["id" => 1, 'name' => "name 1", "phone" => "29 9998382178"],
//         2 => ["id" => 2, 'name' => "name 2", "phone" => "29 9998382178"],
//         3 => ["id" => 3,'name' => "name 3", "phone" => "29 9998382178"]

//     ];
// }

} // end of class
