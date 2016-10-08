<?php

namespace Base;

use \Store as ChildStore;
use \StoreQuery as ChildStoreQuery;
use \Exception;
use \PDO;
use Map\StoreTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'store' table.
 *
 *
 *
 * @method     ChildStoreQuery orderByStorePk($order = Criteria::ASC) Order by the store_pk column
 * @method     ChildStoreQuery orderByStoreChainFk($order = Criteria::ASC) Order by the store_chain_fk column
 * @method     ChildStoreQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStoreQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildStoreQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildStoreQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildStoreQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildStoreQuery orderByEmail($order = Criteria::ASC) Order by the email column
 *
 * @method     ChildStoreQuery groupByStorePk() Group by the store_pk column
 * @method     ChildStoreQuery groupByStoreChainFk() Group by the store_chain_fk column
 * @method     ChildStoreQuery groupByName() Group by the name column
 * @method     ChildStoreQuery groupByAddress() Group by the address column
 * @method     ChildStoreQuery groupByZipCode() Group by the zip_code column
 * @method     ChildStoreQuery groupByCity() Group by the city column
 * @method     ChildStoreQuery groupByPhone() Group by the phone column
 * @method     ChildStoreQuery groupByEmail() Group by the email column
 *
 * @method     ChildStoreQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStoreQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStoreQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStoreQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStoreQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStoreQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStoreQuery leftJoinStoreChain($relationAlias = null) Adds a LEFT JOIN clause to the query using the StoreChain relation
 * @method     ChildStoreQuery rightJoinStoreChain($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StoreChain relation
 * @method     ChildStoreQuery innerJoinStoreChain($relationAlias = null) Adds a INNER JOIN clause to the query using the StoreChain relation
 *
 * @method     ChildStoreQuery joinWithStoreChain($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StoreChain relation
 *
 * @method     ChildStoreQuery leftJoinWithStoreChain() Adds a LEFT JOIN clause and with to the query using the StoreChain relation
 * @method     ChildStoreQuery rightJoinWithStoreChain() Adds a RIGHT JOIN clause and with to the query using the StoreChain relation
 * @method     ChildStoreQuery innerJoinWithStoreChain() Adds a INNER JOIN clause and with to the query using the StoreChain relation
 *
 * @method     ChildStoreQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildStoreQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildStoreQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildStoreQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildStoreQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildStoreQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildStoreQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \StoreChainQuery|\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStore findOne(ConnectionInterface $con = null) Return the first ChildStore matching the query
 * @method     ChildStore findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStore matching the query, or a new ChildStore object populated from the query conditions when no match is found
 *
 * @method     ChildStore findOneByStorePk(int $store_pk) Return the first ChildStore filtered by the store_pk column
 * @method     ChildStore findOneByStoreChainFk(int $store_chain_fk) Return the first ChildStore filtered by the store_chain_fk column
 * @method     ChildStore findOneByName(string $name) Return the first ChildStore filtered by the name column
 * @method     ChildStore findOneByAddress(string $address) Return the first ChildStore filtered by the address column
 * @method     ChildStore findOneByZipCode(string $zip_code) Return the first ChildStore filtered by the zip_code column
 * @method     ChildStore findOneByCity(string $city) Return the first ChildStore filtered by the city column
 * @method     ChildStore findOneByPhone(string $phone) Return the first ChildStore filtered by the phone column
 * @method     ChildStore findOneByEmail(string $email) Return the first ChildStore filtered by the email column *

 * @method     ChildStore requirePk($key, ConnectionInterface $con = null) Return the ChildStore by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOne(ConnectionInterface $con = null) Return the first ChildStore matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStore requireOneByStorePk(int $store_pk) Return the first ChildStore filtered by the store_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByStoreChainFk(int $store_chain_fk) Return the first ChildStore filtered by the store_chain_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByName(string $name) Return the first ChildStore filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByAddress(string $address) Return the first ChildStore filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByZipCode(string $zip_code) Return the first ChildStore filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByCity(string $city) Return the first ChildStore filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByPhone(string $phone) Return the first ChildStore filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStore requireOneByEmail(string $email) Return the first ChildStore filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStore[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStore objects based on current ModelCriteria
 * @method     ChildStore[]|ObjectCollection findByStorePk(int $store_pk) Return ChildStore objects filtered by the store_pk column
 * @method     ChildStore[]|ObjectCollection findByStoreChainFk(int $store_chain_fk) Return ChildStore objects filtered by the store_chain_fk column
 * @method     ChildStore[]|ObjectCollection findByName(string $name) Return ChildStore objects filtered by the name column
 * @method     ChildStore[]|ObjectCollection findByAddress(string $address) Return ChildStore objects filtered by the address column
 * @method     ChildStore[]|ObjectCollection findByZipCode(string $zip_code) Return ChildStore objects filtered by the zip_code column
 * @method     ChildStore[]|ObjectCollection findByCity(string $city) Return ChildStore objects filtered by the city column
 * @method     ChildStore[]|ObjectCollection findByPhone(string $phone) Return ChildStore objects filtered by the phone column
 * @method     ChildStore[]|ObjectCollection findByEmail(string $email) Return ChildStore objects filtered by the email column
 * @method     ChildStore[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StoreQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StoreQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\Store', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStoreQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStoreQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStoreQuery) {
            return $criteria;
        }
        $query = new ChildStoreQuery();
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
     * @return ChildStore|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StoreTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StoreTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStore A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT store_pk, store_chain_fk, name, address, zip_code, city, phone, email FROM store WHERE store_pk = :p0';
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
            /** @var ChildStore $obj */
            $obj = new ChildStore();
            $obj->hydrate($row);
            StoreTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStore|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StoreTableMap::COL_STORE_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StoreTableMap::COL_STORE_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the store_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByStorePk(1234); // WHERE store_pk = 1234
     * $query->filterByStorePk(array(12, 34)); // WHERE store_pk IN (12, 34)
     * $query->filterByStorePk(array('min' => 12)); // WHERE store_pk > 12
     * </code>
     *
     * @param     mixed $storePk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByStorePk($storePk = null, $comparison = null)
    {
        if (is_array($storePk)) {
            $useMinMax = false;
            if (isset($storePk['min'])) {
                $this->addUsingAlias(StoreTableMap::COL_STORE_PK, $storePk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($storePk['max'])) {
                $this->addUsingAlias(StoreTableMap::COL_STORE_PK, $storePk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_STORE_PK, $storePk, $comparison);
    }

    /**
     * Filter the query on the store_chain_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByStoreChainFk(1234); // WHERE store_chain_fk = 1234
     * $query->filterByStoreChainFk(array(12, 34)); // WHERE store_chain_fk IN (12, 34)
     * $query->filterByStoreChainFk(array('min' => 12)); // WHERE store_chain_fk > 12
     * </code>
     *
     * @see       filterByStoreChain()
     *
     * @param     mixed $storeChainFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByStoreChainFk($storeChainFk = null, $comparison = null)
    {
        if (is_array($storeChainFk)) {
            $useMinMax = false;
            if (isset($storeChainFk['min'])) {
                $this->addUsingAlias(StoreTableMap::COL_STORE_CHAIN_FK, $storeChainFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($storeChainFk['max'])) {
                $this->addUsingAlias(StoreTableMap::COL_STORE_CHAIN_FK, $storeChainFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_STORE_CHAIN_FK, $storeChainFk, $comparison);
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
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%', Criteria::LIKE); // WHERE zip_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByZipCode($zipCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_ZIP_CODE, $zipCode, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_CITY, $city, $comparison);
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
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_PHONE, $phone, $comparison);
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
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StoreTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query by a related \StoreChain object
     *
     * @param \StoreChain|ObjectCollection $storeChain The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStoreQuery The current query, for fluid interface
     */
    public function filterByStoreChain($storeChain, $comparison = null)
    {
        if ($storeChain instanceof \StoreChain) {
            return $this
                ->addUsingAlias(StoreTableMap::COL_STORE_CHAIN_FK, $storeChain->getStoreChainPk(), $comparison);
        } elseif ($storeChain instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StoreTableMap::COL_STORE_CHAIN_FK, $storeChain->toKeyValue('PrimaryKey', 'StoreChainPk'), $comparison);
        } else {
            throw new PropelException('filterByStoreChain() only accepts arguments of type \StoreChain or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StoreChain relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function joinStoreChain($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StoreChain');

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
            $this->addJoinObject($join, 'StoreChain');
        }

        return $this;
    }

    /**
     * Use the StoreChain relation StoreChain object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StoreChainQuery A secondary query class using the current class as primary query
     */
    public function useStoreChainQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStoreChain($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StoreChain', '\StoreChainQuery');
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStoreQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(StoreTableMap::COL_STORE_PK, $product->getStoreFk(), $comparison);
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
     * @return $this|ChildStoreQuery The current query, for fluid interface
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
     * @param   ChildStore $store Object to remove from the list of results
     *
     * @return $this|ChildStoreQuery The current query, for fluid interface
     */
    public function prune($store = null)
    {
        if ($store) {
            $this->addUsingAlias(StoreTableMap::COL_STORE_PK, $store->getStorePk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the store table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StoreTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StoreTableMap::clearInstancePool();
            StoreTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StoreTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StoreTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StoreTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StoreTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StoreQuery
