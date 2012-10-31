<?php
namespace deschdanja\TS\AOP\Designators;
use \deschdanja\TS\AOP\IJoinPoint;

/**
 * Designator to match an argument name!
 *
 * @author Theodor
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
}
?>
