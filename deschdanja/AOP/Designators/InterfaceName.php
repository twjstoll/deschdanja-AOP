<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP\Designators;
use deschdanja\AOP\IJoinPoint;

/**
 * Designator to match against a fully qualified interface name.
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class InterfaceName extends ADesignatorNonRuntime{
    /**
     * returns whether aop-object matches interface
     *
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        $reflectionClass = new \ReflectionClass($classname);
        $interfaces = $reflectionClass->getInterfaceNames();
        foreach($interfaces as $interface){
            if(\preg_match($this->expression, $interface) == 1){
                return true;
            }
        }

        return false;
    }

    /**
     * Expression has to be regex to be matched
     * against the fully qualified interface name
     * @param string $expression
     */
    public function setPointcutExpression($expression) {
        $expression = trim(strval($expression));
        parent::setPointcutExpression($expression);
    }
}
?>
