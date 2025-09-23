<!doctype html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <meta name="description" content="Welcome to the Learning Management System Portal. Access interactive courses, manage your progress, and connect with instructors and peers seamlessly.">
        <meta name="keywords" content="LMS, Learning Management System, Online Courses, E-learning, Virtual Classroom, Education Platform, Student Portal, Instructor Tools, Learning Portal">
        <meta name="author" content="Learning Management System Team">
        <meta name="robots" content="index, follow">
        <meta name="revisit-after" content="7 days">

        <meta property="og:title" content="Welcome Portal | Learning Management System">
        <meta property="og:description" content="Join our LMS to access online courses, track learning progress, and enhance your skills with expert guidance.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('/collection/logo.svg') }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Welcome Portal | Learning Management System">
        <meta name="twitter:description" content="A complete Learning Management System for students, teachers, and professionals. Learn, grow, and achieve with us.">
        <meta name="twitter:image" content="{{ asset('/collection/logo.svg') }}">

        <link rel="shortcut icon" href="{{asset('/collection/logo.svg')}}" type="image/x-icon">

        <title> Admin Portal | Learning Management System </title>

        @vite(['resources/js/admin/app.js','resources/css/app.css'])

    </head>

    <body class="bg-gray-100" id="app"></body>

</html>
