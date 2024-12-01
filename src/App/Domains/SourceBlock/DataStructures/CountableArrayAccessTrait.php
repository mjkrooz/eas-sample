<?php namespace App\Domains\SourceBlock\DataStructures;

use OutOfBoundsException;

trait CountableArrayAccessTrait
{
    protected array $inputs;

    public function __construct(array $inputs = [])
    {
        foreach ($inputs as $key => $input) {

            $this->inputs[$key] = $input;
        }
    }

    /**
     * Returns whether the input is valid for the array.
     *
     * @param mixed $value The value to check.
     * @return bool
     */
    public function validInput(mixed $value): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset)
    {
        if (!array_key_exists($offset, $this->inputs)) {

            throw new OutOfBoundsException('Invalid offset: "' . $offset . '"');
        }

        return $this->inputs[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value)
    {
        if (!$this->validInput($value)) {

            throw new \InvalidArgumentException('Input was not valid for this array');
        }

        if ($offset === NULL) {

            $this->inputs[] = $value;
        } else {

            $this->inputs[$offset] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset)
    {
        unset($this->inputs[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->inputs);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->inputs);
    }
}
