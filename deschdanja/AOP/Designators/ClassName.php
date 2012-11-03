<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP\Designators;
use \deschdanja\AOP\IJoinPoint;

/**
 * Designator to match a regex against a fully qualified classname.
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class ClassName extends ADesignatorNonRuntime{
    /**
     * returns whehter aop-object matches classname
     * 
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        if(\preg_match($this->expression, $classname) == 1){
            return true;
        }
        return false;
    }
    
    /**
     * Expression has to be regex to be matched
     * against the fully qualified classname
     * @param string $expression
     */
    public function setPointcutExpression($expression) {
        $expression = trim(strval($expression));
        parent::setPointcutExpression($expression);
    }
}
?>
