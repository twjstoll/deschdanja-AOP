<?php
namespace deschdanja\AOP;

/**
 * interface defines method to match aop-class against
 * classname or joinpoint
 * @author Theodor
 */
interface IAOPMatch {
    /**
     * returns whether aop-object matches classname
     * can throw exception, depending on implementation
     * e.g. runtime-designators should throw exception because they cannot match class only
     *
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname);

    /**
     * matches aop-class against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    public function matchJoinPoint(IJoinPoint $joinpoint);
}
?>
