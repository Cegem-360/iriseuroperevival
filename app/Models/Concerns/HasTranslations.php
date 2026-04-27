<?php

declare(strict_types=1);

namespace App\Models\Concerns;

trait HasTranslations
{
    /**
     * Return a translated attribute for the current (or given) locale,
     * falling back to the base attribute when no translation exists.
     */
    public function t(string $attribute, ?string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();
        $translations = $this->translations ?? [];
        $value = $translations[$locale][$attribute] ?? null;

        if ($value === null || $value === '') {
            return $this->getAttribute($attribute);
        }

        return $value;
    }
}
