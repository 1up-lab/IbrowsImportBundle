<?php

namespace Ibrows\ImportBundle\Annotation\Mapping;

@trigger_error('The '.__NAMESPACE__.'\DateTime annotation is deprecated since version 1.3 and will be removed in 2.0. Use the Field annotation instead.', E_USER_DEPRECATED);

/**
 * @Annotation
 * @deprecated since version 1.3, to be removed in 2.0. Use the Field annotation instead
 */
class DateTime extends AbstractMapping
{
    /**
     * @param mixed $value
     * @return string
     */
    public function transformToPHP($value)
    {
        return new \DateTime($value);
    }
}
