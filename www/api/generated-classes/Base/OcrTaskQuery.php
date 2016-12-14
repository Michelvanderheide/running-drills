<?php

namespace Base;

use \OcrTask as ChildOcrTask;
use \OcrTaskQuery as ChildOcrTaskQuery;
use \Exception;
use \PDO;
use Map\OcrTaskTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ocr_task' table.
 *
 *
 *
 * @method     ChildOcrTaskQuery orderByOcrTaskPk($order = Criteria::ASC) Order by the ocr_task_pk column
 * @method     ChildOcrTaskQuery orderByProductFk($order = Criteria::ASC) Order by the product_fk column
 * @method     ChildOcrTaskQuery orderByOcrTaskStatusFk($order = Criteria::ASC) Order by the ocr_task_status_fk column
 * @method     ChildOcrTaskQuery orderByTaskId($order = Criteria::ASC) Order by the task_id column
 * @method     ChildOcrTaskQuery orderByCreationTime($order = Criteria::ASC) Order by the creation_time column
 * @method     ChildOcrTaskQuery orderByStartTime($order = Criteria::ASC) Order by the start_time column
 * @method     ChildOcrTaskQuery orderByStartCounter($order = Criteria::ASC) Order by the start_counter column
 * @method     ChildOcrTaskQuery orderBySourceFilePath($order = Criteria::ASC) Order by the source_file_path column
 * @method     ChildOcrTaskQuery orderByParsedText($order = Criteria::ASC) Order by the parsed_text column
 * @method     ChildOcrTaskQuery orderByStatusMessage($order = Criteria::ASC) Order by the status_message column
 *
 * @method     ChildOcrTaskQuery groupByOcrTaskPk() Group by the ocr_task_pk column
 * @method     ChildOcrTaskQuery groupByProductFk() Group by the product_fk column
 * @method     ChildOcrTaskQuery groupByOcrTaskStatusFk() Group by the ocr_task_status_fk column
 * @method     ChildOcrTaskQuery groupByTaskId() Group by the task_id column
 * @method     ChildOcrTaskQuery groupByCreationTime() Group by the creation_time column
 * @method     ChildOcrTaskQuery groupByStartTime() Group by the start_time column
 * @method     ChildOcrTaskQuery groupByStartCounter() Group by the start_counter column
 * @method     ChildOcrTaskQuery groupBySourceFilePath() Group by the source_file_path column
 * @method     ChildOcrTaskQuery groupByParsedText() Group by the parsed_text column
 * @method     ChildOcrTaskQuery groupByStatusMessage() Group by the status_message column
 *
 * @method     ChildOcrTaskQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOcrTaskQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOcrTaskQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOcrTaskQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOcrTaskQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOcrTaskQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOcrTaskQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildOcrTaskQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildOcrTaskQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildOcrTaskQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildOcrTaskQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildOcrTaskQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildOcrTaskQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildOcrTaskQuery leftJoinOcrTaskStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the OcrTaskStatus relation
 * @method     ChildOcrTaskQuery rightJoinOcrTaskStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OcrTaskStatus relation
 * @method     ChildOcrTaskQuery innerJoinOcrTaskStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the OcrTaskStatus relation
 *
 * @method     ChildOcrTaskQuery joinWithOcrTaskStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OcrTaskStatus relation
 *
 * @method     ChildOcrTaskQuery leftJoinWithOcrTaskStatus() Adds a LEFT JOIN clause and with to the query using the OcrTaskStatus relation
 * @method     ChildOcrTaskQuery rightJoinWithOcrTaskStatus() Adds a RIGHT JOIN clause and with to the query using the OcrTaskStatus relation
 * @method     ChildOcrTaskQuery innerJoinWithOcrTaskStatus() Adds a INNER JOIN clause and with to the query using the OcrTaskStatus relation
 *
 * @method     \ProductQuery|\OcrTaskStatusQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOcrTask findOne(ConnectionInterface $con = null) Return the first ChildOcrTask matching the query
 * @method     ChildOcrTask findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOcrTask matching the query, or a new ChildOcrTask object populated from the query conditions when no match is found
 *
 * @method     ChildOcrTask findOneByOcrTaskPk(int $ocr_task_pk) Return the first ChildOcrTask filtered by the ocr_task_pk column
 * @method     ChildOcrTask findOneByProductFk(int $product_fk) Return the first ChildOcrTask filtered by the product_fk column
 * @method     ChildOcrTask findOneByOcrTaskStatusFk(int $ocr_task_status_fk) Return the first ChildOcrTask filtered by the ocr_task_status_fk column
 * @method     ChildOcrTask findOneByTaskId(string $task_id) Return the first ChildOcrTask filtered by the task_id column
 * @method     ChildOcrTask findOneByCreationTime(string $creation_time) Return the first ChildOcrTask filtered by the creation_time column
 * @method     ChildOcrTask findOneByStartTime(string $start_time) Return the first ChildOcrTask filtered by the start_time column
 * @method     ChildOcrTask findOneByStartCounter(int $start_counter) Return the first ChildOcrTask filtered by the start_counter column
 * @method     ChildOcrTask findOneBySourceFilePath(string $source_file_path) Return the first ChildOcrTask filtered by the source_file_path column
 * @method     ChildOcrTask findOneByParsedText(string $parsed_text) Return the first ChildOcrTask filtered by the parsed_text column
 * @method     ChildOcrTask findOneByStatusMessage(string $status_message) Return the first ChildOcrTask filtered by the status_message column *

 * @method     ChildOcrTask requirePk($key, ConnectionInterface $con = null) Return the ChildOcrTask by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOne(ConnectionInterface $con = null) Return the first ChildOcrTask matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOcrTask requireOneByOcrTaskPk(int $ocr_task_pk) Return the first ChildOcrTask filtered by the ocr_task_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByProductFk(int $product_fk) Return the first ChildOcrTask filtered by the product_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByOcrTaskStatusFk(int $ocr_task_status_fk) Return the first ChildOcrTask filtered by the ocr_task_status_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByTaskId(string $task_id) Return the first ChildOcrTask filtered by the task_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByCreationTime(string $creation_time) Return the first ChildOcrTask filtered by the creation_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByStartTime(string $start_time) Return the first ChildOcrTask filtered by the start_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByStartCounter(int $start_counter) Return the first ChildOcrTask filtered by the start_counter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneBySourceFilePath(string $source_file_path) Return the first ChildOcrTask filtered by the source_file_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByParsedText(string $parsed_text) Return the first ChildOcrTask filtered by the parsed_text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOcrTask requireOneByStatusMessage(string $status_message) Return the first ChildOcrTask filtered by the status_message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOcrTask[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOcrTask objects based on current ModelCriteria
 * @method     ChildOcrTask[]|ObjectCollection findByOcrTaskPk(int $ocr_task_pk) Return ChildOcrTask objects filtered by the ocr_task_pk column
 * @method     ChildOcrTask[]|ObjectCollection findByProductFk(int $product_fk) Return ChildOcrTask objects filtered by the product_fk column
 * @method     ChildOcrTask[]|ObjectCollection findByOcrTaskStatusFk(int $ocr_task_status_fk) Return ChildOcrTask objects filtered by the ocr_task_status_fk column
 * @method     ChildOcrTask[]|ObjectCollection findByTaskId(string $task_id) Return ChildOcrTask objects filtered by the task_id column
 * @method     ChildOcrTask[]|ObjectCollection findByCreationTime(string $creation_time) Return ChildOcrTask objects filtered by the creation_time column
 * @method     ChildOcrTask[]|ObjectCollection findByStartTime(string $start_time) Return ChildOcrTask objects filtered by the start_time column
 * @method     ChildOcrTask[]|ObjectCollection findByStartCounter(int $start_counter) Return ChildOcrTask objects filtered by the start_counter column
 * @method     ChildOcrTask[]|ObjectCollection findBySourceFilePath(string $source_file_path) Return ChildOcrTask objects filtered by the source_file_path column
 * @method     ChildOcrTask[]|ObjectCollection findByParsedText(string $parsed_text) Return ChildOcrTask objects filtered by the parsed_text column
 * @method     ChildOcrTask[]|ObjectCollection findByStatusMessage(string $status_message) Return ChildOcrTask objects filtered by the status_message column
 * @method     ChildOcrTask[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OcrTaskQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OcrTaskQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'runningdrills', $modelName = '\\OcrTask', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOcrTaskQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOcrTaskQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOcrTaskQuery) {
            return $criteria;
        }
        $query = new ChildOcrTaskQuery();
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
     * @return ChildOcrTask|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OcrTaskTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOcrTask A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ocr_task_pk, product_fk, ocr_task_status_fk, task_id, creation_time, start_time, start_counter, source_file_path, parsed_text, status_message FROM ocr_task WHERE ocr_task_pk = :p0';
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
            /** @var ChildOcrTask $obj */
            $obj = new ChildOcrTask();
            $obj->hydrate($row);
            OcrTaskTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOcrTask|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ocr_task_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByOcrTaskPk(1234); // WHERE ocr_task_pk = 1234
     * $query->filterByOcrTaskPk(array(12, 34)); // WHERE ocr_task_pk IN (12, 34)
     * $query->filterByOcrTaskPk(array('min' => 12)); // WHERE ocr_task_pk > 12
     * </code>
     *
     * @param     mixed $ocrTaskPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByOcrTaskPk($ocrTaskPk = null, $comparison = null)
    {
        if (is_array($ocrTaskPk)) {
            $useMinMax = false;
            if (isset($ocrTaskPk['min'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_PK, $ocrTaskPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ocrTaskPk['max'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_PK, $ocrTaskPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_PK, $ocrTaskPk, $comparison);
    }

    /**
     * Filter the query on the product_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByProductFk(1234); // WHERE product_fk = 1234
     * $query->filterByProductFk(array(12, 34)); // WHERE product_fk IN (12, 34)
     * $query->filterByProductFk(array('min' => 12)); // WHERE product_fk > 12
     * </code>
     *
     * @see       filterByProduct()
     *
     * @param     mixed $productFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByProductFk($productFk = null, $comparison = null)
    {
        if (is_array($productFk)) {
            $useMinMax = false;
            if (isset($productFk['min'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_PRODUCT_FK, $productFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productFk['max'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_PRODUCT_FK, $productFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_PRODUCT_FK, $productFk, $comparison);
    }

    /**
     * Filter the query on the ocr_task_status_fk column
     *
     * Example usage:
     * <code>
     * $query->filterByOcrTaskStatusFk(1234); // WHERE ocr_task_status_fk = 1234
     * $query->filterByOcrTaskStatusFk(array(12, 34)); // WHERE ocr_task_status_fk IN (12, 34)
     * $query->filterByOcrTaskStatusFk(array('min' => 12)); // WHERE ocr_task_status_fk > 12
     * </code>
     *
     * @see       filterByOcrTaskStatus()
     *
     * @param     mixed $ocrTaskStatusFk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByOcrTaskStatusFk($ocrTaskStatusFk = null, $comparison = null)
    {
        if (is_array($ocrTaskStatusFk)) {
            $useMinMax = false;
            if (isset($ocrTaskStatusFk['min'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, $ocrTaskStatusFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ocrTaskStatusFk['max'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, $ocrTaskStatusFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, $ocrTaskStatusFk, $comparison);
    }

    /**
     * Filter the query on the task_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTaskId('fooValue');   // WHERE task_id = 'fooValue'
     * $query->filterByTaskId('%fooValue%', Criteria::LIKE); // WHERE task_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $taskId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByTaskId($taskId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($taskId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_TASK_ID, $taskId, $comparison);
    }

    /**
     * Filter the query on the creation_time column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationTime('2011-03-14'); // WHERE creation_time = '2011-03-14'
     * $query->filterByCreationTime('now'); // WHERE creation_time = '2011-03-14'
     * $query->filterByCreationTime(array('max' => 'yesterday')); // WHERE creation_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByCreationTime($creationTime = null, $comparison = null)
    {
        if (is_array($creationTime)) {
            $useMinMax = false;
            if (isset($creationTime['min'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_CREATION_TIME, $creationTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationTime['max'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_CREATION_TIME, $creationTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_CREATION_TIME, $creationTime, $comparison);
    }

    /**
     * Filter the query on the start_time column
     *
     * Example usage:
     * <code>
     * $query->filterByStartTime('2011-03-14'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime('now'); // WHERE start_time = '2011-03-14'
     * $query->filterByStartTime(array('max' => 'yesterday')); // WHERE start_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $startTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByStartTime($startTime = null, $comparison = null)
    {
        if (is_array($startTime)) {
            $useMinMax = false;
            if (isset($startTime['min'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_START_TIME, $startTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startTime['max'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_START_TIME, $startTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_START_TIME, $startTime, $comparison);
    }

    /**
     * Filter the query on the start_counter column
     *
     * Example usage:
     * <code>
     * $query->filterByStartCounter(1234); // WHERE start_counter = 1234
     * $query->filterByStartCounter(array(12, 34)); // WHERE start_counter IN (12, 34)
     * $query->filterByStartCounter(array('min' => 12)); // WHERE start_counter > 12
     * </code>
     *
     * @param     mixed $startCounter The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByStartCounter($startCounter = null, $comparison = null)
    {
        if (is_array($startCounter)) {
            $useMinMax = false;
            if (isset($startCounter['min'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_START_COUNTER, $startCounter['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startCounter['max'])) {
                $this->addUsingAlias(OcrTaskTableMap::COL_START_COUNTER, $startCounter['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_START_COUNTER, $startCounter, $comparison);
    }

    /**
     * Filter the query on the source_file_path column
     *
     * Example usage:
     * <code>
     * $query->filterBySourceFilePath('fooValue');   // WHERE source_file_path = 'fooValue'
     * $query->filterBySourceFilePath('%fooValue%', Criteria::LIKE); // WHERE source_file_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sourceFilePath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterBySourceFilePath($sourceFilePath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sourceFilePath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_SOURCE_FILE_PATH, $sourceFilePath, $comparison);
    }

    /**
     * Filter the query on the parsed_text column
     *
     * Example usage:
     * <code>
     * $query->filterByParsedText('fooValue');   // WHERE parsed_text = 'fooValue'
     * $query->filterByParsedText('%fooValue%', Criteria::LIKE); // WHERE parsed_text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $parsedText The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByParsedText($parsedText = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($parsedText)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_PARSED_TEXT, $parsedText, $comparison);
    }

    /**
     * Filter the query on the status_message column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusMessage('fooValue');   // WHERE status_message = 'fooValue'
     * $query->filterByStatusMessage('%fooValue%', Criteria::LIKE); // WHERE status_message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusMessage The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByStatusMessage($statusMessage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusMessage)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OcrTaskTableMap::COL_STATUS_MESSAGE, $statusMessage, $comparison);
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(OcrTaskTableMap::COL_PRODUCT_FK, $product->getProductPk(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OcrTaskTableMap::COL_PRODUCT_FK, $product->toKeyValue('PrimaryKey', 'ProductPk'), $comparison);
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
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
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
     * Filter the query by a related \OcrTaskStatus object
     *
     * @param \OcrTaskStatus|ObjectCollection $ocrTaskStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOcrTaskQuery The current query, for fluid interface
     */
    public function filterByOcrTaskStatus($ocrTaskStatus, $comparison = null)
    {
        if ($ocrTaskStatus instanceof \OcrTaskStatus) {
            return $this
                ->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, $ocrTaskStatus->getOcrTaskStatusPk(), $comparison);
        } elseif ($ocrTaskStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_STATUS_FK, $ocrTaskStatus->toKeyValue('PrimaryKey', 'OcrTaskStatusPk'), $comparison);
        } else {
            throw new PropelException('filterByOcrTaskStatus() only accepts arguments of type \OcrTaskStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OcrTaskStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function joinOcrTaskStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OcrTaskStatus');

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
            $this->addJoinObject($join, 'OcrTaskStatus');
        }

        return $this;
    }

    /**
     * Use the OcrTaskStatus relation OcrTaskStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OcrTaskStatusQuery A secondary query class using the current class as primary query
     */
    public function useOcrTaskStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOcrTaskStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OcrTaskStatus', '\OcrTaskStatusQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOcrTask $ocrTask Object to remove from the list of results
     *
     * @return $this|ChildOcrTaskQuery The current query, for fluid interface
     */
    public function prune($ocrTask = null)
    {
        if ($ocrTask) {
            $this->addUsingAlias(OcrTaskTableMap::COL_OCR_TASK_PK, $ocrTask->getOcrTaskPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ocr_task table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OcrTaskTableMap::clearInstancePool();
            OcrTaskTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OcrTaskTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OcrTaskTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OcrTaskTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OcrTaskTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OcrTaskQuery
