<?php
/**
 * Database Setup Entity
 *
 * Copyright (C) 2017 Robert Down <robertdown@live.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     OpenEMR
 * @subpackage  Installation
 * @author      Robert Down <robertdown@live.com>
 * @license     GPL3
 * @copyright   2017 Robert Down <robertdown@live.com>
 * @link        http://www.open-emr.org
 *
 **/

namespace OpenEMR\Setup\Entity;


class DatabaseSetup
{

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $dbName;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $pass;

    /**
     * @var string
     */
    protected $rootUser;

    /**
     * @var string
     */
    protected $rootPass;

    /**
     * @var string
     */
    protected $loginHost;

    /**
     * @var string
     */
    protected $collate;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $iUserPass;

    /**
     * @var string
     */
    protected $iUFname;

    /**
     * @var string
     */
    protected $iUName;

    /**
     * @var string
     */
    protected $iGroup;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $cloneDatabase;

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * @param string $dbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getRootUser()
    {
        return $this->rootUser;
    }

    /**
     * @param string $rootUser
     */
    public function setRootUser($rootUser)
    {
        $this->rootUser = $rootUser;
    }

    /**
     * @return string
     */
    public function getRootPass()
    {
        return $this->rootPass;
    }

    /**
     * @param string $rootPass
     */
    public function setRootPass($rootPass)
    {
        $this->rootPass = $rootPass;
    }

    /**
     * @return string
     */
    public function getLoginHost()
    {
        return $this->loginHost;
    }

    /**
     * @param string $loginHost
     */
    public function setLoginHost($loginHost)
    {
        $this->loginHost = $loginHost;
    }

    /**
     * @return string
     */
    public function getCollate()
    {
        return $this->collate;
    }

    /**
     * @param string $collate
     */
    public function setCollate($collate)
    {
        $this->collate = $collate;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getIUserPass()
    {
        return $this->iUserPass;
    }

    /**
     * @param string $iUserPass
     */
    public function setIUserPass($iUserPass)
    {
        $this->iUserPass = $iUserPass;
    }

    /**
     * @return string
     */
    public function getIUFname()
    {
        return $this->iUFname;
    }

    /**
     * @param string $iUFname
     */
    public function setIUFname($iUFname)
    {
        $this->iUFname = $iUFname;
    }

    /**
     * @return string
     */
    public function getIUName()
    {
        return $this->iUName;
    }

    /**
     * @param string $iUName
     */
    public function setIUName($iUName)
    {
        $this->iUName = $iUName;
    }

    /**
     * @return string
     */
    public function getIGroup()
    {
        return $this->iGroup;
    }

    /**
     * @param string $iGroup
     */
    public function setIGroup($iGroup)
    {
        $this->iGroup = $iGroup;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getCloneDatabase()
    {
        return $this->cloneDatabase;
    }

    /**
     * @param string $cloneDatabase
     */
    public function setCloneDatabase($cloneDatabase)
    {
        $this->cloneDatabase = $cloneDatabase;
    }
}
