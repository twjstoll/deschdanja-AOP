<?php
namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\OperationUnsupported;

/**
 * Description of APointcutDesignator
 *
 * @author Theodor Stoll
 */
abstract class APointcutDesignator implements IPointcutDesignator{
    /**
     * @var string 
     */
    protected $expression = "";
    
    /**
     * @var boolean 
     */
    protected $runtimeDesignator = false;


    /**
     * function returns, whether designator works only at runtime
     * e.g. when designator uses argument value
     * @return bool
     */
    public function isRuntimeDesignator(){
        return $this->runtimeDesignator;
    }

    /**
     * matches designator against class
     * this is only possible for non runtime designators!
     * runtime designator will throw OperationUnsupported
     *
     * @param string $classname fully qualified classname
     * @return bool
     * @throws OperationUnsupported if runtime designator
     */
    public function matchClassname($classname){
        if($this->runtimeDesignator){
            throw new OperationUnsupported("designator uses Runtime elements and can therefore not match against Classname");
        }
        return false;
    }

    /**
     * matches designator against joinpoint
     * @param IJoinPoint $joinpoint
     * @return bool;
     */
    abstract public function matchJoinPoint(IJoinPoint $joinpoint);

    /**
     * sets pointcutExpression
     * expression is used as regex to match joinpoint
     * @param string $expression
     */
    public function setPointcutExpression($expression){
        $this->expression = strval($expression);
    }

}
?>
