<?php 


namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts;

use Innoboxrr\Deals\Support\Helpers\ArrayHelper;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Callables\Calls\ParseObjectCallable;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\DeliveryResult;

abstract class AbstractFieldMapper
{
    protected array $field;
    protected array $lead;
    protected mixed $value;
    protected ?DeliveryResult $prevResult;

    public function __construct(array $field, array $lead, ?DeliveryResult $prevResult)
    {
        $this->field = $field;
        $this->lead = $lead;
        $this->prevResult = $prevResult;
    }

    protected function getCallableObject(): array
    {
        $keyValuePairs = [
            $this->field['target'] => $this->value,
        ];
        return ArrayHelper::dotNotationToNestedArray($keyValuePairs); 
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    public function getValue(): mixed
    {
        if($this->field['use_custom_code'] ?? false) {
            $this->value = ParseObjectCallable::execute(
                $this->field['code'] ?? null, 
                $this->getCallableObject(), $this->lead
            );
        }

        return $this->value;
    }

    abstract public function map(): mixed;
}
