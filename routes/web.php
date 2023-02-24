<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MailSettingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Employee\HomeController as EmployeeHomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
// sudo chmod o+w ./storage/ -R = Storage Permission command in ububtu.

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/forgot-password', [AuthController::class, 'forgot_password_view'])->name('forgot_password');
Route::post('/forgot-password', [AuthController::class, 'forgot_password_post'])->name('forgot_password_post');
Route::get('/reset-password/{token}', [AuthController::class, 'reset_password_view'])->name('reset_password');
Route::post('/reset-password', [AuthController::class, 'reset_password_post'])->name('reset_password_post');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'home'])->name('home');


    // Valuation Routes
    Route::get('/valuation/all-leads', function () {
        $data['employees'] = User::where(['is_admin' => 0, 'status' => 1])->get();
        return view('admin.leads.leads', $data);
    })->name('leads');
    Route::post('/get-valuation-data', [HomeController::class, 'loadData'])->name('loadData');
    Route::post('/change-valuation-status', [HomeController::class, 'changeValStatus']);
    Route::post('/employee-assign-lead', [HomeController::class, 'assignLead']);
    // Delete Lead(Archive)
    Route::post('/archive-lead', [HomeController::class, 'archiveLead']);
    // Valuation Routes

    // Archive Lead section Route
    Route::get('/valuation/show-archive-leads', [HomeController::class, 'getArchiveLeads'])->name('getArchiveLeads');
    Route::post('/valuation/restore-lead', [HomeController::class, 'restoreArchiveLeads'])->name('restoreArchiveLeads');
    Route::post('/valuation/delete-lead', [HomeController::class, 'deleteArchiveLeads'])->name('deleteArchiveLeads');
    // Archive Lead section Route End


    // Employees Route
    Route::get('/employee/add-new-employee', function () {
        return view('admin.employee.addEmp');
    })->name('addEmployee');
    Route::get('/employee/employee-list', [EmployeeController::class, 'listAllEmployee'])->name('listAllEmployee');
    Route::post('/employee/add-employee', [EmployeeController::class, 'addEditEmployee'])->name('addEditEmployee');
    Route::post('/employee/employee-status', [EmployeeController::class, 'employeeStatus'])->name('employeeStatus');
    Route::get('/employee/employee-edit/{id}', [EmployeeController::class, 'empEdit'])->name('empEdit');
    Route::get('/employee/employee-delete/{id}', [EmployeeController::class, 'empDelete'])->name('empDelete');
    Route::post('/employee/password-change', [EmployeeController::class, 'empPasswordChange'])->name('empPasswordChange');
    // Employees Route end

    // Mail Setting Routes
    Route::get('settings/mail-setting', [MailSettingController::class, 'index'])->name('mailSetting');
    Route::get('settings/mail-setting/create', function () {
        return view('admin.mailSetting.addMailSetting');
    })->name('mailSettingCreate');
    Route::post('settings/mail-setting/add', [MailSettingController::class, 'addEditMailSetting'])->name('addEditMailSetting');
    Route::get('settings/mail-setting/edit/{id}', [MailSettingController::class, 'editMailSettingForm'])->name('editMailSettingForm');
    Route::get('settings/mail-setting/delete/{id}', [MailSettingController::class, 'deleteMailSetting'])->name('deleteMailSetting');
    Route::get('settings/mail-setting/use-mail/{id}', [MailSettingController::class, 'useMailSetting'])->name('useMailSetting');
    Route::post('settings/mail-setting/test-mail', [MailSettingController::class, 'sendTestMail'])->name('sendTestMail');
    // Mail Setting Routes End


    // Notification Routes
    Route::get('settings/notificatins', [NotificationController::class, 'index'])->name('notifications');
    Route::get('settings/notificatins/delete/{id}', [NotificationController::class, 'deleteNotification'])->name('deleteNotification');
    Route::post('settings/notificatins/send-notification', [NotificationController::class, 'sendNotification'])->name('sendNotification');

    // Notification Routes End


    Route::get('/profile', function () {
        return view('admin.profile.profile');
    })->name('profile');
});

// Employee Dashboard Routes
Route::name('employee.')->prefix('employee')->middleware(['auth', 'employee'])->group(function () {
    Route::get('/dashboard', [EmployeeHomeController::class, 'home'])->name('home');

    // Get Valuation Data
    Route::post('get-valuation-data', [HomeController::class, 'loadData'])->name('loadData');
    // Get Valuation Data End

    Route::get('/profile', function () {
        return view('admin.profile.profile');
    })->name('profile');
});
// Employee Dashboard Routes End

// Profile Section Routes
Route::name('profile.')->prefix('profile')->middleware('auth')->group(function () {
    Route::post('/change-profile-image', [ProfileController::class, 'changeProfileImage'])->name('changeProfileImage');
    Route::post('/change-profile-info', [ProfileController::class, 'changeProfileInfo'])->name('changeProfileInfo');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
});
// Profile Section Routes End


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
