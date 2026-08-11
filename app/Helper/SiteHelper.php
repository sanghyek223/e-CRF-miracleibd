<?php

// check Url
if (!function_exists('checkUrl')) {
    function checkUrl(): string
    {
        $uri = str_replace('://www.', '://', request()->getUri());

        if (str_contains($uri, config('site.app.api.url'))) {
            return 'api';
        }

        if (str_contains($uri, config('site.app.admin.url'))) {
            return 'admin';
        }

        return 'web';
    }
}

// global auth
if (!function_exists('thisAuth')) {
    function thisAuth()
    {
        if (checkUrl() === 'admin') {
            return auth('admin');
        }

        return auth('web');
    }
}

// get App Name
if (!function_exists('getAppName')) {
    function getAppName(): string
    {
        return config('site.app.' . checkUrl() . '.app_name');
    }
}

// get default url
if (!function_exists('getDefaultUrl')) {
    function getDefaultUrl($auth = false): string
    {
        if ($auth) {
            return thisAuth()->check()
                ? getDefaultUrl()
                : url('/');
        }

        return (checkUrl() === 'admin')
            ? url('/admin/log')
            : url('/register');
    }
}

// thisLevel
if (!function_exists('thisLevel')) {
    function thisLevel(): string
    {
        return thisUser()->level ?? '';
    }
}

// isAdmin
if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return (thisLevel() === 'M');
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $i = floor(log($bytes, 1024));

        return round($bytes / pow(1024, $i), $precision) . ' ' . $units[$i];
    }
}

