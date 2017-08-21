<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly\SDK\User\Service;

use Eelly\DTO\UidDTO;
use Eelly\DTO\UserDTO;

/**
 * Interface UserInterface.
 *
 * 用户基础服务接口
 *
 * @author hehui <hehui@eelly.net>
 */
interface UserInterface
{
    /**
     * 检查用户密码.
     *
     * @param string $username 用户名(支持使用用户名和手机号)
     * @param string $password 用户密码
     *
     * @throws \Eelly\Exception\LogicException
     *
     * @return bool 该用户密码是否正确
     *
     * @requestExample(["molimoq", "123456"])
     *
     * @returnExample(true)
     */
    public function checkPassword(string $username, string $password): bool;

    /**
     * 通过密码获取用户信息.
     *
     * @param string $username 用户名(支持使用用户名和手机号)
     * @param string $password 用户密码
     *
     * @throws \Eelly\Exception\LogicException
     *
     * @return UserDTO
     *
     * @requestExample(["molimoq", "123456"])
     *
     * @returnExample({"uid":148086,"username":"molimoq","mobile":"13800138000"})
     */
    public function getUserByPassword(string $username, string $password): UserDTO;

    /**
     * 获取用户信息.
     *
     * @param UidDTO $user
     *
     * @return UserDTO
     *
     * @requestExample()
     *
     * @returnExample({"uid":148086,"username":"molimoq","mobile":"13800138000"})
     */
    public function info(UidDTO $user = null): UserDTO;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function getUser(int $userId): UserDTO;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function addUser(array $data): bool;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function updateUser(int $userId, array $data): bool;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function deleteUser(int $userId): bool;

    /**
     * @author eellytools<localhost.shell@gmail.com>
     */
    public function listUserPage(array $condition = [], int $limit = 10, int $currentPage = 1): array;
}
