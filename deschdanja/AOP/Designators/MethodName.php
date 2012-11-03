<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP\Designators;
use deschdanja\AOP\IJoinPoint;

/**
 * designator to match a regex against method name
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class MethodName extends ADesignatorNonRuntime{
    
    /**
     * returns whether aop-object matches class
     * in non-runtime, this method checks whether any of the available methods
     * matches 
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        $reflectionClass = new \ReflectionClass($classname);
        $methods = $reflectionClass->getMethods();
        foreach($methods as $method){
            if(\preg_match($this->expression, $method->getName()) == 1){
                return true;
            }
        }
        return false;
    }
    
    public function matchJoinPoint(IJoinPoint $joinpoint) {
        if(preg_match($this->expression, $joinpoint->getMethodName()) == 1){
            return true;
        }
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
