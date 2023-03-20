<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Setting\PasswordController;
use App\Http\Controllers\Setting\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\welcomeController;
use App\Models\User;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name("home");

Route::get("/about-me", function(){
    return view("about");
})->name("about");
Route::view("contact-me", "contact", [
    'page_name' => "Contact Us",
    'page_description' => "This Is Description"
])->name("contact");

Route::get("category/{id}", function($id){
    // $name = request("name");

    // return view("category");
    // return $na;
    $cars = [
        "1" => "Programmer",
        "2" => "Gaming"
    ];
    return view("category", [
        'id' => $cars[$id] ?? "this Id Not Found"
    ]);
});

// route group
Route::prefix("admin")->group(function(){


Route::get("hi/{id}", function($id){
    return "<h1>Hello Every One $id</h1>";
})->where("id", "[0-9]+"); // or ->whereNumber("id");

Route::get("companies/{name?}", function($name = "The Company Is UnKown"){
    return "The Name Of The Company is " . $name;
// })->where("name", "[A-z]+");
})->whereAlpha('name');

});

Route::fallback(function(){
      return "<h1>This Page Is Not Found</h1>";
});

// if we have one controller pass to the route only the name of controller
Route::get('/', welcomeController::class)->name("home");

// Route::controller(contactController::class)->name("index.")->group(function(){

//     Route::get("index1",  'index')->name("index");

//     Route::get("create", 'create')->name("create");


//     Route::get("contact/{id}", 'show')->name("show");
// });

Route::middleware(['auth', 'verified'])->group(function(){


    Route::resource("/index", contactController::class);
    Route::delete('index/{index}/restore', [contactController::class, 'restore'])->name('index.restore');
    // ->withTrashed()

    Route::delete('index/{index}/force-delete', [contactController::class, 'forceDelete'])->name('index.force-delete');
    // ->withTrashed()

    Route::get('/dashboard', DashboardController::class);
    Route::get('/setting/profile-information', ProfileController::class)->name('user-profile-information.edit');
    Route::get('/setting/Edit-password', PasswordController::class)->name('user-password.edit');


    // Route::post("index1", [contactController::class, 'store'])->name('index.store');
    // Route::get("index1", [contactController::class, 'index'])->name("index.index");

    // Route::get("create", [contactController::class, 'create'])->name("index.create");


    // Route::get("contact/{id}", [contactController::class, 'show'])->name("index.show");
    // Route::get("contact/{id}/edit", [contactController::class, 'edit'])->name('index.edit');
    // Route::put("contact/{id}", [contactController::class, 'update'])->name('index.update');
    // Route::delete("contact/{id}/destroy", [contactController::class, 'destroy'])->name("index.destroy");

    Route::resource("/companies", CompanyController::class); // Route To Access to All Resource Method (crud)

    Route::delete('companies/{company}/restore', [CompanyController::class, 'restore'])->name('companies.restore')->withTrashed();
    Route::delete('companies/{company}/force-delete', [CompanyController::class, 'forceDelete'])->name('companies.force-delete')->withTrashed();


}); // end of middleware

Route::resources([
    "/tags" => TagController::class,
    "/tasks" => TaskController::class
]);
Route::resource("/activites", ActivityController::class)->names([
    "index" => "activites.all",
    'show' => "activites.view"

]);

// ->only([
//     'create', 'store', 'edit', 'update', 'destrory'

// ])


// Route::get("/download", function(){
//     return Storage::download('abood.jpg', 'profile.jpg');
// });


Route::get("eagerload-multiple", function(){
    $users = User::with(['companies', "contacts"])->get();

    foreach($users as $user){
      echo $user->name . ": ";
      echo $user->companies->count() . " Companies, <br>"
    //  . $user->contcats->count() . " Contacts<br>"
      ;
    }
});

Route::get("eagerload-nasted", function(){
    $users = User::with(['companies', "contacts"])->get();

    foreach($users as $user){
      echo $user->name . "<br>";
      foreach($user->companies as $company)
      echo "company name: " . $company->name . "<br>";

      echo "<br>";
    }

});

Route::get("eagerload-constraint", function(){
    $users = User::with(['companies' => function($query){
        $query->where('email', 'LIKE', "%.org");
    }])->get();

    foreach($users as $user){
      echo $user->name . "<br>";
      foreach($user->companies as $company)
      echo "company email: " . $company->email . "<br>";

      echo "<br>";
    }

});

Route::get("eagerload-lazy", function(){
    $users = User::get();
    $users->load(['companies' => function($query){
        $query->orderBy('name', 'desc');
    }]); // the same of the with('companies')


    foreach($users as $user){
      echo $user->name . "<br>";
      foreach($user->companies as $company)
      echo " company name: " . $company->name . " ,company email: " . $company->email . "<br>";

      echo "<br>";
    }

});

Route::get("eagerload-default", function(){
    $users = User::get();

    foreach($users as $user){
      echo $user->name . "<br>";
      foreach($user->companies as $company)
      echo "company email: " . $company->email . "<br>";

      echo "<br>";
    }

});

Route::get("count-model", function(){
    $users = User::withCount(['companies', 'contacts'])->get();

    foreach($users as $user){
      echo $user->name . "<br>";
      echo $user->companies_count . " companies <br>";
      echo $user->contacts_count . " contact <br>";

      echo "<br>";
    }

});

