<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 11/22/16
 */
class AnswerTest extends TestCase
{
    public function test_use_case_1()
    {
        $object = new class {
            public function getOwnerId() {
                return 'qwe123';
            }
        };

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'object.getOwnerId() == user.getId()'
            ],
            new \Is\Sdk\Auth\User('qwe123', 'john.doe@gmail.com'),
            []
        );

        $result = $answer->applyRules([
            'object' => $object
        ]);
        $this->assertFalse($result);
    }

    public function test_use_case_2()
    {
        $object = new class {
            public function getOwnerId() {
                return 'qwe123';
            }
        };

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'object.getOwnerId() == user.getId()'
            ],
            new \Is\Sdk\Auth\User('asd123', 'john.doe@gmail.com'),
            []
        );

        $this->expectException(\Is\Sdk\Exceptions\PermissionException::class);
        $answer->applyRules([
            'object' => $object
        ]);
    }

    public function test_use_case_3()
    {
        $date = DateTime::createFromFormat('Y-m-d', '2016-11-12');

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'date.format("d") > 15'
            ],
            new \Is\Sdk\Auth\User('asd123', 'john.doe@gmail.com'),
            []
        );

        $this->expectException(\Is\Sdk\Exceptions\PermissionException::class);
        $answer->applyRules([
            'date' => $date
        ]);
    }

    public function test_use_case_4()
    {
        $object = new class {
            public function getId() {
                return 20;
            }
        };

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'user.getEmail() != "max.payne@gmail.com" || (user.getEmail() == "max.payne@gmail.com" && object.getId() in 1..10)'
            ],
            new \Is\Sdk\Auth\User('zxc123', 'max.payne@gmail.com'),
            []
        );

        $this->expectException(\Is\Sdk\Exceptions\PermissionException::class);
        $answer->applyRules([
            'object' => $object
        ]);
    }

    public function test_use_case_5()
    {
        $date = DateTime::createFromFormat('Y-m-d', '2016-11-17');

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                '"admin" in user.getRoles() || ("admin" not in user.getRoles() && date.format("d") > 15)'
            ],
            new \Is\Sdk\Auth\User('qwe123', 'pavel.beg@gmail.com', ['manager']),
            []
        );

        $result = $answer->applyRules([
            'date' => $date
        ]);
        $this->assertFalse($result);
    }

    public function test_use_case_6()
    {
        $project = new class {
            public function getId() {
                return 12345;
            }
            
            public function getOwner() {
                return 879;
            }
        };

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'project.getOwner() == user.getId()'
            ],
            new \Is\Sdk\Auth\User('879', 'pavel.beg@gmail.com', ['manager']),
            []
        );

        $result = $answer->applyRules([
            'project' => $project
        ]);
        $this->assertFalse($result);
    }

    public function test_use_case_7()
    {
        $project = new class {
            public function getId() {
                return 12345;
            }

            public function getOwner() {
                return 879;
            }
        };

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'project.getOwner() == user.getId()'
            ],
            new \Is\Sdk\Auth\User('7896', 'pavel.beg@gmail.com', ['manager']),
            []
        );

        $this->expectException(\Is\Sdk\Exceptions\PermissionException::class);
        $answer->applyRules([
            'project' => $project
        ]);
    }

    public function test_use_case_8()
    {
        $project = new class {
            public function getId() {
                return 12345;
            }

            public function getOwner() {
                return 879;
            }
        };

        $answer = new \Is\Sdk\Value\Answer(
            true,
            [
                'project.getId() in aces["project"]'
            ],
            new \Is\Sdk\Auth\User('7896', 'pavel.beg@gmail.com', ['manager']),
            [
                'project' => [12345, 67890]
            ]
        );

        $result = $answer->applyRules([
            'project' => $project
        ]);
        $this->assertFalse($result);
    }
}