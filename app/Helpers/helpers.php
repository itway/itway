<?php

function remove_empty($array) {

    $trimmedArray = array_map('trim',$array);

    return array_filter($trimmedArray);

}

if ( ! function_exists('flash')) {
    /**
     * Arrange for a flash message.
     *
     * @param  string|null $message
     * @return \Itway\Components\Flash\FlashNotifier
     */
    function flash($message = null)
    {
        $notifier = app('flash');

        if ( ! is_null($message)) {
            return $notifier->info($message);
        }

        return $notifier;
    }

}

function determineActiveDBandResolveUp($migrationClass) {

    if (env('database.default') == 'mysql') {

        return $migrationClass::mySQLDB();

    }

    if (config('database.default') == 'pgsql') {

        return $migrationClass::postgreSQL();
    }
}


function determineActiveDBandResolveDown($migrationClass) {

    if (config('database.default') == 'mysql') {
        return $migrationClass::downmySQLDB();
    }

    if (config('database.default') == 'pgsql') {

        return $migrationClass::downpostgreSQL();
    }
}