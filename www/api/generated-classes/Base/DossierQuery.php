<?php

namespace Base;

use \Dossier as ChildDossier;
use \DossierQuery as ChildDossierQuery;
use \Exception;
use \PDO;
use Map\DossierTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'dossier' table.
 *
 *
 *
 * @method     ChildDossierQuery orderByDossierPk($order = Criteria::ASC) Order by the dossier_pk column
 * @method     ChildDossierQuery orderByGuid($order = Criteria::ASC) Order by the guid column
 * @method     ChildDossierQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildDossierQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildDossierQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildDossierQuery orderByUseOcr($order = Criteria::ASC) Order by the use_ocr column
 *
 * @method     ChildDossierQuery groupByDossierPk() Group by the dossier_pk column
 * @method     ChildDossierQuery groupByGuid() Group by the guid column
 * @method     ChildDossierQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildDossierQuery groupByName() Group by the name column
 * @method     ChildDossierQuery groupByDescription() Group by the description column
 * @method     ChildDossierQuery groupByUseOcr() Group by the use_ocr column
 *
 * @method     ChildDossierQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDossierQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDossierQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDossierQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDossierQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDossierQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDossierQuery leftJoinAccountDossierMapping($relationAlias = null) Adds a LEFT JOIN clause to the query using the AccountDossierMapping relation
 * @method     ChildDossierQuery rightJoinAccountDossierMapping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AccountDossierMapping relation
 * @method     ChildDossierQuery innerJoinAccountDossierMapping($relationAlias = null) Adds a INNER JOIN clause to the query using the AccountDossierMapping relation
 *
 * @method     ChildDossierQuery joinWithAccountDossierMapping($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the AccountDossierMapping relation
 *
 * @method     ChildDossierQuery leftJoinWithAccountDossierMapping() Adds a LEFT JOIN clause and with to the query using the AccountDossierMapping relation
 * @method     ChildDossierQuery rightJoinWithAccountDossierMapping() Adds a RIGHT JOIN clause and with to the query using the AccountDossierMapping relation
 * @method     ChildDossierQuery innerJoinWithAccountDossierMapping() Adds a INNER JOIN clause and with to the query using the AccountDossierMapping relation
 *
 * @method     ChildDossierQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildDossierQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildDossierQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildDossierQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildDossierQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildDossierQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildDossierQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \AccountDossierMappingQuery|\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDossier findOne(ConnectionInterface $con = null) Return the first ChildDossier matching the query
 * @method     ChildDossier findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDossier matching the query, or a new ChildDossier object populated from the query conditions when no match is found
 *
 * @method     ChildDossier findOneByDossierPk(int $dossier_pk) Return the first ChildDossier filtered by the dossier_pk column
 * @method     ChildDossier findOneByGuid(string $guid) Return the first ChildDossier filtered by the guid column
 * @method     ChildDossier findOneByCreationDate(string $creation_date) Return the first ChildDossier filtered by the creation_date column
 * @method     ChildDossier findOneByName(string $name) Return the first ChildDossier filtered by the name column
 * @method     ChildDossier findOneByDescription(string $description) Return the first ChildDossier filtered by the description column
 * @method     ChildDossier findOneByUseOcr(boolean $use_ocr) Return the first ChildDossier filtered by the use_ocr column *

 * @method     ChildDossier requirePk($key, ConnectionInterface $con = null) Return the ChildDossier by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDossier requireOne(ConnectionInterface $con = null) Return the first ChildDossier matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDossier requireOneByDossierPk(int $dossier_pk) Return the first ChildDossier filtered by the dossier_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDossier requireOneByGuid(string $guid) Return the first ChildDossier filtered by the guid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDossier requireOneByCreationDate(string $creation_date) Return the first ChildDossier filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDossier requireOneByName(string $name) Return the first ChildDossier filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDossier requireOneByDescription(string $description) Return the first ChildDossier filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDossier requireOneByUseOcr(boolean $use_ocr) Return the first ChildDossier filtered by the use_ocr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDossier[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDossier objects based on current ModelCriteria
 * @method     ChildDossier[]|ObjectCollection findByDossierPk(int $dossier_pk) Return ChildDossier objects filtered by the dossier_pk column
 * @method     ChildDossier[]|ObjectCollection findByGuid(string $guid) Return ChildDossier objects filtered by the guid column
 * @method     ChildDossier[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildDossier objects filtered by the creation_date column
 * @method     ChildDossier[]|ObjectCollection findByName(string $name) Return ChildDossier objects filtered by the name column
 * @method     ChildDossier[]|ObjectCollection findByDescription(string $description) Return ChildDossier objects filtered by the description column
 * @method     ChildDossier[]|ObjectCollection findByUseOcr(boolean $use_ocr) Return ChildDossier objects filtered by the use_ocr column
 * @method     ChildDossier[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DossierQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DossierQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\Dossier', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDossierQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDossierQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDossierQuery) {
            return $criteria;
        }
        $query = new ChildDossierQuery();
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
     * @return ChildDossier|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DossierTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DossierTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDossier A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT dossier_pk, guid, creation_date, name, description, use_ocr FROM dossier WHERE dossier_pk = :p0';
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
            /** @var ChildDossier $obj */
            $obj = new ChildDossier();
            $obj->hydrate($row);
            DossierTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDossier|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the dossier_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByDossierPk(1234); // WHERE dossier_pk = 1234
     * $query->filterByDossierPk(array(12, 34)); // WHERE dossier_pk IN (12, 34)
     * $query->filterByDossierPk(array('min' => 12)); // WHERE dossier_pk > 12
     * </code>
     *
     * @param     mixed $dossierPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByDossierPk($dossierPk = null, $comparison = null)
    {
        if (is_array($dossierPk)) {
            $useMinMax = false;
            if (isset($dossierPk['min'])) {
                $this->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $dossierPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dossierPk['max'])) {
                $this->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $dossierPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $dossierPk, $comparison);
    }

    /**
     * Filter the query on the guid column
     *
     * Example usage:
     * <code>
     * $query->filterByGuid('fooValue');   // WHERE guid = 'fooValue'
     * $query->filterByGuid('%fooValue%', Criteria::LIKE); // WHERE guid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $guid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByGuid($guid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DossierTableMap::COL_GUID, $guid, $comparison);
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
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(DossierTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(DossierTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DossierTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DossierTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DossierTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the use_ocr column
     *
     * Example usage:
     * <code>
     * $query->filterByUseOcr(true); // WHERE use_ocr = true
     * $query->filterByUseOcr('yes'); // WHERE use_ocr = true
     * </code>
     *
     * @param     boolean|string $useOcr The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function filterByUseOcr($useOcr = null, $comparison = null)
    {
        if (is_string($useOcr)) {
            $useOcr = in_array(strtolower($useOcr), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DossierTableMap::COL_USE_OCR, $useOcr, $comparison);
    }

    /**
     * Filter the query by a related \AccountDossierMapping object
     *
     * @param \AccountDossierMapping|ObjectCollection $accountDossierMapping the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDossierQuery The current query, for fluid interface
     */
    public function filterByAccountDossierMapping($accountDossierMapping, $comparison = null)
    {
        if ($accountDossierMapping instanceof \AccountDossierMapping) {
            return $this
                ->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $accountDossierMapping->getDossierFk(), $comparison);
        } elseif ($accountDossierMapping instanceof ObjectCollection) {
            return $this
                ->useAccountDossierMappingQuery()
                ->filterByPrimaryKeys($accountDossierMapping->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAccountDossierMapping() only accepts arguments of type \AccountDossierMapping or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AccountDossierMapping relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function joinAccountDossierMapping($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AccountDossierMapping');

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
            $this->addJoinObject($join, 'AccountDossierMapping');
        }

        return $this;
    }

    /**
     * Use the AccountDossierMapping relation AccountDossierMapping object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AccountDossierMappingQuery A secondary query class using the current class as primary query
     */
    public function useAccountDossierMappingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAccountDossierMapping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AccountDossierMapping', '\AccountDossierMappingQuery');
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDossierQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $product->getDossierFk(), $comparison);
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
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDossier $dossier Object to remove from the list of results
     *
     * @return $this|ChildDossierQuery The current query, for fluid interface
     */
    public function prune($dossier = null)
    {
        if ($dossier) {
            $this->addUsingAlias(DossierTableMap::COL_DOSSIER_PK, $dossier->getDossierPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dossier table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DossierTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DossierTableMap::clearInstancePool();
            DossierTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DossierTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DossierTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DossierTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DossierTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DossierQuery
