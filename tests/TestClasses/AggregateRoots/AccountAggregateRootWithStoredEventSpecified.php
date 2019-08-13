<?php

namespace Spatie\EventProjector\Tests\TestClasses\AggregateRoots;

use Spatie\EventProjector\AggregateRoot;
use Spatie\EventProjector\Tests\TestClasses\Models\OtherEloquentStoredEvent;
use Spatie\EventProjector\Tests\TestClasses\AggregateRoots\StorableEvents\MoneyAdded;

final class AccountAggregateRootWithStoredEventSpecified extends AggregateRoot
{
    public $balance = 0;
    public $storedEventModel = OtherEloquentStoredEvent::class;

    public function addMoney(int $amount): self
    {
        $this->recordThat(new MoneyAdded($amount));

        return $this;
    }

    public function applyMoneyAdded(MoneyAdded $event)
    {
        $this->balance += $event->amount;
    }
}
