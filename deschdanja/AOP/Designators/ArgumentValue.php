<?php
/*
 *  This File is part of the deschdanja-AOP project
 *  See File LICENSE distributed with this package for
 *  copyright information
 */

namespace deschdanja\AOP\Designators;
use \deschdanja\AOP\IJoinPoint;


/**
 * Designator to match an argument value
 *
 * @author Theodor Stoll <theodor@deschdanja.ch>
 */
class ArgumentValue extends ADesignatorRuntime{
    
    /**
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        foreach($joinpoint->getMethodArguments() as $name => $value){
            if($value === $this->expression){
                return true;
            }
        }
        return false;
    }
    
    
}
?>
