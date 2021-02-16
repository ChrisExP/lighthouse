<?php

namespace Nuwave\Lighthouse\Execution\Utils;

class FieldPath
{
    /**
     * Return the dot separated field path without lists.
     *
     * @param  array<int|string>  $path
     */
    public static function withoutLists(array $path): string
    {
        $significantPathSegments = array_filter(
            $path,
            static function ($segment): bool {
                // Ignore numeric path entries, as those signify a list of fields.
                // Combining the queries for those is the very purpose of the
                // batch loader, so they must not be included.
                return ! is_numeric($segment);
            }
        );

        return implode('.', $significantPathSegments);
    }
}