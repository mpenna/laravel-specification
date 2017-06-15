<?php

namespace Chalcedonyt\Specification;

/**
 * A logical Not specification
 */
class NotSpec extends AbstractSpecification
{
    /**
     * @var SpecificationInterface $spec
     */
    protected $spec;

    /**
     * Creates a new specification wrapping another
     *
     * @param SpecificationInterface $spec
     */
    public function __construct(SpecificationInterface $spec)
    {
        $this->spec = $spec;
    }

    /**
     * Returns the negated result of the wrapped specification
     *
     * @param Item $candidate
     *
     * @return bool
     */
    public function isSatisfiedBy($candidate)
    {
        return !$this->spec->isSatisfiedBy($candidate);
    }

    /**
     * Returns the unfulfilled specification.
     *
     * @param Item $candidate
     *
     * @return mixed
     */
    public function remainderUnsatisfiedBy($candidate)
    {
        if ($this->spec->isSatisfiedBy($candidate)) {
            return $this->spec;
        }
        return null;
    }
}
