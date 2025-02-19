<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurClientController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\ProfileAuthController;
use App\Http\Controllers\ProspectController;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\FournisseurClient;
use App\Models\Prospect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/',[UserController::class,'viewLogin'] );
Route::post('/login',[UserController::class,'login'] )->name('login');

Route::post('/',[UserController::class,'logout'])->name('form');

Route::get('/dashboardSection',[ChartController::class, 'index'])->name('dashboardSection')->middleware('checkAdmins_Users','auth');

Route::get('/usersSection', [UserController::class, 'index'])->name('usersSection')->middleware('checkSuperAdmin');
Route::post('/addUser',[UserController::class,'store'])->middleware('checkSuperAdmin');
Route::get('/editUser',[UserController::class,'edit'])->middleware('checkSuperAdmin');
Route::post('/updateUser',[UserController::class,'update'])->middleware('checkSuperAdmin');
Route::delete('/deleteUser/{id}',[UserController::class,'destroy'])->name('user.destroy')->middleware('checkSuperAdmin');

Route::get('/suppliersSection',[FournisseurController::class,'index'])->name('suppliersSection')->middleware('checkAdmins_Users');
Route::get('/suppliersSection/{id}',[FournisseurController::class,'fournisseur'])->middleware('checkAdmins');
Route::post('/addSupplier',[FournisseurController::class,'store'])->middleware('checkAdmins');
Route::post('/updateSupplier',[FournisseurController::class,'update'])->middleware('checkAdmins');
Route::delete('/deleteSupplier/{id}',[FournisseurController::class,'destroy'])->name('supplier.destroy')->middleware('checkSuperAdmin');

Route::get('/prospectsSection',[ProspectController::class,'index'])->name('prospectsSection')->middleware('checkAdmins_Users');
Route::post('/addProspect',[ProspectController::class,'store'])->name('prospect.add')->middleware('checkAdmins_Users');
Route::delete('/deleteProspect/{id}',[ProspectController::class,'destroy'])->name('prospect.destroy')->middleware('checkSuperAdmin');
Route::post('/updateProspect',[ProspectController::class,'update'])->name('prospect.update')->middleware('checkAdmins');


Route::get('/clientsSection',[ClientController::class,'index'])->name('clientsSection')->middleware('checkAdmins_Users');
Route::post('/addClient',[ClientController::class,'store'])->name('client.add')->middleware('checkAdmins_Users');
Route::delete('/deleteClient/{id}',[ClientController::class,'destroy'])->name('client.destroy')->middleware('checkSuperAdmin');
Route::post('/updateClient',[ClientController::class,'update'])->name('client.update')->middleware('checkAdmins');


Route::get('/suppliersAndClientsSection',[FournisseurClientController::class,'index'])->name('suppliersAndClientsSection')->middleware('checkAdmins_Users');
Route::post('/addFournisseurClient',[FournisseurClientController::class,'store'])->name('fournisseurClient.add')->middleware('checkAdmins_Users');
Route::delete('/deleteFournisseurClient/{id}',[FournisseurClientController::class,'destroy'])->name('fournisseurClient.destroy')->middleware('checkSuperAdmin');
Route::post('/updateFournisseurClient',[FournisseurClientController::class,'update'])->name('fournisseurClient.update')->middleware('checkAdmins');


Route::get('/categoriesSection',[CategorieController::class,'index'])->name('categoriesSection')->middleware('checkAdmins_Users');
Route::post('/addCategory',[CategorieController::class,'store'])->middleware('checkAdmins');
Route::get('/editCategory',[CategorieController::class,'edit'])->middleware('checkAdmins');
Route::post('/updateCategory',[CategorieController::class,'update'])->middleware('checkAdmins');
Route::delete('/deleteCategory/{id}',[CategorieController::class,'destroy'])->name('category.destroy')->middleware('checkSuperAdmin');

Route::get('/productsSection',[SousCategorieController::class,'index'])->name('productsSection')->middleware('checkAdmins_Users');
Route::post('/addSousCategory',[SousCategorieController::class,'store'])->middleware('checkAdmins');
Route::get('/editProduct',[SousCategorieController::class,'edit'])->middleware('checkAdmins');
Route::post('/updateProduct',[SousCategorieController::class,'update'])->middleware('checkAdmins');
Route::delete('/deleteProduct/{id}',[SousCategorieController::class,'destroy'])->name('product.destroy')->middleware('checkSuperAdmin');


Route::get('/search-users', [UserController::class, 'search'])->name('search.users');
// Route::get('/search-suppliers', [FournisseurController::class, 'search'])->name('search.suppliers');
Route::get('/search-categories', [CategorieController::class, 'search'])->name('search.categories');
Route::get('/search-products', [SousCategorieController::class, 'search'])->name('search.products');
// Route::get('/search-prospects', [ProspectController::class, 'search'])->name('search.prospects');
// Route::get('/search-clients', [ClientController::class, 'search'])->name('search.clients');
// Route::get('/search-fournisseurClients', [FournisseurClientController::class, 'search'])->name('search.fournisseurClients');

