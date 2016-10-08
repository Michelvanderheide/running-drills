<?php

namespace Base;

use \StoreChain as ChildStoreChain;
use \StoreChainQuery as ChildStoreChainQuery;
use \Exception;
use \PDO;
use Map\StoreChainTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'store_chain' table.
 *
 *
 *
 * @method     ChildStoreChainQuery orderByStoreChainPk($order = Criteria::ASC) Order by the store_chain_pk column
 * @method     ChildStoreChainQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStoreChainQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildStoreChainQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 * @method     ChildStoreChainQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildStoreChainQuery orderByImgUrl($order = Criteria::ASC) Order by the img_url column
 *
 * @method     ChildStoreChainQuery groupByStoreChainPk() Group by the store_chain_pk column
 * @method     ChildStoreChainQuery groupByName() Group by the name column
 * @method     ChildStoreChainQuery groupByPhone() Group by the phone column
 * @method     ChildStoreChainQuery groupByWebsite() Group by the website column
 * @method     ChildStoreChainQuery groupByEmail() Group by the email column
 * @method     ChildStoreChainQuery groupByImgUrl() Group by the img_url column
 *
 * @method     ChildStoreChainQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStoreChainQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStoreChainQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStoreChainQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStoreChainQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStoreChainQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStoreChainQuery leftJoinStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the Store relation
 * @method     ChildStoreChainQuery rightJoinStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Store relation
 * @method     ChildStoreChainQuery innerJoinStore($relationAlias = null) Adds a INNER JOIN clause to the query using the Store relation
 *
 * @method     ChildStoreChainQuery joinWithStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Store relation
 *
 * @method     ChildStoreChainQuery leftJoinWithStore() Adds a LEFT JOIN clause and with to the query using the Store relation
 * @method     ChildStoreChainQuery rightJoinWithStore() Adds a RIGHT JOIN clause and with to the query using the Store relation
 * @method     ChildStoreChainQuery innerJoinWithStore() Adds a INNER JOIN clause and with to the query using the Store relation
 *
 * @method     ChildStoreChainQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildStoreChainQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildStoreChainQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildStoreChainQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildStoreChainQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildStoreChainQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildStoreChainQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \StoreQuery|\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStoreChain findOne(ConnectionInterface $con = null) Return the first ChildStoreChain matching the query
 * @method     ChildStoreChain findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStoreChain matching the query, or a new ChildStoreChain object populated from the query conditions when no match is found
 *
 * @method     ChildStoreChain findOneByStoreChainPk(int $store_chain_pk) Return the first ChildStoreChain filtered by the store_chain_pk column
 * @method     ChildStoreChain findOneByName(string $name) Return the first ChildStoreChain filtered by the name column
 * @method     ChildStoreChain findOneByPhone(string $phone) Return the first ChildStoreChain filtered by the phone column
 * @method     ChildStoreChain findOneByWebsite(string $website) Return the first ChildStoreChain filtered by the website column
 * @method     ChildStoreChain findOneByEmail(string $email) Return the first ChildStoreChain filtered by the email column
 * @method     ChildStoreChain findOneByImgUrl(string $img_url) Return the first ChildStoreChain filtered by the img_url column *

 * @method     ChildStoreChain requirePk($key, ConnectionInterface $con = null) Return the ChildStoreChain by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStoreChain requireOne(ConnectionInterface $con = null) Return the first ChildStoreChain matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStoreChain requireOneByStoreChainPk(int $store_chain_pk) Return the first ChildStoreChain filtered by the store_chain_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStoreChain requireOneByName(string $name) Return the first ChildStoreChain filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStoreChain requireOneByPhone(string $phone) Return the first ChildStoreChain filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStoreChain requireOneByWebsite(string $website) Return the first ChildStoreChain filtered by the website column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStoreChain requireOneByEmail(string $email) Return the first ChildStoreChain filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStoreChain requireOneByImgUrl(string $img_url) Return the first ChildStoreChain filtered by the img_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStoreChain[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStoreChain objects based on current ModelCriteria
 * @method     ChildStoreChain[]|ObjectCollection findByStoreChainPk(int $store_chain_pk) Return ChildStoreChain objects filtered by the store_chain_pk column
 * @method     ChildStoreChain[]|ObjectCollection findByName(string $name) Return ChildStoreChain objects filtered by the name column
 * @method     ChildStoreChain[]|ObjectCollection findByPhone(string $phone) Return ChildStoreChain objects filtered by the phone column
 * @method     ChildStoreChain[]|ObjectCollection findByWebsite(string $website) Return ChildStoreChain objects filtered by the website column
 * @method     ChildStoreChain[]|ObjectCollection findByEmail(string $email) Return ChildStoreChain objects filtered by the email column
 * @method     ChildStoreChain[]|ObjectCollection findByImgUrl(string $img_url) Return ChildStoreChain objects filtered by the img_url column
 * @method     ChildStoreChain[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StoreChainQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StoreChainQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\StoreChain', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStoreChainQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStoreChainQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStoreChainQuery) {
            return $criteria;
        }
        $query = new ChildStoreChainQuery();
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
     * @return ChildStoreChain|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StoreChainTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StoreChainTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildStoreChain A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT store_chain_pk, name, phone, website, email, img_url FROM store_chain WHERE store_chain_pk = :p0';
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
            /** @var ChildStoreChain $obj */
            $obj = new ChildStoreChain();
            $obj->hydrate($row);
            StoreChainTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStoreChain|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the store_chain_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByStoreChainPk(1234); // WHERE store_chain_pk = 1234
     * $query->filterByStoreChainPk(array(12, 34)); // WHERE store_chain_pk IN (12, 34)
     * $query->filterByStoreChainPk(array('min' => 12)); // WHERE store_chain_pk > 12
     * </code>
     *
     * @param     mixed $storeChainPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByStoreChainPk($storeChainPk = null, $comparison = null)
    {
        if (is_array($storeChainPk)) {
            $useMinMax = false;
            if (isset($storeChainPk['min'])) {
                $this->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $storeChainPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($storeChainPk['max'])) {
                $this->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $storeChainPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $storeChainPk, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreChainTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreChainTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the website column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsite('fooValue');   // WHERE website = 'fooValue'
     * $query->filterByWebsite('%fooValue%', Criteria::LIKE); // WHERE website LIKE '%fooValue%'
     * </code>
     *
     * @param     string $website The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByWebsite($website = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($website)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreChainTableMap::COL_WEBSITE, $website, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreChainTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the img_url column
     *
     * Example usage:
     * <code>
     * $query->filterByImgUrl('fooValue');   // WHERE img_url = 'fooValue'
     * $query->filterByImgUrl('%fooValue%', Criteria::LIKE); // WHERE img_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgUrl The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByImgUrl($imgUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgUrl)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreChainTableMap::COL_IMG_URL, $imgUrl, $comparison);
    }

    /**
     * Filter the query by a related \Store object
     *
     * @param \Store|ObjectCollection $store the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByStore($store, $comparison = null)
    {
        if ($store instanceof \Store) {
            return $this
                ->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $store->getStoreChainFk(), $comparison);
        } elseif ($store instanceof ObjectCollection) {
            return $this
                ->useStoreQuery()
                ->filterByPrimaryKeys($store->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStore() only accepts arguments of type \Store or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Store relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function joinStore($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Store');

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
            $this->addJoinObject($join, 'Store');
        }

        return $this;
    }

    /**
     * Use the Store relation Store object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StoreQuery A secondary query class using the current class as primary query
     */
    public function useStoreQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Store', '\StoreQuery');
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStoreChainQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $product->getStoreChainFk(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            return $this
                ->useProductQuery()
                ->filterByPrimaryKeys($product->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStoreChain $storeChain Object to remove from the list of results
     *
     * @return $this|ChildStoreChainQuery The current query, for fluid interface
     */
    public function prune($storeChain = null)
    {
        if ($storeChain) {
            $this->addUsingAlias(StoreChainTableMap::COL_STORE_CHAIN_PK, $storeChain->getStoreChainPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the store_chain table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StoreChainTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StoreChainTableMap::clearInstancePool();
            StoreChainTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StoreChainTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StoreChainTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StoreChainTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StoreChainTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StoreChainQuery
