<?php

/**
 * 加入在公司里，如果你的请假时间小于0.5天，那么只需要向leader打声招呼就OK了。
　　如果0.5<请假天数<=3天，需要先leader打声招呼，要不然leader不知你跑哪里，然后部门经理直接签字。
　　如果3<请假天数 天，需要先leader打声招呼，然后到部门经理签字，最好总经经理确认签字，
　　这样就是个list。也是个不纯的职责链，因为每个对象可能处理一部分后，就需要传给下个对象来处理。
　　
 */

/**
 * 纯职责链模式
 *
 * 为解除请求的发送者和接收者之间的耦合,而使用多个对象都用机会处理这个请求,将这些对象连成一条链,并沿着这条链传递该请求,直到有一个对象处理它
 * @author guisu
 *
 */
/**
 * 抽象处理者角色(Handler:Approver):定义一个处理请求的接口，和一个后继连接(可选)
 *
 */
abstract class Handler
{
    protected $_handler = null;
    protected $_handlerName = null;

    public function setSuccessor($handler)
    {
        $this->_handler = $handler;
    }

    protected  function _success($request)
    {
        echo $request->getName(), '\' request was passed  <br/>';
        return true;
    }
    abstract function handleRequest($request);
}
/**
 * 具体处理者角色(ConcreteHandler:President):处理它所负责的请求，可以访问后继者，如果可以处理请求则处理，否则将该请求转给他的后继者。
 *
 */
class ConcreteHandlerLeader extends Handler
{
    function __construct($handlerName){
        $this->_handlerName = $handlerName;
    }
    public function handleRequest($request)
    {
        echo $this->_handlerName, ' was known <br/>';//已经跟leader招呼了
        if($request->getDay() < 0.5) {
            return $this->_success($request);
        }
        if ($this->_handler instanceof Handler) {
            return $this->_handler->handleRequest($request);
        }
    }
}
/**
 * Manager
 *
 */
class ConcreteHandlerManager extends Handler
{
    function __construct($handlerName){
        $this->_handlerName = $handlerName;
    }

    public function handleRequest($request)
    {
        echo $this->_handlerName, " was signed <br/>";//部门经理签字
        if( $request->getDay() > 0.5 && $request->getDay()<=3) {
            return $this->_success($request);
        }
        if ($this->_handler instanceof Handler) {
            return $this->_handler->handleRequest($request);
        }
    }
}
class ConcreteHandlerGeneralManager extends Handler
{
    function __construct($handlerName){
        $this->_handlerName = $handlerName;
    }

    public function handleRequest($request)
    {
        echo $this->_handlerName, " was signed <br/>";//总经理签字
        if(3 < $request->getDay()){
            return $this->_success($request);
        }
        if ($this->_handler instanceof Handler) {
            return $this->_handler->handleRequest($request);
        }
    }
}
/**
 * 请假申请
 *
 */
class   Request
{
    private $_name;
    private $_day;
    private $_reason;

    function __construct($name= '', $day= 0, $reason = ''){
        $this->_name = $name;
        $this->_day = $day;
        $this->_reason = $reason;
    }

    public function setName($name){
        $this->_name = $name;
    }
    public function getName(){
        return  $this->_name;
    }

    public function setDay($day){
        $this->_day = $day;
    }
    public function getDay(){
        return  $this->_day ;
    }

    public function setReason($reason ){
        $this->_reason = $reason;
    }
    public function getReason( ){
        return  $this->_reason;
    }
}


class client{

    /**
     *流程1：leader-> manager ->generalManager
     *
     */
    static function main(){

        $leader = new ConcreteHandlerLeader('$leader');
        $manager = new ConcreteHandlerManager('$manager');
        $generalManager = new ConcreteHandlerGeneralManager('$generalManager');

        //请求实例
        $request = new Request('guisu',4,'休息' );

        $leader->setSuccessor($manager);
        $manager->setSuccessor($generalManager);
        $result =  $leader->handleRequest($request);
    }

    /**
     * 流程2 :
     * leader ->generalManager
     */
    static function main2(){
        //签字列表
        $leader = new ConcreteHandlerLeader('$leader');
        $manager = new ConcreteHandlerManager('$manager');
        $generalManager = new ConcreteHandlerGeneralManager('$generalManager');

        //请求实例
        $request = new Request('guisu',3,'休息' );
        $leader->setSuccessor($generalManager);
        $result = $leader->handleRequest($request);
    }

    /**
     * 流程3 :如果leader不在，那么完全可以写这样的代码
     * manager ->generalManager
     */
    static function main3(){
        //签字列表
        $leader = new ConcreteHandlerLeader('$leader');
        $manager = new ConcreteHandlerManager('$manager');
        $generalManager = new ConcreteHandlerGeneralManager('$generalManager');

        //请求实例
        $request = new Request('guisu',0.1,'休息' );
        $leader->setSuccessor($manager);
        $manager->setSuccessor($generalManager);
        $result = $manager->handleRequest($request);
    }
}

client::main3();