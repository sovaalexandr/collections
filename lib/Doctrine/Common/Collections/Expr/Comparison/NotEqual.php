<?php
/**
 * This file is part of the collections project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Doctrine\Common\Collections\Expr\Comparison;

use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\Value;

final class NotEqual extends Comparison
{
    /**
     * @param string $field
     * @param mixed|Value $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, Comparison::NEQ, $value);
    }

    /**
     * @return callable
     */
    public function getFilterCallback()
    {
        $field = $this->getField();
        $value = $this->getValue()->getValue();

        return function ($object) use ($field, $value) {
            return ClosureExpressionVisitor::getObjectFieldValue($object, $field) !== $value;
        };
    }
}