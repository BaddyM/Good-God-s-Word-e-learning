<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminStudent;
use App\Http\Middleware\AdminTutor;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'admin-student' => AdminStudent::class,
            'admin-tutor' => AdminTutor::class,
            'admin' => Admin::class
        ]);

        $middleware->validateCsrfTokens(except: [
            'Student/CompleteCourse',
            'Tutor/CourseData',
            'Tutor/DeleteCourse',
            'Admin/AccountsList',
            'Admin/ActivateUser',
            'Admin/DeactivateUser',
            'Admin/DeleteUser',
            'Admin/EnrollmentData',
            'Admin/AcceptEnrollment',
            'Admin/CancelEnrollment'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
