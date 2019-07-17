<?php
 namespace UmiCms\System\Cache\State;use UmiCms\System\Auth\iAuth;use UmiCms\System\Request\iFacade as iRequest;use UmiCms\System\Response\iFacade as iResponse;class Validator implements iValidator {private $auth;private $request;private $cmsController;private $response;public function __construct(   iAuth $vfa53b91ccc1b78668d5af58e1ed3a485,   iRequest $v10573b873d2fa5a365d558a45e328e47,   \iCmsController $v8b1dc169bf460ee884fceef66c6607d6,   iResponse $vd1fc8eaf36937be0c3ba8cfe0a2c1bfe  ) {$this->auth = $vfa53b91ccc1b78668d5af58e1ed3a485;$this->request = $v10573b873d2fa5a365d558a45e328e47;$this->cmsController = $v8b1dc169bf460ee884fceef66c6607d6;$this->response = $vd1fc8eaf36937be0c3ba8cfe0a2c1bfe;}public function isValid() {if (!$this->isCorrectResponse()) {return false;}if (!$this->isGetRequest()) {return false;}if ($this->isAdminRequest()) {return false;}if ($this->isUserAuthorised()) {return false;}return $this->isPageRequest();}private function isUserAuthorised() {return $this->getAuth()    ->isAuthorized();}private function isGetRequest() {return $this->getRequest()    ->isGet();}private function isAdminRequest() {return $this->getRequest()    ->isAdmin();}private function isCorrectResponse() {return $this->getResponse()    ->isCorrect();}private function isPageRequest() {$vd325fbcd276d83f37605ae233b0edeba = (bool) $this->getCmsController()    ->getCurrentElementId();$vd81b6436ec1ac20a539e4b0357abdb11 = $this->getRequest()    ->isHtml();return $vd325fbcd276d83f37605ae233b0edeba && $vd81b6436ec1ac20a539e4b0357abdb11;}private function getAuth() {return $this->auth;}private function getRequest() {return $this->request;}private function getCmsController() {return $this->cmsController;}private function getResponse() {return $this->response;}}