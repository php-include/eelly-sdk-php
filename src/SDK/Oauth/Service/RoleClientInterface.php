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

namespace Eelly\SDK\Oauth\Service;

/**
 * 角色客户端关系接口.
 *
 * @author liangxinyi<liangxinyi@eelly.net>
 */
interface RoleClientInterface
{
    /**
     * 批量新增角色客户端.
     *
     * @param int   $roleId    角色id
     * @param array $clientIds 客户端id数组
     *
     * @throws \Eelly\SDK\Oauth\Exception\OauthException
     *
     * @return bool 返回bool值
     * @requestExample({"roleId":1,"clientIds":[1,2,3,4,5]})
     * @returnExample(true)
     *
     * @author liangxinyi<liangxinyi@eelly.net>
     *
     * @since 2017-7-25
     */
    public function addRoleClientBatch(int $roleId, array $clientIds): bool;

    /**
     * 批量更新角色客户端.
     *
     * @param int   $roleId    角色id
     * @param array $clientIds 客户端id数组
     *
     * @throws \Eelly\SDK\Oauth\Exception\OauthException
     *
     * @return bool 返回bool值
     * @requestExample({"roleId":1,"clientIds":[1,2,3,4,5]})
     * @returnExample(true)
     *
     * @author liangxinyi<liangxinyi@eelly.net>
     *
     * @since 2017-7-25
     */
    public function editRoleClientBatch(int $roleId, array $clientIds): bool;

    /**
     * 角色客户端分页列表.
     * 可根据角色id筛选角色客户端关系.
     *
     * @param int $roleId      角色id
     * @param int $limit       每页限制条数
     * @param int $currentPage 当前页
     *
     * @throws \Eelly\SDK\Oauth\Exception\OauthException
     *
     * @return array 返回角色客户端分页列表数组
     * @requestExample({"roleId":1,"limit":10,"currentPage":1})
     * @returnExample({"items":[{"rcId":"1","clientId":"3","roleId":"1","createdTime":"1498042082","updateTime":"2017-06-21 10:51:02","clientKey":"usermodule","orgName":"eellyapi","appName":"user","redirectUri":"","authType":"4","isEncrypt":"\u0001","roleName":"\u7cfb\u7edf\u7ba1\u7406\u5458","defaultPermission":"*\/*\/*"}],"page":{"first":1,"before":1,"current":1,"last":1,"next":1,"totalPages":1,"totalItems":1,"limit":10}})
     *
     * @author liangxinyi<liangxinyi@eelly.net>
     *
     * @since 2017-7-24
     */
    public function listRoleClientPage(int $roleId , int $currentPage = 1, int $limit = 10): array;

    /**
     * 获取角色没有关联的客户端列表.
     * 可根据角色id获取角色没有关联的客户端列表.
     *
     * @param int    $roleId      角色id
     * @param string $clientKey   客户端key
     * @param int    $limit       每页限制条数
     * @param int    $currentPage 当前页
     *
     * @throws \Eelly\SDK\Oauth\Exception\OauthException
     *
     * @return array 返回角色客户端分页列表数组
     * @requestExample({"roleId":1,"clientKey":"","currentPage":1,"limit":10})
     * @returnExample({"items":[{"clientId":"3","clientKey":"usermodule","clientSecret":"$2y$10$MRwHcrISlPJh7XwhZfZ3dunK01Zau1wGXLAB97COFZQKnXXx23p.q","isEncrypt":"1","userId":"0","orgName":"eellyapi","appName":"user","redirectUri":"","authType":"4","createdTime":"1497633249","updateTime":"2017-06-16 17:14:48"}],"page":{"first":1,"before":1,"current":1,"last":3,"next":2,"totalPages":3,"totalItems":3,"limit":1}})
     *
     * @author liangxinyi<liangxinyi@eelly.net>
     * @badSql
     *
     * @since 2017-9-7
     */
    public function listNotRelationClientPage(int $roleId, string $clientKey = null, int $currentPage = 1, int $limit = 10): array;

    /**
     * 删除角色、客户端关系.
     * 根据角色、客户端关系id删除单条对应关系.
     *
     * @param int $rcId 角色、客户端关系id
     *
     * @throws \Eelly\SDK\Oauth\Exception\OauthException
     *
     * @return bool 返回bool值
     * @requestExample({"rcId":1})
     * @returnExample(true)
     *
     * @author liangxinyi<liangxinyi@eelly.net>
     *
     * @since 2017-7-25
     */
    public function deleteRoleClient(int $rcId): bool;

    /**
     * 批量删除角色、客户端关系.
     * 根据角色、客户端关系id数组批量删除对应关系.
     *
     * @param array $rcIds 角色、客户端关系id数组
     *
     * @throws \Eelly\SDK\Oauth\Exception\OauthException
     *
     * @return bool 返回bool值
     * @requestExample({"rcIds":[1,2,3]})
     * @returnExample(true)
     *
     * @author liangxinyi<liangxinyi@eelly.net>
     *
     * @since 2017-7-25
     */
    public function deleteRoleClientBatch(array $rcIds): bool;
}
