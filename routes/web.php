<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\DentistController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceptionistController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TreatmentController;
use App\Http\Controllers\Admin\VacationController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


Route::name('public.')->middleware(['throttle:60,1'])->group(function() {
    Route::get('/team', [\App\Http\Controllers\Guest\TeamController::class, 'index'])->name('team.index');
    Route::get('/team/{dentist}', [\App\Http\Controllers\Guest\TeamController::class, 'show'])->name('team.show');

    Route::get('/services', \App\Http\Controllers\Guest\ServiceController::class)->name('services');
    Route::get('/about', \App\Http\Controllers\Guest\AboutController::class)->name('about');
    Route::get('/contacts', \App\Http\Controllers\Guest\ContactController::class)->name('contacts');
});


Route::middleware(['auth', 'throttle:60,1'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::name('admin.')->prefix('admin')->middleware(['auth', 'role:admin', 'throttle:60,1'])->group( function() {
    Route::get('/generate-pdf-income-for-certain-year/{year}', [\App\Http\Controllers\Admin\PdfController::class,
        'generatePdfIncomeForCertainYear'])->name('generate_pdf_income_for_certain_year');

    Route::get('/generate-pdf-number-of-visitors-for-certain-year/{year}', [\App\Http\Controllers\Admin\PdfController::class,
        'generatePdfNumberOfVisitorsForCertainYear'])->name('generate_pdf_number_of_visitors_for_certain_year');

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/create-backup-database', [\App\Http\Controllers\Admin\SettingController::class, 'createBackupDatabase'])->name('settings.create_backup_database');
    Route::post('/settings/restore-database', [\App\Http\Controllers\Admin\SettingController::class, 'restoreDatabase'])->name('settings.restore_database');


    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::patch('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    Route::get('/receptionists', [ReceptionistController::class, 'index'])->name('receptionists.index');
    Route::get('/receptionists/create', [ReceptionistController::class, 'create'])->name('receptionists.create');
    Route::post('/receptionists', [ReceptionistController::class, 'store'])->name('receptionists.store');
    Route::get('/receptionists/{receptionist}/edit', [ReceptionistController::class, 'edit'])->name('receptionists.edit');
    Route::patch('/receptionists/{receptionist}', [ReceptionistController::class, 'update'])->name('receptionists.update');
    Route::delete('/receptionists/{receptionist}', [ReceptionistController::class, 'destroy'])->name('receptionists.destroy');

    Route::get('/dentists', [DentistController::class, 'index'])->name('dentists.index');
    Route::get('/dentists/create', [DentistController::class, 'create'])->name('dentists.create');
    Route::post('/dentists', [DentistController::class, 'store'])->name('dentists.store');
    Route::get('/dentists/{dentist}/edit', [DentistController::class, 'edit'])->name('dentists.edit');
    Route::patch('/dentists/{dentist}', [DentistController::class, 'update'])->name('dentists.update');
    Route::delete('/dentists/{dentist}', [DentistController::class, 'destroy'])->name('dentists.destroy');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index');
    Route::get('/treatments/create', [TreatmentController::class, 'create'])->name('treatments.create');
    Route::post('/treatments', [TreatmentController::class, 'store'])->name('treatments.store');
    Route::get('/treatments/{treatment}/edit', [TreatmentController::class, 'edit'])->name('treatments.edit');
    Route::patch('/treatments/{treatment}', [TreatmentController::class, 'update'])->name('treatments.update');
    Route::delete('/treatments/{treatment}', [TreatmentController::class, 'destroy'])->name('treatments.destroy');

    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
    Route::get('/bills/{bill}/edit', [BillController::class, 'edit'])->name('bills.edit');
    Route::patch('/bills/{bill}', [BillController::class, 'update'])->name('bills.update');
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::patch('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/vacations', [VacationController::class, 'index'])->name('vacations.index');
    Route::get('/vacations/create', [VacationController::class, 'create'])->name('vacations.create');
    Route::post('/vacations', [VacationController::class, 'store'])->name('vacations.store');
    Route::get('/vacations/{vacation}/edit', [VacationController::class, 'edit'])->name('vacations.edit');
    Route::patch('/vacations/{vacation}', [VacationController::class, 'update'])->name('vacations.update');
    Route::delete('/vacations/{vacation}', [VacationController::class, 'destroy'])->name('vacations.destroy');

    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::patch('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    Route::get('/services', [\App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [\App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [\App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [\App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('services.edit');
    Route::patch('/services/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [\App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/weekends', [\App\Http\Controllers\Admin\WeekendController::class, 'index'])->name('weekends.index');
    Route::get('/weekends/create', [\App\Http\Controllers\Admin\WeekendController::class, 'create'])->name('weekends.create');
    Route::post('/weekends', [\App\Http\Controllers\Admin\WeekendController::class, 'store'])->name('weekends.store');
    Route::get('/weekends/{weekend}/edit', [\App\Http\Controllers\Admin\WeekendController::class, 'edit'])->name('weekends.edit');
    Route::patch('/weekends/{weekend}', [\App\Http\Controllers\Admin\WeekendController::class, 'update'])->name('weekends.update');
    Route::delete('/weekends/{weekend}', [\App\Http\Controllers\Admin\WeekendController::class, 'destroy'])->name('weekends.destroy');

    Route::get('/educations', [\App\Http\Controllers\Admin\EducationController::class, 'index'])->name('educations.index');
    Route::get('/educations/create', [\App\Http\Controllers\Admin\EducationController::class, 'create'])->name('educations.create');
    Route::post('/educations', [\App\Http\Controllers\Admin\EducationController::class, 'store'])->name('educations.store');
    Route::get('/educations/{education}/edit', [\App\Http\Controllers\Admin\EducationController::class, 'edit'])->name('educations.edit');
    Route::patch('/educations/{education}', [\App\Http\Controllers\Admin\EducationController::class, 'update'])->name('educations.update');
    Route::delete('/educations/{education}', [\App\Http\Controllers\Admin\EducationController::class, 'destroy'])->name('educations.destroy');

    Route::get('/admins', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [\App\Http\Controllers\Admin\AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [\App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admins.store');
    Route::get('/admins/{admin}/edit', [\App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admins.edit');
    Route::patch('/admins/{admin}', [\App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admins.update');
    Route::delete('/admins/{admin}', [\App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admins.destroy');
});


Route::name('patient.')->prefix('patient')->middleware(['auth', 'role:patient', 'throttle:60,1'])->group(function() {
    Route::get('/generate-pdf-expenses-for-last-ten-years', [\App\Http\Controllers\Patient\PdfController::class,
        'generatePdfExpensesForLastTenYears'])->name('generate_pdf_expenses_for_last_ten_years');

    Route::get('/generate-pdf-number-of-visits-in-last-ten-years', [\App\Http\Controllers\Patient\PdfController::class,
        'generatePdfNumberOfVisitsInLastTenYears'])->name('generate_pdf_number_of_visits_in_last_ten_years');

    Route::get('/dashboard', [\App\Http\Controllers\Patient\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/appointments', [\App\Http\Controllers\Patient\AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [\App\Http\Controllers\Patient\AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [\App\Http\Controllers\Patient\AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/appointments/cancel/{appointment}', [\App\Http\Controllers\Patient\AppointmentController::class, 'cancel'])->name('appointments.cancel');
    Route::get('/appointments/{appointment}', [\App\Http\Controllers\Patient\AppointmentController::class, 'show'])->name('appointments.show');

    Route::get('/bills', [\App\Http\Controllers\Patient\BillController::class, 'index'])->name('bills.index');
    Route::get('/payments', [\App\Http\Controllers\Patient\PaymentController::class, 'index'])->name('payments.index');
});

Route::name('dentist.')->prefix('dentist')->middleware(['auth', 'role:dentist'])->group(function() {
    Route::get('/generate-pdf-number-of-visits-for-certain-year/{year}', [\App\Http\Controllers\Dentist\PdfController::class,
        'generatePdfNumberOfVisitsForCertainYear'])->name('generate_pdf_number_of_visits_for_certain_year');

    Route::get('/generate-pdf-income-for-certain-year/{year}', [\App\Http\Controllers\Dentist\PdfController::class,
        'generatePdfIncomeForCertainYear'])->name('generate_pdf_income_for_certain_year');

    Route::get('/generate-pdf-information-about-appointment/{id}', [\App\Http\Controllers\Dentist\PdfController::class,
        'generatePdfInformationAboutAppointment'])->name('generate_pdf_information_about_appointment');

    Route::get('/generate-pdf-information-about-treatment/{id}', [\App\Http\Controllers\Dentist\PdfController::class,
        'generatePdfInformationAboutTreatment'])->name('generate_pdf_information_about_treatment');

    Route::get('/generate-pdf-information-about-bills/{id}', [\App\Http\Controllers\Dentist\PdfController::class,
        'generatePdfInformationAboutBills'])->name('generate_pdf_information_about_bills');

    Route::get('/dashboard', [\App\Http\Controllers\Dentist\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/appointments', [\App\Http\Controllers\Dentist\AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}/edit', [\App\Http\Controllers\Dentist\AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::patch('/appointments/{appointment}', [\App\Http\Controllers\Dentist\AppointmentController::class, 'update'])->name('appointments.update');

    Route::get('/treatments/{appointment}/manage', [\App\Http\Controllers\Dentist\TreatmentController::class, 'manage'])->name('treatments.manage');
    Route::post('/treatments/manage', [\App\Http\Controllers\Dentist\TreatmentController::class, 'store'])->name('treatments.store');
    Route::get('/treatments/{treatment}/edit', [\App\Http\Controllers\Dentist\TreatmentController::class, 'edit'])->name('treatments.edit');
    Route::patch('/treatments/{treatment}', [\App\Http\Controllers\Dentist\TreatmentController::class, 'update'])->name('treatments.update');
    Route::delete('/treatments/{treatment}', [\App\Http\Controllers\Dentist\TreatmentController::class, 'destroy'])->name('treatments.destroy');

    Route::get('/bills/{appointment}/manage', [\App\Http\Controllers\Dentist\BillController::class, 'manage'])->name('bills.manage');
    Route::post('/bills/manage', [\App\Http\Controllers\Dentist\BillController::class, 'store'])->name('bills.store');
    Route::delete('/bills/{bill}', [\App\Http\Controllers\Dentist\BillController::class, 'destroy'])->name('bills.destroy');

    Route::get('/schedules', [\App\Http\Controllers\Dentist\ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [\App\Http\Controllers\Dentist\ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [\App\Http\Controllers\Dentist\ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [\App\Http\Controllers\Dentist\ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::patch('/schedules/{schedule}', [\App\Http\Controllers\Dentist\ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [\App\Http\Controllers\Dentist\ScheduleController::class, 'destroy'])->name('schedules.destroy');
});

Route::name('receptionist.')->prefix('receptionist')->middleware(['auth', 'role:receptionist', 'throttle:60,1'])->group(function() {
    Route::get('/generate-pdf-income-for-certain-year/{year}', [\App\Http\Controllers\Admin\PdfController::class,
        'generatePdfIncomeForCertainYear'])->name('generate_pdf_income_for_certain_year');

    Route::get('/generate-pdf-number-of-visitors-for-certain-year/{year}', [\App\Http\Controllers\Admin\PdfController::class,
        'generatePdfNumberOfVisitorsForCertainYear'])->name('generate_pdf_number_of_visitors_for_certain_year');

    Route::get('/dashboard', [\App\Http\Controllers\Receptionist\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
    Route::get('/bills/{bill}/edit', [BillController::class, 'edit'])->name('bills.edit');
    Route::patch('/bills/{bill}', [BillController::class, 'update'])->name('bills.update');
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::patch('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::patch('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
});

Route::get('/get-vacations', [VacationController::class, 'getVacations']);
Route::get('/get-schedules', [ScheduleController::class, 'getSchedules']);
Route::get('/get-appointments', [AppointmentController::class, 'getAppointments']);


Route::get('/get-income-for-certain-year', [\App\Http\Controllers\Admin\DashboardController::class, 'getIncomeForCertainYear']);
Route::get('/get-number-of-visitors-for-certain-year', [\App\Http\Controllers\Admin\DashboardController::class, 'getNumberOfVisitorsForCertainYear']);

Route::get('/get-income-dentist-for-certain-year', [\App\Http\Controllers\Dentist\DashboardController::class, 'getIncomeForCertainYear']);
Route::get('/get-number-of-visitors-to-dentist-for-certain-year', [\App\Http\Controllers\Dentist\DashboardController::class, 'getNumberOfVisitorsForCertainYear']);

Route::get('/get-expenses-for-last-ten-years-for-patient', [\App\Http\Controllers\Patient\DashboardController::class, 'getExpensesForLastTenYearsForPatient']);
Route::get('/get-number-of-visits-in-last-ten-years-for-patient', [\App\Http\Controllers\Patient\DashboardController::class, 'getNumberOfVisitsInLastTenYearsForPatient']);

require __DIR__.'/auth.php';
