<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BelongsToThrough
{
    public function belongsToThrough($related, $through, $firstKey = null, $secondKey = null, $localKey = null)
    {
        $through = new $through;
        $related = new $related;

        $firstKey  = $firstKey ?: $through->getForeignKey();
        $secondKey = $secondKey ?: $related->getForeignKey();
        $localKey  = $localKey ?: $this->getKeyName();

        return $this->BelongsTo(
            $related->newQuery(), $this,
            $through->getTable() . '.' . $secondKey,
            $localKey
        )->join(
            $through->getTable(),
            $through->getTable() . '.' . $through->getKeyName(),
            '=',
            $this->getTable() . '.' . $firstKey
        );
    }
}
