<?php
namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\OperationUnsupported;
/**
 * Abstract Advice Class
 * Can be used as base for different advice types
 *
 * @author Theodor
 */
abstract class AAdvice implements IAspect{
    protected $pointcuts = array();
    protected $type = NULL;
    //protected $possibleTypes = array();

    //abstract protected function advice(IJoinPoint $joinpoint);

    /**
     * add pointcut to advice
     * @param IPointcut $pointcut
     */
    public function addPointcut(IPointcut $pointcut){
        $this->pointcuts[] = $pointcut;
    }

    /**
     * returns type of advice
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * matches pointcuts against classname
     * returns false if no pointcuts set
     * returns true if one of them matches
     * 
     * @param string $classname fully qualified classname
     * @return bool
     */
    public function matchClassname($classname){
        foreach($this->pointcuts as $pointcut){
            if($pointcut->matchClassname($classname)){
                return true;
            }
        }
        return false;
    }

    /**
     * matches pointcuts against joinpoint
     * returns false if not pointcuts set
     * returns true if one of the pointcuts matches
     * @param IJoinPoint $joinpoint
     * @return bool
     */
    public function matchJoinPoint(IJoinPoint $joinpoint){
        foreach($this->pointcuts as $pointcut){
            if($pointcut->matchJoinPoint($joinpoint)){
                return true;
            }
        }
        return false;
    }

    /**
     * function checks whether advice has any matching pointcuts
     * if so, runs function advice
     * can proceed with execution of chain through advice chain
     */
    public function runAspect(IJoinPoint $joinpoint, IAdviceChain $adviceChain){
        throw new OperationUnsupported("method is not implemented");
    }

    /**
     * set type of advice (used by adviceChain)
     * e.g. "around", "before", "after"
     * @param string $type
     */
    public function setType($type){
        $this->type = \trim(\strval($type));
    }
}
?>
