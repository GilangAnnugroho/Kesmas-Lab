<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicKesmasController;
use App\Http\Controllers\Admin\KesmasDashboardController;
use App\Http\Controllers\Admin\KesmasRegistrationController;
use App\Http\Controllers\Admin\KesmasResultController;
use App\Http\Controllers\Admin\KesmasRekamMedisController;
use App\Http\Controllers\Admin\KesmasParameterController;
use App\Http\Controllers\Admin\KesmasVerificationController;

Route::redirect('/', '/login');
Route::redirect('/home', '/admin/kesmas');

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/kesmas/pendaftaran', [PublicKesmasController::class, 'create'])
    ->name('kesmas.public.create');
Route::post('/kesmas/pendaftaran', [PublicKesmasController::class, 'store'])

    ->name('kesmas.public.store');
Route::get('/kesmas/pendaftaran/sukses/{no_registrasi}', [PublicKesmasController::class, 'success'])
    ->name('kesmas.public.success');

Route::middleware(['auth'])
    ->prefix('admin/kesmas')
    ->name('admin.kesmas.')
    ->group(function () {

        Route::get('/', [KesmasDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/registrations', [KesmasRegistrationController::class, 'index'])
            ->name('registrations.index');

        Route::get('/registrations/{registration}', [KesmasRegistrationController::class, 'show'])
            ->name('registrations.show');

        Route::delete('/registrations/{registration}', [KesmasRegistrationController::class, 'destroy'])
            ->name('registrations.destroy');

        Route::post('/registrations/{registration}/status',
            [KesmasRegistrationController::class, 'updateStatus'])
            ->name('registrations.update_status');

        Route::get('/registrations/{registration}/print',
            [KesmasRegistrationController::class, 'print'])
            ->name('registrations.print');

        Route::get('/registrations/{registration}/results/edit',
            [KesmasResultController::class, 'edit'])
            ->name('results.edit');

        Route::post('/registrations/{registration}/results',
            [KesmasResultController::class, 'update'])
            ->name('results.update');

        Route::get('/registrations/{registration}/verify',
            [KesmasVerificationController::class, 'verifyForm'])
            ->name('registrations.verify_form');

        Route::post('/registrations/{registration}/verify',
            [KesmasVerificationController::class, 'verify'])
            ->name('registrations.verify');

        Route::get('/rekam-medis', [KesmasRekamMedisController::class, 'index'])
            ->name('rekam_medis.index');

        Route::get('/rekam-medis/{client}', [KesmasRekamMedisController::class, 'show'])
            ->name('rekam_medis.show');

        Route::resource('parameters', KesmasParameterController::class);
    });
