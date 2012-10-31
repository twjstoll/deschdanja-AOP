<?php
namespace deschdanja\TS\AOP\Designators;
use \deschdanja\TS\AOP\IJoinPoint;


/**
 * Description of ArgumentValue
 *
 * @author Theodor
 */
class ArgumentValue extends ADesignatorRuntime{

    protected $expression;
    
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

    /**
     * expression is not forced to string, since value will be compared
     * @param mixed $expression
     */
    public function setPointcutExpression($expression){
        $this->expression = $expression;
    }
}
?>
