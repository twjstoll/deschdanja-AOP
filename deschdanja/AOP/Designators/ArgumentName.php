<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP\Designators;
use \deschdanja\AOP\IJoinPoint;

/**
 * Designator to match an argument name
 * by a regex expression
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class ArgumentName extends ADesignatorRuntime{
    /**
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        foreach($joinpoint->getMethodArguments() as $name => $argument){
            if(\preg_match($this->expression, $name)==1){
                return true;
            }
        }
        return false;
    }
    
    /**
     * Expression has to be a regex to match against an argument name
     * @param string $expression
     */
    public function setPointcutExpression($expression) {
        $expression = trim(strval($expression));
        parent::setPointcutExpression($expression);
    }
}
?>
