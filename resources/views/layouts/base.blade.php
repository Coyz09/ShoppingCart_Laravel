<!-- resources/views/layouts/base.blade.php -->
 <!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <title></title>
 @include('layouts.header')
 </head>
 <body>
 @include('navigation.navbar')
 @yield('body')
 </body>
 </html>