<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $companies = Company::allowedTrash()
     ->allowedSorts(['name', 'email', 'website'], '-id')
    //  ->allowedFilters("uaer_id")
     ->allowedSearch('name', 'email', "website")
    //  ->forUser(auth()->user())
     ->withCount('contact')
     ->paginate(10);

     return view("companies.index", compact("companies"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        return view('companies.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {

        $request->user()->companies()->create($request->validated());

        return redirect()->route("companies.index")
        ->with('message', 'Company has been added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
       return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
         return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {

        $company->update($request->validated());
      return redirect()->route("companies.index")->with('message', 'Company has been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        $redirect = request()->query('redirect');

        return ($redirect ? redirect()->route($redirect) : back())
        ->with('dMessage', "Company has been moved to trash")
        ->with('undoRoute', getUndoRoute('companies.restore', $company));
        ;
    }

    public function restore(Company $company){
        $company->restore();


        return back()
        ->with('dMessage', "Company has been restored from trash")
        ->with('undoRoute', getUndoRoute('companies.destroy', $company));
        ;
    }

    public function forceDelete(Company $company){
        $company->forceDelete();


        return back()
        ->with('dMessage', 'Contact has been removed permanetaly');

        ;
    }


} // end of COmpany Controller
