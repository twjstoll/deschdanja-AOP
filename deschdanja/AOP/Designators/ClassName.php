<?php
namespace deschdanja\AOP\Designators;
use \deschdanja\AOP\IJoinPoint;

/**
 * Description of ClassName
 *
 * @author Theodor
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
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        return $this->matchClassname($joinpoint->getClassName());
    }
}
?>
