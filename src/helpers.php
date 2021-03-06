<?php

if (! function_exists('toJson')) {
    /**
     * @param mixed $val
     */
    function toJson($val): string
    {
        return is_null($val) ? '{}' : \GuzzleHttp\json_encode($val);
    }
}

if (! function_exists('jsonToArray')) {
    function jsonToArray(string $val): array
    {
        return (array) \GuzzleHttp\json_decode($val, true);
    }
}

if (! function_exists('validateRequiredRequestParams')) {
    /**
     * @throws \CodeMash\Exceptions\RequestValidationException
     */
    function validateRequiredRequestParams(array $required, array $params): void
    {
        foreach ($required as $item) {
            if (empty($params[$item])) {
                throw new \CodeMash\Exceptions\RequestValidationException('"' . $item . '" is required!');
            }
        }
    }
}
