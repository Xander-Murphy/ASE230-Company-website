<?php
// products/JsonHelper.php
// Simple JSON helper (no namespace). Option A style: does not add 'id' fields automatically.

class JsonHelper
{
    public static function readAll(string $filePath): array
    {
        if (!file_exists($filePath)) {
            return [];
        }

        $content = @file_get_contents($filePath);
        if ($content === false) {
            throw new \RuntimeException("Unable to read file: $filePath");
        }

        $data = json_decode($content, true);
        if (!is_array($data)) {
            return [];
        }
        return $data;
    }

    public static function writeAll(string $filePath, array $data): void
    {
        $dir = dirname($filePath);
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        $tmp = tempnam($dir, 'tmpjson_');
        if ($tmp === false) {
            throw new \RuntimeException("Unable to create temp file in: $dir");
        }

        $written = file_put_contents($tmp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        if ($written === false) {
            @unlink($tmp);
            throw new \RuntimeException("Unable to write temp file: $tmp");
        }

        if (!rename($tmp, $filePath)) {
            @unlink($tmp);
            throw new \RuntimeException("Unable to move temp file to destination: $filePath");
        }
    }

    // Append item (no id added)
    public static function create(string $filePath, array $item): array
    {
        $all = self::readAll($filePath);
        $all[] = $item;
        self::writeAll($filePath, $all);
        return $item;
    }

    // Return item at first matching field===value or null
    public static function findByField(string $filePath, string $field, $value): ?array
    {
        $all = self::readAll($filePath);
        foreach ($all as $item) {
            if (array_key_exists($field, $item) && $item[$field] === $value) {
                return $item;
            }
        }
        return null;
    }

    // Update first matching item by field=value. Merge newData into item. Return updated item or null.
    public static function updateByField(string $filePath, string $field, $value, array $newData): ?array
    {
        $all = self::readAll($filePath);
        $found = false;
        foreach ($all as $k => $item) {
            if (array_key_exists($field, $item) && $item[$field] === $value) {
                $all[$k] = array_merge($item, $newData);
                $found = true;
                break;
            }
        }
        if (!$found) return null;
        // reindex to ensure numeric indexes (not strictly required)
        $all = array_values($all);
        self::writeAll($filePath, $all);
        // return the updated item (find the first match for the new field value)
        foreach ($all as $item) {
            if (array_key_exists($field, $item) && $item[$field] === ($newData[$field] ?? $value)) {
                return $item;
            }
        }
        // fallback
        return $all[$k] ?? null;
    }

    // Delete first matching item by field=value. Return true if deleted, false otherwise.
    public static function deleteByField(string $filePath, string $field, $value): bool
    {
        $all = self::readAll($filePath);
        $deleted = false;
        foreach ($all as $k => $item) {
            if (array_key_exists($field, $item) && $item[$field] === $value) {
                unset($all[$k]);
                $deleted = true;
                break;
            }
        }
        if (!$deleted) return false;
        $all = array_values($all);
        self::writeAll($filePath, $all);
        return true;
    }
}
