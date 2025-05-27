<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'admin.list', 'admin.create', 'admin.edit', 'admin.delete',
            'appointment.list', 'appointment.create', 'appointment.edit', 'appointment.delete',
            'bill.list', 'bill.create', 'bill.edit', 'bill.delete',
            'dentist.list', 'dentist.create', 'dentist.edit', 'dentist.delete',
            'education.list', 'education.create', 'education.edit', 'education.delete',
            'patient.list', 'patient.create', 'patient.edit', 'patient.delete',
            'payment.list', 'payment.create', 'payment.edit', 'payment.delete',
            'receptionist.list', 'receptionist.create', 'receptionist.edit', 'receptionist.delete',
            'schedule.list', 'schedule.create', 'schedule.edit', 'schedule.delete',
            'service.list', 'service.create', 'service.edit', 'service.delete',
            'treatment.list', 'treatment.create', 'treatment.edit', 'treatment.delete',
            'vacation.list', 'vacation.create', 'vacation.edit', 'vacation.delete',
            'weekend.list', 'weekend.create', 'weekend.edit', 'weekend.delete',
            'dashboard.view',

            'dentist.appointment.list', 'dentist.appointment.edit',
            'dentist.bill.manage',
            'dentist.schedule.list', 'dentist.schedule.create', 'dentist.schedule.edit', 'dentist.schedule.delete',
            'dentist.dashboard.view',

            'patient.appointment.list', 'patient.appointment.create', 'patient.appointment.edit', 'patient.appointment.delete',
            'patient.bill.list',
            'patient.payment.list',
            'patient.dashboard.view',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roleAdmin = Role::create(['name' => 'admin']);
        $rolePatient = Role::create(['name' => 'patient']);
        $roleDentist = Role::create(['name' => 'dentist']);
        $roleReceptionist = Role::create(['name' => 'receptionist']);

        $roleAdmin->givePermissionTo([
            'admin.list', 'admin.create', 'admin.edit', 'admin.delete',
            'appointment.list', 'appointment.create', 'appointment.edit', 'appointment.delete',
            'bill.list', 'bill.create', 'bill.edit', 'bill.delete',
            'dentist.list', 'dentist.create', 'dentist.edit', 'dentist.delete',
            'education.list', 'education.create', 'education.edit', 'education.delete',
            'patient.list', 'patient.create', 'patient.edit', 'patient.delete',
            'payment.list', 'payment.create', 'payment.edit', 'payment.delete',
            'receptionist.list', 'receptionist.create', 'receptionist.edit', 'receptionist.delete',
            'schedule.list', 'schedule.create', 'schedule.edit', 'schedule.delete',
            'service.list', 'service.create', 'service.edit', 'service.delete',
            'treatment.list', 'treatment.create', 'treatment.edit', 'treatment.delete',
            'vacation.list', 'vacation.create', 'vacation.edit', 'vacation.delete',
            'weekend.list', 'weekend.create', 'weekend.edit', 'weekend.delete',
            'dashboard.view',
        ]);

        $roleDentist->givePermissionTo([
            'dentist.appointment.list', 'dentist.appointment.edit',
            'dentist.bill.manage',
            'dentist.schedule.list', 'dentist.schedule.create', 'dentist.schedule.edit', 'dentist.schedule.delete',
            'dentist.dashboard.view',
        ]);

        $rolePatient->givePermissionTo([
            'patient.appointment.list', 'patient.appointment.create', 'patient.appointment.edit', 'patient.appointment.delete',
            'patient.bill.list',
            'patient.payment.list',
            'patient.dashboard.view',
        ]);
    }
}
