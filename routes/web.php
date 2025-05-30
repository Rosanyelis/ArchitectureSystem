<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\DollarRateController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # Catalogo
    Route::get('/materiales', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/materiales/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/materiales', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/materiales/{id}/show', [MaterialController::class, 'show'])->name('material.show');
    Route::get('/materiales/{id}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/materiales/{id}/update', [MaterialController::class, 'update'])->name('material.update');
    Route::get('/materiales/{id}/destroy', [MaterialController::class, 'destroy'])->name('material.destroy');

    Route::get('/clientes', [CustomerController::class, 'index'])->name('client.index');
    Route::get('/clientes/create', [CustomerController::class, 'create'])->name('client.create');
    Route::post('/clientes', [CustomerController::class, 'store'])->name('client.store');
    Route::get('/clientes/{id}/show', [CustomerController::class, 'show'])->name('client.show');
    Route::get('/clientes/{id}/edit', [CustomerController::class, 'edit'])->name('client.edit');
    Route::put('/clientes/{id}/update', [CustomerController::class, 'update'])->name('client.update');
    Route::get('/clientes/{id}/destroy', [CustomerController::class, 'destroy'])->name('client.destroy');

    Route::get('/contratistas', [ContractorController::class, 'index'])->name('contractor.index');
    Route::get('/contratistas/create', [ContractorController::class, 'create'])->name('contractor.create');
    Route::post('/contratistas', [ContractorController::class, 'store'])->name('contractor.store');
    Route::get('/contratistas/{id}/show', [ContractorController::class, 'show'])->name('contractor.show');
    Route::get('/contratistas/{id}/edit', [ContractorController::class, 'edit'])->name('contractor.edit');
    Route::put('/contratistas/{id}/update', [ContractorController::class, 'update'])->name('contractor.update');
    Route::get('/contratistas/{id}/destroy', [ContractorController::class, 'destroy'])->name('contractor.destroy');

    Route::get('/proveedores', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/proveedores/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/proveedores', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/proveedores/{id}/show', [SupplierController::class, 'show'])->name('supplier.show');
    Route::get('/proveedores/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/proveedores/{id}/update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/proveedores/{id}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('/materiales', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/materiales/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/materiales', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/materiales/{id}/show', [MaterialController::class, 'show'])->name('material.show');
    Route::get('/materiales/{id}/edit', [MaterialController::class, 'edit'])->name('material.edit');
    Route::put('/materiales/{id}/update', [MaterialController::class, 'update'])->name('material.update');
    Route::get('/materiales/{id}/destroy', [MaterialController::class, 'destroy'])->name('material.destroy');

    Route::get('/tasa-dolar', [DollarRateController::class, 'index'])->name('dollar-rate.index');
    Route::get('/tasa-dolar/create', [DollarRateController::class, 'create'])->name('dollar-rate.create');
    Route::post('/tasa-dolar', [DollarRateController::class, 'store'])->name('dollar-rate.store');
    Route::get('/tasa-dolar/{id}/show', [DollarRateController::class, 'show'])->name('dollar-rate.show');
    Route::get('/tasa-dolar/{id}/edit', [DollarRateController::class, 'edit'])->name('dollar-rate.edit');
    Route::put('/tasa-dolar/{id}/update', [DollarRateController::class, 'update'])->name('dollar-rate.update');
    Route::get('/tasa-dolar/{id}/destroy', [DollarRateController::class, 'destroy'])->name('dollar-rate.destroy');
    
    # Presupuestos  
    Route::get('/presupuestos', [BudgetController::class, 'index'])->name('budget.index');
    Route::get('/presupuestos/create', [BudgetController::class, 'create'])->name('budget.create');
    Route::post('/presupuestos', [BudgetController::class, 'store'])->name('budget.store');
    Route::get('/presupuestos/{id}/show', [BudgetController::class, 'show'])->name('budget.show');
    Route::get('/presupuestos/{id}/getBudget', [BudgetController::class, 'getBudget'])->name('budget.getBudget');
    Route::get('/presupuestos/{id}/edit', [BudgetController::class, 'edit'])->name('budget.edit');
    Route::put('/presupuestos/{id}/update', [BudgetController::class, 'update'])->name('budget.update');
    Route::post('/presupuestos/{id}/destroy', [BudgetController::class, 'destroy'])->name('budget.destroy');
    Route::get('/presupuestos/getClients', [BudgetController::class, 'getClients'])->name('budget.getClients');
    Route::post('/presupuestos/storeClient', [BudgetController::class, 'storeClient'])->name('budget.storeClient');
    Route::get('/presupuestos/getCurrencies', [BudgetController::class, 'getCurrencies'])->name('budget.getCurrencies');
    Route::get('/presupuestos/{id}/updateStatus', [BudgetController::class, 'updateStatus'])->name('budget.updateStatus');
    Route::post('/presupuestos/{id}/processPayment', [BudgetController::class, 'processPayment'])->name('budget.processPayment');
    Route::get('/presupuestos/{id}/payments/{payment}/show', [BudgetController::class, 'showPayment'])->name('budget.showPayment');

    # proyectos
    Route::get('/proyectos', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/proyectos/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/proyectos', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/proyectos/{id}/show', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/proyectos/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/proyectos/{id}/update', [ProjectController::class, 'update'])->name('project.update');
    Route::get('/proyectos/{id}/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/proyectos/getClients', [ProjectController::class, 'getClients'])->name('project.getClients');
    Route::get('/proyectos/{client_id}/getBudgets', [ProjectController::class, 'getBudgets'])->name('project.getBudgets');
    # Usuarios
    Route::get('/usuarios', [UsersController::class, 'index'])->name('user.index');
    Route::get('/usuarios/create', [UsersController::class, 'create'])->name('user.create');
    Route::post('/usuarios', [UsersController::class, 'store'])->name('user.store');
    Route::get('/usuarios/{id}/show', [UsersController::class, 'show'])->name('user.show');
    Route::get('/usuarios/{id}/edit', [UsersController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/{id}/update', [UsersController::class, 'update'])->name('user.update');
    Route::get('/usuarios/{id}/destroy', [UsersController::class, 'destroy'])->name('user.destroy');

    # Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/create', [RoleController::class, 'index'])->name('role.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{id}/show', [RoleController::class, 'show'])->name('role.show');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/roles/{id}/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('/roles/{id}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');

});

require __DIR__.'/auth.php';
