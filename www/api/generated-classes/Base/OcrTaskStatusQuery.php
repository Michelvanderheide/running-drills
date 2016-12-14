<?php

namespace Base;

use \OcrTaskStatus as ChildOcrTaskStatus;
use \OcrTaskStatusQuery as ChildOcrTaskStatusQuery;
use \Exception;
use \PDO;
use Map\OcrTaskStatusTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ocr_task_status' table.
 *
 *
 *
 * @method     ChildOcrTaskStatusQuery orderByOcrTaskStatusPk($order = Criteria::ASC) Order by the ocr_task_status_pk column
 * @method     ChildOcrTaskStatusQuery orderByStatusName($order = Criteria::ASC) Order by the status_name column
 *
 * @method     ChildOcrTaskStatusQuery groupByOcrTaskStatusPk() Group by the ocr_task_status_pk column
 * @method     ChildOcrTaskStatusQuery groupByStatusName() Group by the status_name column
 *
 * @method     ChildOcrTaskStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOcrTaskStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOcrTaskStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOcrTaskStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOcrTaskStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOcrTaskStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOcrTaskStatusQuery leftJoinOcrTask($relationAlias = null) Adds a LEFT JOIN clause to the query using the OcrTask relation
 * @method     ChildOcrTaskStatusQuery rightJoinOcrTask($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OcrTask relation
 * @method     ChildOcrTaskStatusQuery innerJoinOcrTask($relationAlias = null) Adds a INNER JOIN clause to the query using the OcrTask relation
 *
 * @method     ChildOcrTaskStatusQuery joinWithOcrTask($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OcrTask relation
 *
 * @method     ChildOcrTaskStatusQuery leftJoinWithOcrTask() Adds a LEFT JOIN clause and with to the query using the OcrTask relation
 * @method     ChildOcrTaskStatusQuery rightJoinWithOcrTask() Adds a RIGHT JOIN clause and with to the query using the OcrTask relation
 * @method     ChildOcrTaskStatusQuery innerJoinWithOcrTask() Adds a INNER JOIN clause and with to the query using the OcrTask relation
 *
 * @method     \OcrTaskQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOcrTaskStatus findOne(ConnectionInterface $con = null) Return the first ChildOcrTaskStatus matching the query
 * @method     ChildOcrTaskStatus findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOcrTaskStatus matching the query, or a new ChildOcrTaskStatus object populated from the query conditions when no match is found
 *
 * @method     ChildOcrTaskStatus findOneByOcrTaskStatusPk(int $ocr_task_status_pk) Return the first ChildOcrTaskStatus filtered by the ocr_task_status_pk column
 * @method     ChildOcrTaskStatus findOneByStatusName(string $status_name) Return the first ChildOcrTaskStatus filtered by the status_name column *

 * @method     ChildOcrTaskStatus requirePk($key, ConnectionInterface $con = null) Return the ChildOcrTaskStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTaskStatus requireOne(ConnectionInterface $con = null) Return the first ChildOcrTaskStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOcrTaskStatus requireOneByOcrTaskStatusPk(int $ocr_task_status_pk) Return the first ChildOcrTaskStatus filtered by the ocr_task_status_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTaskStatus requireOneByStatusName(string $status_name) Return the first ChildOcrTaskStatus filtered by the status_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOcrTaskStatus[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOcrTaskStatus objects based on current ModelCriteria
 * @method     ChildOcrTaskStatus[]|ObjectCollection findByOcrTaskStatusPk(int $ocr_task_status_pk) Return ChildOcrTaskStatus objects filtered by the ocr_task_status_pk column
 * @method     ChildOcrTaskStatus[]|ObjectCollection findByStatusName(string $status_name) Return ChildOcrTaskStatus objects filtered by the status_name column
 * @method     ChildOcrTaskStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OcrTaskStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OcrTaskStatusQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\OcrTaskStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOcrTaskStatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOcrTaskStatusQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOcrTaskStatusQuery) {
            return $criteria;
        }
        $query = new ChildOcrTaskStatusQuery();
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
     * @return ChildOcrTaskStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OcrTaskStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OcrTaskStatusTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOcrTaskStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ocr_task_status_pk, status_name FROM ocr_task_status WHERE ocr_task_status_pk = :p0';
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
            /** @var ChildOcrTaskStatus $obj */
            $obj = new ChildOcrTaskStatus();
            $obj->hydrate($row);
            OcrTaskStatusTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOcrTaskStatus|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOcrTaskStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOcrTaskStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ocr_task_status_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByOcrTaskStatusPk(1234); // WHERE ocr_task_status_pk = 1234
     * $query->filterByOcrTaskStatusPk(array(12, 34)); // WHERE ocr_task_status_pk IN (12, 34)
     * $query->filterByOcrTaskStatusPk(array('min' => 12)); // WHERE ocr_task_status_pk > 12
     * </code>
     *
     * @param     mixed $ocrTaskStatusPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskStatusQuery The current query, for fluid interface
     */
    public function filterByOcrTaskStatusPk($ocrTaskStatusPk = null, $comparison = null)
    {
        if (is_array($ocrTaskStatusPk)) {
            $useMinMax = false;
            if (isset($ocrTaskStatusPk['min'])) {
                $this->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $ocrTaskStatusPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ocrTaskStatusPk['max'])) {
                $this->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $ocrTaskStatusPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $ocrTaskStatusPk, $comparison);
    }

    /**
     * Filter the query on the status_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusName('fooValue');   // WHERE status_name = 'fooValue'
     * $query->filterByStatusName('%fooValue%', Criteria::LIKE); // WHERE status_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskStatusQuery The current query, for fluid interface
     */
    public function filterByStatusName($statusName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskStatusTableMap::COL_STATUS_NAME, $statusName, $comparison);
    }

    /**
     * Filter the query by a related \OcrTask object
     *
     * @param \OcrTask|ObjectCollection $ocrTask the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOcrTaskStatusQuery The current query, for fluid interface
     */
    public function filterByOcrTask($ocrTask, $comparison = null)
    {
        if ($ocrTask instanceof \OcrTask) {
            return $this
                ->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $ocrTask->getOcrTaskStatusFk(), $comparison);
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
     * @return $this|ChildOcrTaskStatusQuery The current query, for fluid interface
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
     * @param   ChildOcrTaskStatus $ocrTaskStatus Object to remove from the list of results
     *
     * @return $this|ChildOcrTaskStatusQuery The current query, for fluid interface
     */
    public function prune($ocrTaskStatus = null)
    {
        if ($ocrTaskStatus) {
            $this->addUsingAlias(OcrTaskStatusTableMap::COL_OCR_TASK_STATUS_PK, $ocrTaskStatus->getOcrTaskStatusPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ocr_task_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OcrTaskStatusTableMap::clearInstancePool();
            OcrTaskStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OcrTaskStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OcrTaskStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OcrTaskStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OcrTaskStatusQuery
