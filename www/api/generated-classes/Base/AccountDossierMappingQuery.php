<?php

namespace Base;

use \AccountDossierMapping as ChildAccountDossierMapping;
use \AccountDossierMappingQuery as ChildAccountDossierMappingQuery;
use \Exception;
use \PDO;
use Map\AccountDossierMappingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'account_dossier_mapping' table.
 *
 *
 *
 * @method     ChildAccountDossierMappingQuery orderByAccountDossierMappingPk($order = Criteria::ASC) Order by the account_dossier_mapping_pk column
 * @method     ChildAccountDossierMappingQuery orderByAccountFk($order = Criteria::ASC) Order by the account_fk column
 * @method     ChildAccountDossierMappingQuery orderByDossierFk($order = Criteria::ASC) Order by the dossier_fk column
 * @method     ChildAccountDossierMappingQuery orderByIsAdmin($order = Criteria::ASC) Order by the is_admin column
 *
 * @method     ChildAccountDossierMappingQuery groupByAccountDossierMappingPk() Group by the account_dossier_mapping_pk column
 * @method     ChildAccountDossierMappingQuery groupByAccountFk() Group by the account_fk column
 * @method     ChildAccountDossierMappingQuery groupByDossierFk() Group by the dossier_fk column
 * @method     ChildAccountDossierMappingQuery groupByIsAdmin() Group by the is_admin column
 *
 * @method     ChildAccountDossierMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAccountDossierMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAccountDossierMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAccountDossierMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAccountDossierMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAccountDossierMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAccountDossierMappingQuery leftJoinAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Account relation
 * @method     ChildAccountDossierMappingQuery rightJoinAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Account relation
 * @method     ChildAccountDossierMappingQuery innerJoinAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the Account relation
 *
 * @method     ChildAccountDossierMappingQuery joinWithAccount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Account relation
 *
 * @method     ChildAccountDossierMappingQuery leftJoinWithAccount() Adds a LEFT JOIN clause and with to the query using the Account relation
 * @method     ChildAccountDossierMappingQuery rightJoinWithAccount() Adds a RIGHT JOIN clause and with to the query using the Account relation
 * @method     ChildAccountDossierMappingQuery innerJoinWithAccount() Adds a INNER JOIN clause and with to the query using the Account relation
 *
 * @method     ChildAccountDossierMappingQuery leftJoinDossier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dossier relation
 * @method     ChildAccountDossierMappingQuery rightJoinDossier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dossier relation
 * @method     ChildAccountDossierMappingQuery innerJoinDossier($relationAlias = null) Adds a INNER JOIN clause to the query using the Dossier relation
 *
 * @method     ChildAccountDossierMappingQuery joinWithDossier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dossier relation
 *
 * @method     ChildAccountDossierMappingQuery leftJoinWithDossier() Adds a LEFT JOIN clause and with to the query using the Dossier relation
 * @method     ChildAccountDossierMappingQuery rightJoinWithDossier() Adds a RIGHT JOIN clause and with to the query using the Dossier relation
 * @method     ChildAccountDossierMappingQuery innerJoinWithDossier() Adds a INNER JOIN clause and with to the query using the Dossier relation
 *
 * @method     \AccountQuery|\DossierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAccountDossierMapping findOne(ConnectionInterface $con = null) Return the first ChildAccountDossierMapping matching the query
 * @method     ChildAccountDossierMapping findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAccountDossierMapping matching the query, or a new ChildAccountDossierMapping object populated from the query conditions when no match is found
 *
 * @method     ChildAccountDossierMapping findOneByAccountDossierMappingPk(int $account_dossier_mapping_pk) Return the first ChildAccountDossierMapping filtered by the account_dossier_mapping_pk column
 * @method     ChildAccountDossierMapping findOneByAccountFk(int $account_fk) Return the first ChildAccountDossierMapping filtered by the account_fk column
 * @method     ChildAccountDossierMapping findOneByDossierFk(int $dossier_fk) Return the first ChildAccountDossierMapping filtered by the dossier_fk column
 * @method     ChildAccountDossierMapping findOneByIsAdmin(boolean $is_admin) Return the first ChildAccountDossierMapping filtered by the is_admin column *

 * @method     ChildAccountDossierMapping requirePk($key, ConnectionInterface $con = null) Return the ChildAccountDossierMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountDossierMapping requireOne(ConnectionInterface $con = null) Return the first ChildAccountDossierMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccountDossierMapping requireOneByAccountDossierMappingPk(int $account_dossier_mapping_pk) Return the first ChildAccountDossierMapping filtered by the account_dossier_mapping_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountDossierMapping requireOneByAccountFk(int $account_fk) Return the first ChildAccountDossierMapping filtered by the account_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountDossierMapping requireOneByDossierFk(int $dossier_fk) Return the first ChildAccountDossierMapping filtered by the dossier_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAccountDossierMapping requireOneByIsAdmin(boolean $is_admin) Return the first ChildAccountDossierMapping filtered by the is_admin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAccountDossierMapping[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAccountDossierMapping objects based on current ModelCriteria
 * @method     ChildAccountDossierMapping[]|ObjectCollection findByAccountDossierMappingPk(int $account_dossier_mapping_pk) Return ChildAccountDossierMapping objects filtered by the account_dossier_mapping_pk column
 * @method     ChildAccountDossierMapping[]|ObjectCollection findByAccountFk(int $account_fk) Return ChildAccountDossierMapping objects filtered by the account_fk column
 * @method     ChildAccountDossierMapping[]|ObjectCollection findByDossierFk(int $dossier_fk) Return ChildAccountDossierMapping objects filtered by the dossier_fk column
 * @method     ChildAccountDossierMapping[]|ObjectCollection findByIsAdmin(boolean $is_admin) Return ChildAccountDossierMapping objects filtered by the is_admin column
 * @method     ChildAccountDossierMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AccountDossierMappingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AccountDossierMappingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\AccountDossierMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAccountDossierMappingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAccountDossierMappingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAccountDossierMappingQuery) {
            return $criteria;
        }
        $query = new ChildAccountDossierMappingQuery();
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
     * @return ChildAccountDossierMapping|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AccountDossierMappingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AccountDossierMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAccountDossierMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT account_dossier_mapping_pk, account_fk, dossier_fk, is_admin FROM account_dossier_mapping WHERE account_dossier_mapping_pk = :p0';
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
            /** @var ChildAccountDossierMapping $obj */
            $obj = new ChildAccountDossierMapping();
            $obj->hydrate($row);
            AccountDossierMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAccountDossierMapping|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_DOSSIER_MAPPING_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_DOSSIER_MAPPING_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the account_dossier_mapping_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountDossierMappingPk(1234); // WHERE account_dossier_mapping_pk = 1234
     * $query->filterByAccountDossierMappingPk(array(12, 34)); // WHERE account_dossier_mapping_pk IN (12, 34)
     * $query->filterByAccountDossierMappingPk(array('min' => 12)); // WHERE account_dossier_mapping_pk > 12
     * </code>
     *
     * @param     mixed $accountDossierMappingPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByAccountDossierMappingPk($accountDossierMappingPk = null, $comparison = null)
    {
        if (is_array($accountDossierMappingPk)) {
            $useMinMax = false;
            if (isset($accountDossierMappingPk['min'])) {
                $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_DOSSIER_MAPPING_PK, $accountDossierMappingPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountDossierMappingPk['max'])) {
                $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_DOSSIER_MAPPING_PK, $accountDossierMappingPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_DOSSIER_MAPPING_PK, $accountDossierMappingPk, $comparison);
    }

    /**
     * Filter the query on the account_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountFk(1234); // WHERE account_fk = 1234
     * $query->filterByAccountFk(array(12, 34)); // WHERE account_fk IN (12, 34)
     * $query->filterByAccountFk(array('min' => 12)); // WHERE account_fk > 12
     * </code>
     *
     * @see       filterByAccount()
     *
     * @param     mixed $accountFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByAccountFk($accountFk = null, $comparison = null)
    {
        if (is_array($accountFk)) {
            $useMinMax = false;
            if (isset($accountFk['min'])) {
                $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_FK, $accountFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountFk['max'])) {
                $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_FK, $accountFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_FK, $accountFk, $comparison);
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
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByDossierFk($dossierFk = null, $comparison = null)
    {
        if (is_array($dossierFk)) {
            $useMinMax = false;
            if (isset($dossierFk['min'])) {
                $this->addUsingAlias(AccountDossierMappingTableMap::COL_DOSSIER_FK, $dossierFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dossierFk['max'])) {
                $this->addUsingAlias(AccountDossierMappingTableMap::COL_DOSSIER_FK, $dossierFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AccountDossierMappingTableMap::COL_DOSSIER_FK, $dossierFk, $comparison);
    }

    /**
     * Filter the query on the is_admin column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAdmin(true); // WHERE is_admin = true
     * $query->filterByIsAdmin('yes'); // WHERE is_admin = true
     * </code>
     *
     * @param     boolean|string $isAdmin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByIsAdmin($isAdmin = null, $comparison = null)
    {
        if (is_string($isAdmin)) {
            $isAdmin = in_array(strtolower($isAdmin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AccountDossierMappingTableMap::COL_IS_ADMIN, $isAdmin, $comparison);
    }

    /**
     * Filter the query by a related \Account object
     *
     * @param \Account|ObjectCollection $account The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByAccount($account, $comparison = null)
    {
        if ($account instanceof \Account) {
            return $this
                ->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_FK, $account->getAccountPk(), $comparison);
        } elseif ($account instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_FK, $account->toKeyValue('PrimaryKey', 'AccountPk'), $comparison);
        } else {
            throw new PropelException('filterByAccount() only accepts arguments of type \Account or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Account relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function joinAccount($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Account');

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
            $this->addJoinObject($join, 'Account');
        }

        return $this;
    }

    /**
     * Use the Account relation Account object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AccountQuery A secondary query class using the current class as primary query
     */
    public function useAccountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Account', '\AccountQuery');
    }

    /**
     * Filter the query by a related \Dossier object
     *
     * @param \Dossier|ObjectCollection $dossier The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function filterByDossier($dossier, $comparison = null)
    {
        if ($dossier instanceof \Dossier) {
            return $this
                ->addUsingAlias(AccountDossierMappingTableMap::COL_DOSSIER_FK, $dossier->getDossierPk(), $comparison);
        } elseif ($dossier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AccountDossierMappingTableMap::COL_DOSSIER_FK, $dossier->toKeyValue('PrimaryKey', 'DossierPk'), $comparison);
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
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
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
     * @param   ChildAccountDossierMapping $accountDossierMapping Object to remove from the list of results
     *
     * @return $this|ChildAccountDossierMappingQuery The current query, for fluid interface
     */
    public function prune($accountDossierMapping = null)
    {
        if ($accountDossierMapping) {
            $this->addUsingAlias(AccountDossierMappingTableMap::COL_ACCOUNT_DOSSIER_MAPPING_PK, $accountDossierMapping->getAccountDossierMappingPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the account_dossier_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AccountDossierMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AccountDossierMappingTableMap::clearInstancePool();
            AccountDossierMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AccountDossierMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AccountDossierMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AccountDossierMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AccountDossierMappingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AccountDossierMappingQuery
