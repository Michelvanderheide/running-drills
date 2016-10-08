<?php

namespace Base;

use \UserDossierMapping as ChildUserDossierMapping;
use \UserDossierMappingQuery as ChildUserDossierMappingQuery;
use \Exception;
use \PDO;
use Map\UserDossierMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_dossier_mapping' table.
 *
 *
 *
 * @method     ChildUserDossierMappingQuery orderByUserDossierMappingPk($order = Criteria::ASC) Order by the user_dossier_mapping_pk column
 * @method     ChildUserDossierMappingQuery orderByUserFk($order = Criteria::ASC) Order by the user_fk column
 * @method     ChildUserDossierMappingQuery orderByDossierFk($order = Criteria::ASC) Order by the dossier_fk column
 * @method     ChildUserDossierMappingQuery orderByIsadminuser($order = Criteria::ASC) Order by the isAdminUser column
 *
 * @method     ChildUserDossierMappingQuery groupByUserDossierMappingPk() Group by the user_dossier_mapping_pk column
 * @method     ChildUserDossierMappingQuery groupByUserFk() Group by the user_fk column
 * @method     ChildUserDossierMappingQuery groupByDossierFk() Group by the dossier_fk column
 * @method     ChildUserDossierMappingQuery groupByIsadminuser() Group by the isAdminUser column
 *
 * @method     ChildUserDossierMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserDossierMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserDossierMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserDossierMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserDossierMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserDossierMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserDossierMappingQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildUserDossierMappingQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildUserDossierMappingQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildUserDossierMappingQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildUserDossierMappingQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildUserDossierMappingQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildUserDossierMappingQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildUserDossierMappingQuery leftJoinDossier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dossier relation
 * @method     ChildUserDossierMappingQuery rightJoinDossier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dossier relation
 * @method     ChildUserDossierMappingQuery innerJoinDossier($relationAlias = null) Adds a INNER JOIN clause to the query using the Dossier relation
 *
 * @method     ChildUserDossierMappingQuery joinWithDossier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dossier relation
 *
 * @method     ChildUserDossierMappingQuery leftJoinWithDossier() Adds a LEFT JOIN clause and with to the query using the Dossier relation
 * @method     ChildUserDossierMappingQuery rightJoinWithDossier() Adds a RIGHT JOIN clause and with to the query using the Dossier relation
 * @method     ChildUserDossierMappingQuery innerJoinWithDossier() Adds a INNER JOIN clause and with to the query using the Dossier relation
 *
 * @method     \UsersQuery|\DossierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserDossierMapping findOne(ConnectionInterface $con = null) Return the first ChildUserDossierMapping matching the query
 * @method     ChildUserDossierMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserDossierMapping matching the query, or a new ChildUserDossierMapping object populated from the query conditions when no match is found
 *
 * @method     ChildUserDossierMapping findOneByUserDossierMappingPk(int $user_dossier_mapping_pk) Return the first ChildUserDossierMapping filtered by the user_dossier_mapping_pk column
 * @method     ChildUserDossierMapping findOneByUserFk(int $user_fk) Return the first ChildUserDossierMapping filtered by the user_fk column
 * @method     ChildUserDossierMapping findOneByDossierFk(int $dossier_fk) Return the first ChildUserDossierMapping filtered by the dossier_fk column
 * @method     ChildUserDossierMapping findOneByIsadminuser(boolean $isAdminUser) Return the first ChildUserDossierMapping filtered by the isAdminUser column *

 * @method     ChildUserDossierMapping requirePk($key, ConnectionInterface $con = null) Return the ChildUserDossierMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserDossierMapping requireOne(ConnectionInterface $con = null) Return the first ChildUserDossierMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserDossierMapping requireOneByUserDossierMappingPk(int $user_dossier_mapping_pk) Return the first ChildUserDossierMapping filtered by the user_dossier_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserDossierMapping requireOneByUserFk(int $user_fk) Return the first ChildUserDossierMapping filtered by the user_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserDossierMapping requireOneByDossierFk(int $dossier_fk) Return the first ChildUserDossierMapping filtered by the dossier_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserDossierMapping requireOneByIsadminuser(boolean $isAdminUser) Return the first ChildUserDossierMapping filtered by the isAdminUser column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserDossierMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserDossierMapping objects based on current ModelCriteria
 * @method     ChildUserDossierMapping[]|ObjectCollection findByUserDossierMappingPk(int $user_dossier_mapping_pk) Return ChildUserDossierMapping objects filtered by the user_dossier_mapping_pk column
 * @method     ChildUserDossierMapping[]|ObjectCollection findByUserFk(int $user_fk) Return ChildUserDossierMapping objects filtered by the user_fk column
 * @method     ChildUserDossierMapping[]|ObjectCollection findByDossierFk(int $dossier_fk) Return ChildUserDossierMapping objects filtered by the dossier_fk column
 * @method     ChildUserDossierMapping[]|ObjectCollection findByIsadminuser(boolean $isAdminUser) Return ChildUserDossierMapping objects filtered by the isAdminUser column
 * @method     ChildUserDossierMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserDossierMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserDossierMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\UserDossierMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserDossierMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserDossierMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserDossierMappingQuery) {
            return $criteria;
        }
        $query = new ChildUserDossierMappingQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUserDossierMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserDossierMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserDossierMappingTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserDossierMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_dossier_mapping_pk, user_fk, dossier_fk, isAdminUser FROM user_dossier_mapping WHERE user_dossier_mapping_pk = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUserDossierMapping $obj */
            $obj = new ChildUserDossierMapping();
            $obj->hydrate($row);
            UserDossierMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUserDossierMapping|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_DOSSIER_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_DOSSIER_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the user_dossier_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByUserDossierMappingPk(1234); // WHERE user_dossier_mapping_pk = 1234
     * $query->filterByUserDossierMappingPk(array(12, 34)); // WHERE user_dossier_mapping_pk IN (12, 34)
     * $query->filterByUserDossierMappingPk(array('min' => 12)); // WHERE user_dossier_mapping_pk > 12
     * </code>
     *
     * @param     mixed $userDossierMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByUserDossierMappingPk($userDossierMappingPk = null, $comparison = null)
    {
        if (is_array($userDossierMappingPk)) {
            $useMinMax = false;
            if (isset($userDossierMappingPk['min'])) {
                $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_DOSSIER_MAPPING_PK, $userDossierMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userDossierMappingPk['max'])) {
                $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_DOSSIER_MAPPING_PK, $userDossierMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_DOSSIER_MAPPING_PK, $userDossierMappingPk, $comparison);
    }

    /**
     * Filter the query on the user_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByUserFk(1234); // WHERE user_fk = 1234
     * $query->filterByUserFk(array(12, 34)); // WHERE user_fk IN (12, 34)
     * $query->filterByUserFk(array('min' => 12)); // WHERE user_fk > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $userFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByUserFk($userFk = null, $comparison = null)
    {
        if (is_array($userFk)) {
            $useMinMax = false;
            if (isset($userFk['min'])) {
                $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_FK, $userFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userFk['max'])) {
                $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_FK, $userFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_FK, $userFk, $comparison);
    }

    /**
     * Filter the query on the dossier_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByDossierFk(1234); // WHERE dossier_fk = 1234
     * $query->filterByDossierFk(array(12, 34)); // WHERE dossier_fk IN (12, 34)
     * $query->filterByDossierFk(array('min' => 12)); // WHERE dossier_fk > 12
     * </code>
     *
     * @see       filterByDossier()
     *
     * @param     mixed $dossierFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByDossierFk($dossierFk = null, $comparison = null)
    {
        if (is_array($dossierFk)) {
            $useMinMax = false;
            if (isset($dossierFk['min'])) {
                $this->addUsingAlias(UserDossierMappingTableMap::COL_DOSSIER_FK, $dossierFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dossierFk['max'])) {
                $this->addUsingAlias(UserDossierMappingTableMap::COL_DOSSIER_FK, $dossierFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserDossierMappingTableMap::COL_DOSSIER_FK, $dossierFk, $comparison);
    }

    /**
     * Filter the query on the isAdminUser column
     *
     * Example usage:
     * <code>
     * $query->filterByIsadminuser(true); // WHERE isAdminUser = true
     * $query->filterByIsadminuser('yes'); // WHERE isAdminUser = true
     * </code>
     *
     * @param     boolean|string $isadminuser The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByIsadminuser($isadminuser = null, $comparison = null)
    {
        if (is_string($isadminuser)) {
            $isadminuser = in_array(strtolower($isadminuser), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserDossierMappingTableMap::COL_ISADMINUSER, $isadminuser, $comparison);
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(UserDossierMappingTableMap::COL_USER_FK, $users->getUserPk(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserDossierMappingTableMap::COL_USER_FK, $users->toKeyValue('PrimaryKey', 'UserPk'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\UsersQuery');
    }

    /**
     * Filter the query by a related \Dossier object
     *
     * @param \Dossier|ObjectCollection $dossier The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function filterByDossier($dossier, $comparison = null)
    {
        if ($dossier instanceof \Dossier) {
            return $this
                ->addUsingAlias(UserDossierMappingTableMap::COL_DOSSIER_FK, $dossier->getDossierPk(), $comparison);
        } elseif ($dossier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserDossierMappingTableMap::COL_DOSSIER_FK, $dossier->toKeyValue('PrimaryKey', 'DossierPk'), $comparison);
        } else {
            throw new PropelException('filterByDossier() only accepts arguments of type \Dossier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dossier relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function joinDossier($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dossier');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Dossier');
        }

        return $this;
    }

    /**
     * Use the Dossier relation Dossier object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DossierQuery A secondary query class using the current class as primary query
     */
    public function useDossierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDossier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dossier', '\DossierQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserDossierMapping $userDossierMapping Object to remove from the list of results
     *
     * @return $this|ChildUserDossierMappingQuery The current query, for fluid interface
     */
    public function prune($userDossierMapping = null)
    {
        if ($userDossierMapping) {
            $this->addUsingAlias(UserDossierMappingTableMap::COL_USER_DOSSIER_MAPPING_PK, $userDossierMapping->getUserDossierMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_dossier_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserDossierMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserDossierMappingTableMap::clearInstancePool();
            UserDossierMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserDossierMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserDossierMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserDossierMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserDossierMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserDossierMappingQuery
