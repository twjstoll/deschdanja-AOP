<?php
namespace deschdanja\AOP\Designators;
use deschdanja\AOP\IJoinPoint;

/**
 * Description of InterfaceName
 *
 * @author Theodor
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
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        return $this->matchClassname($joinpoint->getClassName());
    }
}
?>
