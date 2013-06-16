<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  ZfModules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Config\Controller;

use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Gc\User\Model as UserModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-15 at 23:50:57.
 *
 * @group    ZfModules
 * @category Gc_Tests
 * @package  ZfModules
 */
class UserControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->init();
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::indexAction
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->dispatch('/admin/config/user');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::loginAction
     *
     * @return void
     */
    public function testLoginAction()
    {
        $auth = new AuthenticationService(new Storage\Session(UserModel::BACKEND_AUTH_NAMESPACE));
        $auth->clearIdentity();

        $this->dispatch('/admin/config/user/login');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/login');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::loginAction
     *
     * @return void
     */
    public function testLoginActionWithIdentity()
    {
        $this->dispatch('/admin/config/user/login');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/login');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::loginAction
     *
     * @return void
     */
    public function testLoginActionWithIdentityAndRedirect()
    {
        ///admin/development/view
        $this->dispatch('/admin/config/user/login/L2FkbWluL2RldmVsb3BtZW50L3ZpZXcvbGlzdA==');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/login');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::loginAction
     *
     * @return void
     */
    public function testLoginActionWithPostData()
    {
        /*
         $auth = new AuthenticationService(new Storage\Session(UserModel::BACKEND_AUTH_NAMESPACE));
        $auth->clearIdentity();

        $this->dispatch(
            '/admin/config/user/login',
            'POST',
            array(
                'login' => 'login',
                'password' => 'test-user-model-password'
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/login');
        */
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::loginAction
     *
     * @return void
     */
    public function testLoginActionWithPostAndRedirectData()
    {
        /*
        $auth = new AuthenticationService(new Storage\Session(UserModel::BACKEND_AUTH_NAMESPACE));
        $auth->clearIdentity();

        $this->dispatch(
            '/admin/config/user/login/L2FkbWlu',
            'POST',
            array(
                'login' => 'login',
                'password' => 'test-user-model-password',
                'redirect' => 'L2FkbWlu'
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/login');
        */
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::loginAction
     *
     * @return void
     */
    public function testLoginActionWithWrongPostData()
    {
        /*
        $auth = new AuthenticationService(new Storage\Session(UserModel::BACKEND_AUTH_NAMESPACE));
        $auth->clearIdentity();

        $this->dispatch(
            '/admin/config/user/login/L2FkbWlu',
            'POST',
            array(
                'login' => 'testlogin',
                'password' => 'passwordtest',
                'redirect' => 'L2FkbWlu'
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/login');
        */
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::forgotPasswordAction
     *
     * @return void
     */
    public function testForgotPasswordAction()
    {
        $this->dispatch('/admin/config/user/forgot-password');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/forgot-password');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::forgotPasswordAction
     *
     * @return void
     */
    public function testForgotPasswordActionWithPostData()
    {
        $this->dispatch(
            '/admin/config/user/forgot-password',
            'POST',
            array(
                'email' => 'pierre.rambaud86@gmail.com'
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/forgot-password');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::forgotPasswordAction
     *
     * @return void
     */
    public function testForgotPasswordActionWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/config/user/forgot-password',
            'POST',
            array(
                'email' => 'pierre.rambaud'
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/forgot-password');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::logoutAction
     *
     * @return void
     */
    public function testLogoutAction()
    {
        $this->dispatch('/admin/config/user/logout');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/logout');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::createAction
     *
     * @return void
     */
    public function testCreateAction()
    {
        $this->dispatch('/admin/config/user/create');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/create');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::createAction
     *
     * @return void
     */
    public function testCreateActionWithWrongPostData()
    {
        $this->dispatch(
            '/admin/config/user/create',
            'POST',
            array(
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/create');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::createAction
     *
     * @return void
     */
    public function testCreateActionWithPostData()
    {
        $this->dispatch(
            '/admin/config/user/create',
            'POST',
            array(
                'email' => 'pierre.rambaud86@gmail.com',
                'firstname' => 'azdazd',
                'lastname' => 'azdazd',
                'login' => 'dazd',
                'password' => 'azdazd',
                'password_confirm' => 'azdazd',
                'user_acl_role_id' => 3,
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/create');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::deleteAction
     *
     * @return void
     */
    public function testDeleteAction()
    {
        $this->dispatch('/admin/config/user/delete/1');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/delete');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::deleteAction
     *
     * @return void
     */
    public function testDeleteActionWithWrongId()
    {
        $this->dispatch('/admin/config/user/delete/9999');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/delete');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::editAction
     *
     * @return void
     */
    public function testEditActionWithWrongId()
    {
        $this->dispatch('/admin/config/user/edit/9999');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/edit');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::editAction
     *
     * @return void
     */
    public function testEditAction()
    {
        $this->dispatch('/admin/config/user/edit/1');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/edit');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::editAction
     *
     * @return void
     */
    public function testEditActionWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/config/user/edit/1',
            'POST',
            array(
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/edit');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::editAction
     *
     * @return void
     */
    public function testEditActionWithPostData()
    {
        $this->dispatch(
            '/admin/config/user/edit/1',
            'POST',
            array(
                'lastname' => 'Test',
                'firstname' => 'Test',
                'email' => 'pierre.rambaud86@got-cms.com',
                'login' => 'testlogin',
                'user_acl_role_id' => 2,
                'password' => 'test',
                'password_confirm' => 'test',
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/edit');
    }

    /**
     * Test
     *
     * @covers Config\Controller\UserController::forbiddenAction
     *
     * @return void
     */
    public function testForbiddenAction()
    {
        $this->dispatch('/admin/config/user/forbidden-access');
        $this->assertResponseStatusCode(403);

        $this->assertModuleName('Config');
        $this->assertControllerName('UserController');
        $this->assertControllerClass('UserController');
        $this->assertMatchedRouteName('config/user/forbidden');
    }
}
