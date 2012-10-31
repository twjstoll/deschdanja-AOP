<?php
namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;
use deschdanja\AOP\Exceptions\OperationNotAllowed;
/**
 * Description of AdviceChain
 *
 * @author Theodor
 */
class AdviceChain implements IAdviceChain{
    protected $chain = array();
    protected $position = -1;
    protected $joinpoint = NULL;

    protected $around = array();
    protected $before = array();
    protected $after = array();

    protected $isExecuting = false;

    /**
     * add aspect to chain
     * @param IAspect $aspect
     */
    public function addAspect(IAspect $aspect){
        $type = $aspect->getType();
        if($type != "around" && $type != "before" && $type != "after"){
            throw new InvalidArgument("type '$type' of aspect not supported");
        }
        $this->{$type}[]=$aspect;
    }

    /**
     * start execuction of chain
     * @param IJoinPoint $joinpoint
     */
    public function executeChain(IJoinPoint $joinpoint){
        if($this->isExecuting){
            throw new OperationNotAllowed("chain is already executing. Cannot execute again.");
        }
        //lock executions
        $this->isExecuting = true;
        //set joinpoint
        $this->joinpoint = $joinpoint;
        //
        $this->chain = \array_merge($this->around, $this->before, array($joinpoint), $this->after);

        //start execution of chain
        $this->proceed();

        //reset parameters and unlock execution
        $this->position = -1;
        $this->joinpoint = NULL;
        $this->chain = array();
        $this->isExecuting = false;
    }

    /**
     * returns number added Aspects
     * @return int
     */
    public function getNumberOfAspects(){
        $num = \count($this->before) + \count($this->after) +\count($this->around);
        return $num;
    }

    /**
     * proceeds to next item in chain and runs aspect
     */
    public function proceed(){
        if(!$this->isExecuting){
            throw new OperationNotAllowed("chain is not executing, no proceeding allowed");
        }
        $this->position++;

        if($this->position < \count($this->chain)){
            $this->chain[$this->position]->runAspect($this->joinpoint, $this);
        }
    }

    /**
     * removes all aspects from adviceChain
     * only possible when not executing chain
     */
    public function reset(){
        if($this->isExecuting){
            throw new OperationNotAllowed("no reset of advice chain while executing");
        }
        foreach($this->after as $key => $value){
            $this->after[$key] = NULL;
            unset($this->after[$key]);
        }
        foreach($this->around as $key => $value){
            $this->around[$key] = NULL;
            unset($this->around[$key]);
        }
        foreach($this->before as $key => $value){
            $this->before[$key] = NULL;
            unset ($this->before[$eky]);
        }
    }
}
?>
