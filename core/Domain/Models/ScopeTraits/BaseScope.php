<?php

namespace Core\Domain\Models\ScopeTraits;


trait BaseScope
{
    // Filtrar ppor nombre
    public function scopeOfTitle($query, $value) {
        if ($value != "") {
            return $query->where('title', 'like', "{$value}%");
        }
    }
}