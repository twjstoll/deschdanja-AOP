<?php
namespace deschdanja\TS\AOP\Designators;
use \deschdanja\TS\AOP\IJoinPoint;

/**
 * Description of MethodName
 * designator to match method name
 *
 * although match joinpoint uses runtime information
 * the matchClassname method is implemented and returns true if one of the existing method matches
 *
 * @author Theodor
 */
class MethodName extends ADesignatorNonRuntime{
    /**
     * returns whether aop-object matches class
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

    /**
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        if(\preg_match($this->expression, $joinpoint->getMethodName())==1){
            return true;
        }
        return false;
    }
}
?>
