<?php

namespace Base;

use \Receipt as ChildReceipt;
use \ReceiptQuery as ChildReceiptQuery;
use \Exception;
use \PDO;
use Map\ReceiptTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'receipt' table.
 *
 *
 *
 * @method     ChildReceiptQuery orderByReceiptPk($order = Criteria::ASC) Order by the receipt_pk column
 * @method     ChildReceiptQuery orderByDossierFk($order = Criteria::ASC) Order by the dossier_fk column
 * @method     ChildReceiptQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildReceiptQuery orderByDueDate($order = Criteria::ASC) Order by the due_date column
 *
 * @method     ChildReceiptQuery groupByReceiptPk() Group by the receipt_pk column
 * @method     ChildReceiptQuery groupByDossierFk() Group by the dossier_fk column
 * @method     ChildReceiptQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildReceiptQuery groupByDueDate() Group by the due_date column
 *
 * @method     ChildReceiptQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReceiptQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReceiptQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReceiptQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReceiptQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReceiptQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReceiptQuery leftJoinDossier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dossier relation
 * @method     ChildReceiptQuery rightJoinDossier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dossier relation
 * @method     ChildReceiptQuery innerJoinDossier($relationAlias = null) Adds a INNER JOIN clause to the query using the Dossier relation
 *
 * @method     ChildReceiptQuery joinWithDossier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dossier relation
 *
 * @method     ChildReceiptQuery leftJoinWithDossier() Adds a LEFT JOIN clause and with to the query using the Dossier relation
 * @method     ChildReceiptQuery rightJoinWithDossier() Adds a RIGHT JOIN clause and with to the query using the Dossier relation
 * @method     ChildReceiptQuery innerJoinWithDossier() Adds a INNER JOIN clause and with to the query using the Dossier relation
 *
 * @method     \DossierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReceipt findOne(ConnectionInterface $con = null) Return the first ChildReceipt matching the query
 * @method     ChildReceipt findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReceipt matching the query, or a new ChildReceipt object populated from the query conditions when no match is found
 *
 * @method     ChildReceipt findOneByReceiptPk(int $receipt_pk) Return the first ChildReceipt filtered by the receipt_pk column
 * @method     ChildReceipt findOneByDossierFk(int $dossier_fk) Return the first ChildReceipt filtered by the dossier_fk column
 * @method     ChildReceipt findOneByCreationDate(string $creation_date) Return the first ChildReceipt filtered by the creation_date column
 * @method     ChildReceipt findOneByDueDate(string $due_date) Return the first ChildReceipt filtered by the due_date column *

 * @method     ChildReceipt requirePk($key, ConnectionInterface $con = null) Return the ChildReceipt by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceipt requireOne(ConnectionInterface $con = null) Return the first ChildReceipt matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReceipt requireOneByReceiptPk(int $receipt_pk) Return the first ChildReceipt filtered by the receipt_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceipt requireOneByDossierFk(int $dossier_fk) Return the first ChildReceipt filtered by the dossier_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceipt requireOneByCreationDate(string $creation_date) Return the first ChildReceipt filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReceipt requireOneByDueDate(string $due_date) Return the first ChildReceipt filtered by the due_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReceipt[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReceipt objects based on current ModelCriteria
 * @method     ChildReceipt[]|ObjectCollection findByReceiptPk(int $receipt_pk) Return ChildReceipt objects filtered by the receipt_pk column
 * @method     ChildReceipt[]|ObjectCollection findByDossierFk(int $dossier_fk) Return ChildReceipt objects filtered by the dossier_fk column
 * @method     ChildReceipt[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildReceipt objects filtered by the creation_date column
 * @method     ChildReceipt[]|ObjectCollection findByDueDate(string $due_date) Return ChildReceipt objects filtered by the due_date column
 * @method     ChildReceipt[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReceiptQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ReceiptQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\Receipt', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReceiptQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReceiptQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReceiptQuery) {
            return $criteria;
        }
        $query = new ChildReceiptQuery();
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
     * @return ChildReceipt|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ReceiptTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReceiptTableMap::DATABASE_NAME);
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
     * @return ChildReceipt A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT receipt_pk, dossier_fk, creation_date, due_date FROM receipt WHERE receipt_pk = :p0';
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
            /** @var ChildReceipt $obj */
            $obj = new ChildReceipt();
            $obj->hydrate($row);
            ReceiptTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildReceipt|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReceiptTableMap::COL_RECEIPT_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReceiptTableMap::COL_RECEIPT_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the receipt_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiptPk(1234); // WHERE receipt_pk = 1234
     * $query->filterByReceiptPk(array(12, 34)); // WHERE receipt_pk IN (12, 34)
     * $query->filterByReceiptPk(array('min' => 12)); // WHERE receipt_pk > 12
     * </code>
     *
     * @param     mixed $receiptPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByReceiptPk($receiptPk = null, $comparison = null)
    {
        if (is_array($receiptPk)) {
            $useMinMax = false;
            if (isset($receiptPk['min'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_RECEIPT_PK, $receiptPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receiptPk['max'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_RECEIPT_PK, $receiptPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReceiptTableMap::COL_RECEIPT_PK, $receiptPk, $comparison);
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
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByDossierFk($dossierFk = null, $comparison = null)
    {
        if (is_array($dossierFk)) {
            $useMinMax = false;
            if (isset($dossierFk['min'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_DOSSIER_FK, $dossierFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dossierFk['max'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_DOSSIER_FK, $dossierFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReceiptTableMap::COL_DOSSIER_FK, $dossierFk, $comparison);
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
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReceiptTableMap::COL_CREATION_DATE, $creationDate, $comparison);
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
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByDueDate($dueDate = null, $comparison = null)
    {
        if (is_array($dueDate)) {
            $useMinMax = false;
            if (isset($dueDate['min'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_DUE_DATE, $dueDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dueDate['max'])) {
                $this->addUsingAlias(ReceiptTableMap::COL_DUE_DATE, $dueDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReceiptTableMap::COL_DUE_DATE, $dueDate, $comparison);
    }

    /**
     * Filter the query by a related \Dossier object
     *
     * @param \Dossier|ObjectCollection $dossier The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReceiptQuery The current query, for fluid interface
     */
    public function filterByDossier($dossier, $comparison = null)
    {
        if ($dossier instanceof \Dossier) {
            return $this
                ->addUsingAlias(ReceiptTableMap::COL_DOSSIER_FK, $dossier->getDossierPk(), $comparison);
        } elseif ($dossier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReceiptTableMap::COL_DOSSIER_FK, $dossier->toKeyValue('PrimaryKey', 'DossierPk'), $comparison);
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
     * @return $this|ChildReceiptQuery The current query, for fluid interface
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
     * @param   ChildReceipt $receipt Object to remove from the list of results
     *
     * @return $this|ChildReceiptQuery The current query, for fluid interface
     */
    public function prune($receipt = null)
    {
        if ($receipt) {
            $this->addUsingAlias(ReceiptTableMap::COL_RECEIPT_PK, $receipt->getReceiptPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the receipt table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReceiptTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReceiptTableMap::clearInstancePool();
            ReceiptTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ReceiptTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReceiptTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReceiptTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReceiptTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReceiptQuery
