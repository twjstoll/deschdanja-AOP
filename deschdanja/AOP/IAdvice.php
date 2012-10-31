<?php
namespace deschdanja\AOP;

/**
 *
 * @author Theodor
 */
interface IAdvice extends IAOPMatch{
    /**
     * add pointcut to advice
     * @param IPointcut $pointcut
     */
    public function addPointcut(IPointcut $pointcut);

    /**
     * returns type of advice
     * @return string
     */
    public function getType();

    /**
     * set type of advice (used by adviceChain)
     * e.g. "around", "before", "after"
     * @param string $type
     */
    public function setType($type);

}
?>
