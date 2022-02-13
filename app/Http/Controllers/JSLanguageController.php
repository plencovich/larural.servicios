<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JSLanguageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $strings = cache()->tags(['language'])->rememberForever('lang.js', function () {
        // Get language
        $lang = config('app.locale');

        // Get language file path
        $files = glob(resource_path('lang/' . $lang . '/*.php'));

        // Initialize variables
        $strings = [];
        $name = '';

        // Read files contents
        foreach ($files as $file) {
            $name = basename($file, '.php');
            $content = require $file;
            $strings[$name] = $content;
        }
        //     return $strings;
        // });

        // Set JavaScript header
        header('Content-Type: text/javascript');
        // Display language
        echo ('window.language = ' . json_encode($strings) . ';');
        exit();
    }
}
