<?php

namespace Ibrows\ImportBundle\Annotation\Mapping;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Field extends AbstractMapping
{
    /**
     * @Required
     * @var string
     */
    public $type;

    /**
     * @param array $data An array of key/value parameters
     *
     * @throws \BadMethodCallException
     */
    public function __construct(array $data)
    {
        if (isset($data['value'])) {
            $data['type'] = $data['value'];
            unset($data['value']);
        }

        foreach ($data as $key => $value) {
            $method = 'set'.str_replace('_', '', ucfirst($key));
            if (method_exists($this, $method)) {
                $this->$method($value);
            } elseif(property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \BadMethodCallException(sprintf('Unknown property "%s" on annotation "%s".', $key, get_class($this)));
            }
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function transformToPHP($value)
    {
        $class = '\Ibrows\ImportBundle\Converter\\' . ucfirst($this->type) . 'Converter';
        $obj = new $class();
        return $obj->transformToPHP($value, $this);
    }

    public function transformToCompare($value)
    {
        $class = '\Ibrows\ImportBundle\Converter\\' . ucfirst($this->type) . 'Converter';
        $obj = new $class();
        return $obj->transformToCompare($value, $this);
    }
}
