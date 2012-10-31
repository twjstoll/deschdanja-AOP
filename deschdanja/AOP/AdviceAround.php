<?php
namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;
/**
 * An AdviceAround will be called prior to
 * AdviceNonAround (before and after)
 * and is able to prevent any further advices and the target to be called!
 *
 * @author Theodor Stoll
 */
class AdviceAround extends AAdvice{
    protected $type = "around";

    /**
     * implemented advice
     * advice will decide, whether to proceed with adviceChain
     *
     * @param IJoinPoint $joinpoint
     * @param IAdviceChain $adviceChain
     * @return bool
     */
    protected function advice(IJoinPoint $joinpoint, IAdviceChain $adviceChain){
        $adviceChain->proceed();
    }

    
    final public function runAspect(IJoinPoint $joinpoint, IAdviceChain $adviceChain){
        if($this->matchJoinPoint($joinpoint)){
            $this->advice($joinpoint, $adviceChain);
        }else{
            $adviceChain->proceed();
        }
    }

    public function setType($type){
        if($type != "around"){
            throw new InvalidArgument("only type 'around' allowed in around advice");
        }
        parent::setType($type);
    }
}
?>
