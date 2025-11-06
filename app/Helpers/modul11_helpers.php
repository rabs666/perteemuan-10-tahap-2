<?php

// File: app/Helpers/modul11_helpers.php
// Purpose: Helper functions for Tugas Modul 11 (5 helpers)

if (!function_exists('setActiveNav')) {
    /**
     * Return 'active' when current request URI matches the given URI.
     * @param string $uri
     * @return string
     */
    function setActiveNav(string $uri): string
    {
        $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
        $uri = trim($uri, '/');

        if ($uri === '' && ($currentPath === '/' || $currentPath === '')) {
            return 'active';
        }

        // check if current path starts with /{uri}
        if ($uri !== '' && strpos($currentPath, '/' . $uri) === 0) {
            return 'active';
        }

        return '';
    }
}

if (!function_exists('formatFileSize')) {
    /**
     * Convert bytes to human readable string (KB, MB, GB, etc).
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function formatFileSize(int $bytes, int $precision = 2): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $pow = (int) floor(log($bytes, 1024));
        $pow = min($pow, count($units) - 1);

        $value = $bytes / (1024 ** $pow);

        return round($value, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('dataGet')) {
    /**
     * Get value from nested array using dot notation. Returns default if key missing.
     * @param array $array
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function dataGet(array $array, string $key, $default = null)
    {
        if ($key === null || $key === '') {
            return $default;
        }

        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (strpos($key, '.') === false) {
            return $default;
        }

        $segments = explode('.', $key);
        foreach ($segments as $segment) {
            if (is_array($array) && array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        return $array;
    }
}

if (!function_exists('jsonResponse')) {
    /**
     * Standardize JSON responses for simple APIs. Returns JSON string.
     * Note: In Laravel controllers prefer returning response()->json(...)
     * but this helper demonstrates the requested behavior.
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return string
     */
    function jsonResponse(bool $success, string $message, $data = null, int $statusCode = 200): string
    {
        // We will not send headers here to avoid interfering with framework responses
        $response = ['success' => $success, 'message' => $message];
        if ($data !== null) {
            $response['data'] = $data;
        }

        $response['code'] = $statusCode;

        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('getGravatar')) {
    /**
     * Return Gravatar URL for an email address.
     * @param string $email
     * @param int $size
     * @param string $default
     * @return string
     */
    function getGravatar(string $email, int $size = 80, string $default = 'mp'): string
    {
        $hash = md5(strtolower(trim($email)));
        return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d={$default}";
    }
}
