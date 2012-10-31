<?php
namespace deschdanja\AOP;
use deschdanja\AOP\Exceptions\InvalidArgument;
use deschdanja\AOP\Exceptions\OperationNotAllowed;
/**
 * AdviceChain holds all different IAspects
 * and can run them against a IJoinpoint
 *
 * @author Theodor Stoll
 */
class AdviceChain implements IAdviceChain{
    /**
     * @var array containing IAspect 
     */
    protected $chain = array();
    
    /**
     * position of chain when executing
     * @var integer 
     */
    protected $position = -1;
    
    /**
     * @var IJoinPoint 
     */
    protected $joinpoint = NULL;

    /**
     * Array with all around aspects
     * @var array 
     */
    protected $around = array();
    
    /**
     * Array with all before aspects
     * @var array 
     */
    protected $before = array();
    
    /**
     * Array with all after aspects
     * @var array 
     */
    protected $after = array();

    /**
     * indicates whether chain is executing
     * @var boolean
     */
    protected $isExecuting = false;

    /**
     * add aspect to chain
     * $aspect->getType() must equal to 'around', 'before' or 'after'
     * @param IAspect $aspect
     * @throw InvalidArgument if type of Aspect not supported
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
     * @throws OperationNotAllowed if chain is already executing
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
     * returns number of added Aspects
     * @return int
     */
    public function getNumberOfAspects(){
        $num = \count($this->before) + \count($this->after) +\count($this->around);
        return $num;
    }

    /**
     * proceeds to next item in chain and runs aspect
     * @throws OperationNotAllowed if chain is not executing
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
     * @throws OperationNotAllowed when chain is executing
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
