<?php
namespace deschdanja\AOP;

/**
 *
 * @author Theodor
 */
interface IPointcutDesignator extends IAOPMatch{
    /**
     * function returns, whether designator works only at runtime
     * e.g. when designator uses argument value
     * @return bool
     */
    public function isRuntimeDesignator();

    /**
     * sets pointcutExpression
     * expression is used as regex to match joinpoint
     * @param string $expression
     */
    public function setPointcutExpression($expression);
    

}
?>
