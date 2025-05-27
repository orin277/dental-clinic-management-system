<?php

use function Pest\Stressless\stress;


it("checks the response speed of a request to the home page", function () {
    $result = stress(env('APP_URL') . 'home')
        ->concurrently(requests: 10)->for(5)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(1200);
});

it("checks the response speed of a request to get a page of appointments", function () {
    $result = stress(env('APP_URL') . 'admin/appointments')
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed of a request to get a page of patients", function () {
    $result = stress(env('APP_URL') . 'admin/patients')
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed of a request to get a page of bills", function () {
    $result = stress(env('APP_URL') . 'admin/bills')
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed of a request to get the add patient page", function () {
    $result = stress(env('APP_URL') . 'admin/patients/create')
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed of a request to get the edit patient page", function () {
    $result = stress(env('APP_URL') . 'admin/patients/1/edit')
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed to patient update request", function () {
    $result = stress(env('APP_URL') . 'admin/patients/300')->patch(["name" => "Дмитро"])
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed to patient store request", function () {
    $result = stress(env('APP_URL') . 'admin/patients/300')->patch(["name" => "Дмитро"])
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed to appointment update request", function () {
    $result = stress(env('APP_URL') . 'admin/appointments/300')->patch(["reason" => ""])
        ->concurrently(requests: 100)->for(5)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(12000);
});

it("checks the response speed of a request to get the dashboard page", function () {
    $result = stress(env('APP_URL') . 'admin/dashboard')
        ->concurrently(requests: 10)->for(10)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

it("checks the response speed of a request to get the profile page", function () {
    $result = stress(env('APP_URL') . 'profile')
        ->concurrently(requests: 10)->for(5)->seconds();

    expect($result->requests()->duration()->med())->toBeLessThan(3000);
});

