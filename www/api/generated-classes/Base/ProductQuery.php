<?php

namespace Base;

use \Product as ChildProduct;
use \ProductQuery as ChildProductQuery;
use \Exception;
use \PDO;
use Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product' table.
 *
 *
 *
 * @method     ChildProductQuery orderByProductPk($order = Criteria::ASC) Order by the product_pk column
 * @method     ChildProductQuery orderByDossierFk($order = Criteria::ASC) Order by the dossier_fk column
 * @method     ChildProductQuery orderByStoreFk($order = Criteria::ASC) Order by the store_fk column
 * @method     ChildProductQuery orderByStoreChainFk($order = Criteria::ASC) Order by the store_chain_fk column
 * @method     ChildProductQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProductQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildProductQuery orderByPurchaseDate($order = Criteria::ASC) Order by the purchase_date column
 * @method     ChildProductQuery orderByDueDate($order = Criteria::ASC) Order by the due_date column
 *
 * @method     ChildProductQuery groupByProductPk() Group by the product_pk column
 * @method     ChildProductQuery groupByDossierFk() Group by the dossier_fk column
 * @method     ChildProductQuery groupByStoreFk() Group by the store_fk column
 * @method     ChildProductQuery groupByStoreChainFk() Group by the store_chain_fk column
 * @method     ChildProductQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildProductQuery groupByName() Group by the name column
 * @method     ChildProductQuery groupByDescription() Group by the description column
 * @method     ChildProductQuery groupByPrice() Group by the price column
 * @method     ChildProductQuery groupByPurchaseDate() Group by the purchase_date column
 * @method     ChildProductQuery groupByDueDate() Group by the due_date column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinDossier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dossier relation
 * @method     ChildProductQuery rightJoinDossier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dossier relation
 * @method     ChildProductQuery innerJoinDossier($relationAlias = null) Adds a INNER JOIN clause to the query using the Dossier relation
 *
 * @method     ChildProductQuery joinWithDossier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dossier relation
 *
 * @method     ChildProductQuery leftJoinWithDossier() Adds a LEFT JOIN clause and with to the query using the Dossier relation
 * @method     ChildProductQuery rightJoinWithDossier() Adds a RIGHT JOIN clause and with to the query using the Dossier relation
 * @method     ChildProductQuery innerJoinWithDossier() Adds a INNER JOIN clause and with to the query using the Dossier relation
 *
 * @method     ChildProductQuery leftJoinStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the Store relation
 * @method     ChildProductQuery rightJoinStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Store relation
 * @method     ChildProductQuery innerJoinStore($relationAlias = null) Adds a INNER JOIN clause to the query using the Store relation
 *
 * @method     ChildProductQuery joinWithStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Store relation
 *
 * @method     ChildProductQuery leftJoinWithStore() Adds a LEFT JOIN clause and with to the query using the Store relation
 * @method     ChildProductQuery rightJoinWithStore() Adds a RIGHT JOIN clause and with to the query using the Store relation
 * @method     ChildProductQuery innerJoinWithStore() Adds a INNER JOIN clause and with to the query using the Store relation
 *
 * @method     ChildProductQuery leftJoinStoreChain($relationAlias = null) Adds a LEFT JOIN clause to the query using the StoreChain relation
 * @method     ChildProductQuery rightJoinStoreChain($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StoreChain relation
 * @method     ChildProductQuery innerJoinStoreChain($relationAlias = null) Adds a INNER JOIN clause to the query using the StoreChain relation
 *
 * @method     ChildProductQuery joinWithStoreChain($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StoreChain relation
 *
 * @method     ChildProductQuery leftJoinWithStoreChain() Adds a LEFT JOIN clause and with to the query using the StoreChain relation
 * @method     ChildProductQuery rightJoinWithStoreChain() Adds a RIGHT JOIN clause and with to the query using the StoreChain relation
 * @method     ChildProductQuery innerJoinWithStoreChain() Adds a INNER JOIN clause and with to the query using the StoreChain relation
 *
 * @method     ChildProductQuery leftJoinProductComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductComment relation
 * @method     ChildProductQuery rightJoinProductComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductComment relation
 * @method     ChildProductQuery innerJoinProductComment($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductComment relation
 *
 * @method     ChildProductQuery joinWithProductComment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductComment relation
 *
 * @method     ChildProductQuery leftJoinWithProductComment() Adds a LEFT JOIN clause and with to the query using the ProductComment relation
 * @method     ChildProductQuery rightJoinWithProductComment() Adds a RIGHT JOIN clause and with to the query using the ProductComment relation
 * @method     ChildProductQuery innerJoinWithProductComment() Adds a INNER JOIN clause and with to the query using the ProductComment relation
 *
 * @method     ChildProductQuery leftJoinOcrTask($relationAlias = null) Adds a LEFT JOIN clause to the query using the OcrTask relation
 * @method     ChildProductQuery rightJoinOcrTask($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OcrTask relation
 * @method     ChildProductQuery innerJoinOcrTask($relationAlias = null) Adds a INNER JOIN clause to the query using the OcrTask relation
 *
 * @method     ChildProductQuery joinWithOcrTask($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OcrTask relation
 *
 * @method     ChildProductQuery leftJoinWithOcrTask() Adds a LEFT JOIN clause and with to the query using the OcrTask relation
 * @method     ChildProductQuery rightJoinWithOcrTask() Adds a RIGHT JOIN clause and with to the query using the OcrTask relation
 * @method     ChildProductQuery innerJoinWithOcrTask() Adds a INNER JOIN clause and with to the query using the OcrTask relation
 *
 * @method     \DossierQuery|\StoreQuery|\StoreChainQuery|\ProductCommentQuery|\OcrTaskQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneByProductPk(int $product_pk) Return the first ChildProduct filtered by the product_pk column
 * @method     ChildProduct findOneByDossierFk(int $dossier_fk) Return the first ChildProduct filtered by the dossier_fk column
 * @method     ChildProduct findOneByStoreFk(int $store_fk) Return the first ChildProduct filtered by the store_fk column
 * @method     ChildProduct findOneByStoreChainFk(int $store_chain_fk) Return the first ChildProduct filtered by the store_chain_fk column
 * @method     ChildProduct findOneByCreationDate(string $creation_date) Return the first ChildProduct filtered by the creation_date column
 * @method     ChildProduct findOneByName(string $name) Return the first ChildProduct filtered by the name column
 * @method     ChildProduct findOneByDescription(string $description) Return the first ChildProduct filtered by the description column
 * @method     ChildProduct findOneByPrice(string $price) Return the first ChildProduct filtered by the price column
 * @method     ChildProduct findOneByPurchaseDate(string $purchase_date) Return the first ChildProduct filtered by the purchase_date column
 * @method     ChildProduct findOneByDueDate(string $due_date) Return the first ChildProduct filtered by the due_date column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneByProductPk(int $product_pk) Return the first ChildProduct filtered by the product_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDossierFk(int $dossier_fk) Return the first ChildProduct filtered by the dossier_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByStoreFk(int $store_fk) Return the first ChildProduct filtered by the store_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByStoreChainFk(int $store_chain_fk) Return the first ChildProduct filtered by the store_chain_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCreationDate(string $creation_date) Return the first ChildProduct filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $name) Return the first ChildProduct filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDescription(string $description) Return the first ChildProduct filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByPrice(string $price) Return the first ChildProduct filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByPurchaseDate(string $purchase_date) Return the first ChildProduct filtered by the purchase_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDueDate(string $due_date) Return the first ChildProduct filtered by the due_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findByProductPk(int $product_pk) Return ChildProduct objects filtered by the product_pk column
 * @method     ChildProduct[]|ObjectCollection findByDossierFk(int $dossier_fk) Return ChildProduct objects filtered by the dossier_fk column
 * @method     ChildProduct[]|ObjectCollection findByStoreFk(int $store_fk) Return ChildProduct objects filtered by the store_fk column
 * @method     ChildProduct[]|ObjectCollection findByStoreChainFk(int $store_chain_fk) Return ChildProduct objects filtered by the store_chain_fk column
 * @method     ChildProduct[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildProduct objects filtered by the creation_date column
 * @method     ChildProduct[]|ObjectCollection findByName(string $name) Return ChildProduct objects filtered by the name column
 * @method     ChildProduct[]|ObjectCollection findByDescription(string $description) Return ChildProduct objects filtered by the description column
 * @method     ChildProduct[]|ObjectCollection findByPrice(string $price) Return ChildProduct objects filtered by the price column
 * @method     ChildProduct[]|ObjectCollection findByPurchaseDate(string $purchase_date) Return ChildProduct objects filtered by the purchase_date column
 * @method     ChildProduct[]|ObjectCollection findByDueDate(string $due_date) Return ChildProduct objects filtered by the due_date column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_pk, dossier_fk, store_fk, store_chain_fk, creation_date, name, description, price, purchase_date, due_date FROM product WHERE product_pk = :p0';
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
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByProductPk(1234); // WHERE product_pk = 1234
     * $query->filterByProductPk(array(12, 34)); // WHERE product_pk IN (12, 34)
     * $query->filterByProductPk(array('min' => 12)); // WHERE product_pk > 12
     * </code>
     *
     * @param     mixed $productPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductPk($productPk = null, $comparison = null)
    {
        if (is_array($productPk)) {
            $useMinMax = false;
            if (isset($productPk['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $productPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productPk['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $productPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $productPk, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDossierFk($dossierFk = null, $comparison = null)
    {
        if (is_array($dossierFk)) {
            $useMinMax = false;
            if (isset($dossierFk['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DOSSIER_FK, $dossierFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dossierFk['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DOSSIER_FK, $dossierFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DOSSIER_FK, $dossierFk, $comparison);
    }

    /**
     * Filter the query on the store_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByStoreFk(1234); // WHERE store_fk = 1234
     * $query->filterByStoreFk(array(12, 34)); // WHERE store_fk IN (12, 34)
     * $query->filterByStoreFk(array('min' => 12)); // WHERE store_fk > 12
     * </code>
     *
     * @see       filterByStore()
     *
     * @param     mixed $storeFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByStoreFk($storeFk = null, $comparison = null)
    {
        if (is_array($storeFk)) {
            $useMinMax = false;
            if (isset($storeFk['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_STORE_FK, $storeFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($storeFk['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_STORE_FK, $storeFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_STORE_FK, $storeFk, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByStoreChainFk($storeChainFk = null, $comparison = null)
    {
        if (is_array($storeChainFk)) {
            $useMinMax = false;
            if (isset($storeChainFk['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_STORE_CHAIN_FK, $storeChainFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($storeChainFk['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_STORE_CHAIN_FK, $storeChainFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_STORE_CHAIN_FK, $storeChainFk, $comparison);
    }

    /**
     * Filter the query on the creation_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationDate('2011-03-14'); // WHERE creation_date = '2011-03-14'
     * $query->filterByCreationDate('now'); // WHERE creation_date = '2011-03-14'
     * $query->filterByCreationDate(array('max' => 'yesterday')); // WHERE creation_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the purchase_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPurchaseDate('2011-03-14'); // WHERE purchase_date = '2011-03-14'
     * $query->filterByPurchaseDate('now'); // WHERE purchase_date = '2011-03-14'
     * $query->filterByPurchaseDate(array('max' => 'yesterday')); // WHERE purchase_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $purchaseDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPurchaseDate($purchaseDate = null, $comparison = null)
    {
        if (is_array($purchaseDate)) {
            $useMinMax = false;
            if (isset($purchaseDate['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PURCHASE_DATE, $purchaseDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchaseDate['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PURCHASE_DATE, $purchaseDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PURCHASE_DATE, $purchaseDate, $comparison);
    }

    /**
     * Filter the query on the due_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDueDate('2011-03-14'); // WHERE due_date = '2011-03-14'
     * $query->filterByDueDate('now'); // WHERE due_date = '2011-03-14'
     * $query->filterByDueDate(array('max' => 'yesterday')); // WHERE due_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $dueDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDueDate($dueDate = null, $comparison = null)
    {
        if (is_array($dueDate)) {
            $useMinMax = false;
            if (isset($dueDate['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DUE_DATE, $dueDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dueDate['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DUE_DATE, $dueDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DUE_DATE, $dueDate, $comparison);
    }

    /**
     * Filter the query by a related \Dossier object
     *
     * @param \Dossier|ObjectCollection $dossier The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByDossier($dossier, $comparison = null)
    {
        if ($dossier instanceof \Dossier) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_DOSSIER_FK, $dossier->getDossierPk(), $comparison);
        } elseif ($dossier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_DOSSIER_FK, $dossier->toKeyValue('PrimaryKey', 'DossierPk'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * Filter the query by a related \Store object
     *
     * @param \Store|ObjectCollection $store The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByStore($store, $comparison = null)
    {
        if ($store instanceof \Store) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_STORE_FK, $store->getStorePk(), $comparison);
        } elseif ($store instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_STORE_FK, $store->toKeyValue('PrimaryKey', 'StorePk'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * Filter the query by a related \StoreChain object
     *
     * @param \StoreChain|ObjectCollection $storeChain The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByStoreChain($storeChain, $comparison = null)
    {
        if ($storeChain instanceof \StoreChain) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_STORE_CHAIN_FK, $storeChain->getStoreChainPk(), $comparison);
        } elseif ($storeChain instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductTableMap::COL_STORE_CHAIN_FK, $storeChain->toKeyValue('PrimaryKey', 'StoreChainPk'), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * Filter the query by a related \ProductComment object
     *
     * @param \ProductComment|ObjectCollection $productComment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductComment($productComment, $comparison = null)
    {
        if ($productComment instanceof \ProductComment) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $productComment->getProductFk(), $comparison);
        } elseif ($productComment instanceof ObjectCollection) {
            return $this
                ->useProductCommentQuery()
                ->filterByPrimaryKeys($productComment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductComment() only accepts arguments of type \ProductComment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductComment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductComment');

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
            $this->addJoinObject($join, 'ProductComment');
        }

        return $this;
    }

    /**
     * Use the ProductComment relation ProductComment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductCommentQuery A secondary query class using the current class as primary query
     */
    public function useProductCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductComment', '\ProductCommentQuery');
    }

    /**
     * Filter the query by a related \OcrTask object
     *
     * @param \OcrTask|ObjectCollection $ocrTask the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByOcrTask($ocrTask, $comparison = null)
    {
        if ($ocrTask instanceof \OcrTask) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $ocrTask->getProductFk(), $comparison);
        } elseif ($ocrTask instanceof ObjectCollection) {
            return $this
                ->useOcrTaskQuery()
                ->filterByPrimaryKeys($ocrTask->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOcrTask() only accepts arguments of type \OcrTask or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OcrTask relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinOcrTask($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OcrTask');

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
            $this->addJoinObject($join, 'OcrTask');
        }

        return $this;
    }

    /**
     * Use the OcrTask relation OcrTask object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OcrTaskQuery A secondary query class using the current class as primary query
     */
    public function useOcrTaskQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOcrTask($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OcrTask', '\OcrTaskQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_PRODUCT_PK, $product->getProductPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductQuery
