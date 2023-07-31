<?php

namespace App\Listeners;
use Phalcon\Events\Event;

use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

class NotificationListener
{
    public function beforeHandleRequest(Event $event, \Phalcon\Mvc\Application $application) {
        
        $aclFile = APP_PATH. '/security/acl.cache';
        if(true===is_file($aclFile)) {

            $acl = unserialize(
                file_get_contents($aclFile)
            );

            $role = $application->request->get('role');
            if(!$role || true != $acl->isAllowed($role, 'order','index')){
                echo 'Access Denied :('; die;
            }
        }else{
            echo 'We dont find any ACL list. Try after sometime';
            die();
        }

    }
}