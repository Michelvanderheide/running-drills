<?php

namespace Base;

use \ProductComment as ChildProductComment;
use \ProductCommentQuery as ChildProductCommentQuery;
use \Exception;
use \PDO;
use Map\ProductCommentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product_comment' table.
 *
 *
 *
 * @method     ChildProductCommentQuery orderByProductCommentPk($order = Criteria::ASC) Order by the product_comment_pk column
 * @method     ChildProductCommentQuery orderByProductFk($order = Criteria::ASC) Order by the product_fk column
 * @method     ChildProductCommentQuery orderByCreationDate($order = Criteria::ASC) Order by the creation_date column
 * @method     ChildProductCommentQuery orderByComment($order = Criteria::ASC) Order by the comment column
 *
 * @method     ChildProductCommentQuery groupByProductCommentPk() Group by the product_comment_pk column
 * @method     ChildProductCommentQuery groupByProductFk() Group by the product_fk column
 * @method     ChildProductCommentQuery groupByCreationDate() Group by the creation_date column
 * @method     ChildProductCommentQuery groupByComment() Group by the comment column
 *
 * @method     ChildProductCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductCommentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductCommentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductCommentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductCommentQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProductCommentQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProductCommentQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProductCommentQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProductCommentQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProductCommentQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProductCommentQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductComment findOne(ConnectionInterface $con = null) Return the first ChildProductComment matching the query
 * @method     ChildProductComment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductComment matching the query, or a new ChildProductComment object populated from the query conditions when no match is found
 *
 * @method     ChildProductComment findOneByProductCommentPk(int $product_comment_pk) Return the first ChildProductComment filtered by the product_comment_pk column
 * @method     ChildProductComment findOneByProductFk(int $product_fk) Return the first ChildProductComment filtered by the product_fk column
 * @method     ChildProductComment findOneByCreationDate(string $creation_date) Return the first ChildProductComment filtered by the creation_date column
 * @method     ChildProductComment findOneByComment(string $comment) Return the first ChildProductComment filtered by the comment column *

 * @method     ChildProductComment requirePk($key, ConnectionInterface $con = null) Return the ChildProductComment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductComment requireOne(ConnectionInterface $con = null) Return the first ChildProductComment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductComment requireOneByProductCommentPk(int $product_comment_pk) Return the first ChildProductComment filtered by the product_comment_pk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductComment requireOneByProductFk(int $product_fk) Return the first ChildProductComment filtered by the product_fk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductComment requireOneByCreationDate(string $creation_date) Return the first ChildProductComment filtered by the creation_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductComment requireOneByComment(string $comment) Return the first ChildProductComment filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductComment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductComment objects based on current ModelCriteria
 * @method     ChildProductComment[]|ObjectCollection findByProductCommentPk(int $product_comment_pk) Return ChildProductComment objects filtered by the product_comment_pk column
 * @method     ChildProductComment[]|ObjectCollection findByProductFk(int $product_fk) Return ChildProductComment objects filtered by the product_fk column
 * @method     ChildProductComment[]|ObjectCollection findByCreationDate(string $creation_date) Return ChildProductComment objects filtered by the creation_date column
 * @method     ChildProductComment[]|ObjectCollection findByComment(string $comment) Return ChildProductComment objects filtered by the comment column
 * @method     ChildProductComment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductCommentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductCommentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'garantieapp', $modelName = '\\ProductComment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductCommentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductCommentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductCommentQuery) {
            return $criteria;
        }
        $query = new ChildProductCommentQuery();
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
     * @return ChildProductComment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductCommentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductCommentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProductComment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT product_comment_pk, product_fk, creation_date, comment FROM product_comment WHERE product_comment_pk = :p0';
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
            /** @var ChildProductComment $obj */
            $obj = new ChildProductComment();
            $obj->hydrate($row);
            ProductCommentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProductComment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_COMMENT_PK, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_COMMENT_PK, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_comment_pk column
     *
     * Example usage:
     * <code>
     * $query->filterByProductCommentPk(1234); // WHERE product_comment_pk = 1234
     * $query->filterByProductCommentPk(array(12, 34)); // WHERE product_comment_pk IN (12, 34)
     * $query->filterByProductCommentPk(array('min' => 12)); // WHERE product_comment_pk > 12
     * </code>
     *
     * @param     mixed $productCommentPk The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByProductCommentPk($productCommentPk = null, $comparison = null)
    {
        if (is_array($productCommentPk)) {
            $useMinMax = false;
            if (isset($productCommentPk['min'])) {
                $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_COMMENT_PK, $productCommentPk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productCommentPk['max'])) {
                $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_COMMENT_PK, $productCommentPk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_COMMENT_PK, $productCommentPk, $comparison);
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
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByProductFk($productFk = null, $comparison = null)
    {
        if (is_array($productFk)) {
            $useMinMax = false;
            if (isset($productFk['min'])) {
                $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_FK, $productFk['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productFk['max'])) {
                $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_FK, $productFk['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_FK, $productFk, $comparison);
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
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByCreationDate($creationDate = null, $comparison = null)
    {
        if (is_array($creationDate)) {
            $useMinMax = false;
            if (isset($creationDate['min'])) {
                $this->addUsingAlias(ProductCommentTableMap::COL_CREATION_DATE, $creationDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationDate['max'])) {
                $this->addUsingAlias(ProductCommentTableMap::COL_CREATION_DATE, $creationDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductCommentTableMap::COL_CREATION_DATE, $creationDate, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductCommentTableMap::COL_COMMENT, $comment, $comparison);
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductCommentQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_FK, $product->getProductPk(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_FK, $product->toKeyValue('PrimaryKey', 'ProductPk'), $comparison);
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
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
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
     * @param   ChildProductComment $productComment Object to remove from the list of results
     *
     * @return $this|ChildProductCommentQuery The current query, for fluid interface
     */
    public function prune($productComment = null)
    {
        if ($productComment) {
            $this->addUsingAlias(ProductCommentTableMap::COL_PRODUCT_COMMENT_PK, $productComment->getProductCommentPk(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product_comment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductCommentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductCommentTableMap::clearInstancePool();
            ProductCommentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductCommentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductCommentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductCommentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductCommentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductCommentQuery
