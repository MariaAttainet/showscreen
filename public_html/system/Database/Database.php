<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Database;

use InvalidArgumentException;

/**
 * Database Connection Factory
 *
 * Creates and returns an instance of the appropriate Database Connection.
 */
class Database
{
    /**
     * Maintains an array of the instances of all connections that have
     * been created.
     *
     * Helps to keep track of all open connections for performance
     * monitoring, logging, etc.
     *
     * @var array
     */
    protected $connections = [];

    /**
     * Parses the connection binds and creates a Database Connection instance.
     *
     * @return BaseConnection
     *
     * @throws InvalidArgumentException
     */
    public function load(array $params = [], string $alias = '')
    {
        if ($alias === '') {
            throw new InvalidArgumentException('You must supply the parameter: alias.');
        }

        if (! empty($params['DSN']) && strpos($params['DSN'], '://') !== false) {
            $params = $this->parseDSN($params);
        }

        if (empty($params['DBDriver'])) {
            throw new InvalidArgumentException('You have not selected a database type to connect to.');
        }

        $this->connections[$alias] = $this->initDriver($params['DBDriver'], 'Connection', $params);

        return $this->connections[$alias];
    }

    /**
     * Creates a Forge instance for the current database type.
     */
    public function loadForge(ConnectionInterface $db): Forge
    {
        if (! $db->connID) {
            $db->initialize();
        }

        return $this->initDriver($db->DBDriver, 'Forge', $db);
    }

    /**
     * Creates an instance of Utils for the current database type.
     */
    public function loadUtils(ConnectionInterface $db): BaseUtils
    {
        if (! $db->connID) {
            $db->initialize();
        }

        return $this->initDriver($db->DBDriver, 'Utils', $db);
    }

    /**
     * Parses universal DSN string
     *
     * @throws InvalidArgumentException
     */
    protected function parseDSN(array $params): array
    {
        $dsn = parse_url($params['DSN']);

        if (! $dsn) {
            throw new InvalidArgumentException('Your DSN connection string is invalid.');
        }

        $dsnParams = [
            'DSN'      => '',
            'DBDriver' => $dsn['scheme'],
            'hostname' => isset($dsn['host']) ? rawurldecode($dsn['host']) : '',
            'port'     => isset($dsn['port']) ? rawurldecode((string) $dsn['port']) : '',
            'username' => isset($dsn['user']) ? rawurldecode($dsn['user']) : '',
            'password' => isset($dsn['pass']) ? rawurldecode($dsn['pass']) : '',
            'database' => isset($dsn['path']) ? rawurldecode(substr($dsn['path'], 1)) : '',
        ];

        if (isset($dsn['query']) && ($dsn['query'] !== '')) {
            parse_str($dsn['query'], $extra);

            foreach ($extra as $key => $val) {
                if (is_string($val) && in_array(strtolower($val), ['true', 'false', 'null'], true)) {
                    $val = $val === 'null' ? null : filter_var($val, FILTER_VALIDATE_BOOLEAN);
                }

                $dsnParams[$key] = $val;
            }
        }

        return array_merge($params, $dsnParams);
    }

    /**
     * Creates a database object.
     *
     * @param string       $driver   Driver name. FQCN can be used.
     * @param string       $class    'Connection'|'Forge'|'Utils'
     * @param array|object $argument The constructor parameter.
     *
     * @return BaseConnection|BaseUtils|Forge
     */
protected function initDriver(string $driver, string $class, $argument): object
{
    $classname = (! str_contains($driver, '\\'))
        ? "CodeIgniter\\Database\\{$driver}\\{$class}"
        : $driver . '\\' . $class;

    // Debugging output to check $classname
    echo "Attempting to load class: $classname<br>";

    if (class_exists($classname)) {
        return new $classname($argument);
    } else {
        // Class not found error handling
        throw new \Exception("Class $classname not found");
    }
}

}
