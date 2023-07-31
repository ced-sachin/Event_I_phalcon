<?php

use Phalcon\Mvc\Controller;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;
use Phalcon\Acl\Component;


class SecureController extends Controller
{
    public function BulidACLAction()
    {
        $aclFile = APP_PATH.'/security/acl.cache';
        //check whether ACL data already exist
        if(true !== is_file($aclFile)) {
            $acl = new Memory();
            $acl->addRole('admin');
            $acl->addRole('customer');
            $acl->addRole('guest');

            $acl->addComponent(
                'product',
                [
                    'index'
                ]
            );

            $acl->allow('admin', 'product', 'index');
            $acl->deny('guest','*','*');
            file_put_contents(
                $aclFile,
                serialize($acl)
            );
        } else {
            $acl = unserialize(
                file_get_contents($aclFile)
            );
        }

        if(true === $acl->isAllowed('customer','product','index')) {
            echo 'Access granted';
        } else {
            echo 'Access denied :(';
        }
    }
}