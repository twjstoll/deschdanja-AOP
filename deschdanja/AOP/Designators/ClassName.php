<?php
namespace deschdanja\TS\AOP\Designators;
use \deschdanja\TS\AOP\IJoinPoint;

/**
 * Description of ClassName
 *
 * @author Theodor
 */
class ClassName extends ADesignatorNonRuntime{
    /**
     * returns wheter aop-object matches classname
     * 
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        if(\preg_match($this->expression, $classname) == 1){
            return true;
        }
        echo "<br>$classname does not match $this->expression";
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