Route::delete('/product/destroy/{id}',[SousCategorieController::class,'destroy'])->middleware('checkSuperAdmin');
Route::delete('/category/destroy/{id}',[CategorieController::class,'destroy'])->middleware('checkSuperAdmin');
Route::delete('/supplier/destroy/{id}',[FournisseurController::class,'destroy'])->middleware('checkSuperAdmin');
Route::delete('/prospect/destroy/{id}',[ProspectController::class,'destroy'])->middleware('checkSuperAdmin');
Route::delete('/client/destroy/{id}',[ClientController::class,'destroy'])->middleware('checkSuperAdmin');
Route::delete('/fournisseurClient/destroy/{id}',[FournisseurClientController::class,'destroy'])->middleware('checkSuperAdmin');

Route::post('/prospect/{id}', [ProspectController::class, 'prospect'])->name('prospect.select');
Route::post('/supplier/{id}', [FournisseurController::class, 'fournisseur'])->name('supplier.select');
Route::post('/client/{id}', [ClientController::class, 'client'])->name('client.select');
Route::post('/fournisseurClient/{id}', [FournisseurClientController::class, 'fournisseurClient'])->name('fournisseurClient.select');

Route::post('/supplier/select/{id}', [FournisseurController::class, 'fournisseur']);
Route::post('/prospect/select/{id}', [ProspectController::class, 'prospect']);
Route::post('/client/select/{id}', [ClientController::class, 'client']);
Route::post('/fournisseurClient/select/{id}', [FournisseurClientController::class, 'fournisseurClient']);

Route::get('/updateAuth', [ProfileAuthController::class, 'showUpdateForm'])->name('update.user.auth.form')->middleware('auth');;
Route::post('/updateAuth', [ProfileAuthController::class, 'updateUser'])->name('update.user.auth')->middleware('auth');;

Route::post('/changePassword', [ProfileAuthController::class,'changePassword'])->name('change.password')->middleware('auth');

Route::get('/users/pagination',[UserController::class,'index'])->name('users.pagination');
Route::get('/categories/pagination',[CategorieController::class,'index'])->name('categories.pagination');
Route::get('/sousCategories/pagination',[SousCategorieController::class,'index'])->name('sousCategories.pagination');
Route::get('/prospects/pagination',[ProspectController::class,'index'])->name('prospects.pagination');
Route::get('/fournisseurs/pagination',[FournisseurController::class,'index'])->name('fournisseurs.pagination');
Route::get('/clients/pagination',[ClientController::class,'index'])->name('clients.pagination');
Route::get('/fournisseurClients/pagination',[FournisseurClientController::class,'index'])->name('fournisseurClients.pagination');


Route::get('/users/pdf', [UserController::class, 'usersPdf'])->name('users.pdf');
Route::get('/categories/pdf', [CategorieController::class, 'categoriesPdf'])->name('categories.pdf');
Route::get('/sousCategories/pdf', [SousCategorieController::class, 'sousCategoriesPdf'])->name('sousCategories.pdf');
Route::get('/prospects/pdf', [ProspectController::class, 'prospectsPdf'])->name('prospects.pdf');
Route::get('/fournisseurs/pdf', [FournisseurController::class, 'fournisseursPdf'])->name('fournisseurs.pdf');
Route::get('/clients/pdf', [ClientController::class, 'clientsPdf'])->name('clients.pdf');
Route::get('/fournisseurClients/pdf', [FournisseurClientController::class, 'fournisseurClientsPdf'])->name('fournisseurClients.pdf');

Route::post('/contactSupplier/user/{id}',[FournisseurController::class, 'updateUserFournisseur'])->name('user.select');
Route::post('/contactProspect/user/{id}',[ProspectController::class, 'updateUserProspect'])->name('user.select.prospect');
Route::post('/contactClient/user/{id}',[ClientController::class, 'updateUserClient'])->name('user.select.client');
Route::post('/contactFournisseurClient/user/{id}',[FournisseurClientController::class, 'updateUserFC'])->name('user.select.fc');
Route::post('/contactSupplier/remark/{id}',[FournisseurController::class, 'updateRemarkFournisseur'])->name('remark');
Route::post('/contactProspect/remark/{id}',[ProspectController::class, 'updateRemarkProspect'])->name('remark.prospect');
Route::post('/contactClient/remark/{id}',[ClientController::class, 'updateRemarkClient'])->name('remark.client');
Route::post('/contactFournisseurClient/remark/{id}',[FournisseurClientController::class, 'updateRemarkFC'])->name('remark.fc');

Route::get('/historique',[HistoriqueController::class,'showHistorique'])->name('historiqueSection');


























