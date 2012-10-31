<?php
namespace deschdanja\AOP;

/**
 *
 * @author Theodor
 */
interface IPointcut extends IAOPMatch{
    /**
     * add a new designator to the pointcut
     * @param IPointcutDesignator $designator
     */
    public function addDesignator(IPointcutDesignator $designator);

    
}
?>
